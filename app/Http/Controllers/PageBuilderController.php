<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageModule;
use App\Services\ThemeEngine;
use App\Services\Builder\BuilderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageBuilderController extends Controller
{
    public function __construct(
        protected BuilderService $builder,
        protected ThemeEngine $themeEngine
    ) {}

    public function index(Request $request): View|JsonResponse
    {
        $company = auth()->user()->company;

        if (!$company) {
            abort(403, 'Sirkete ait kullanici bulunamadi.');
        }

        $builder = $this->builder->getBuilderData($company, $request->query('page'));

        if ($request->ajax()) {
            return $this->builderResponse($builder);
        }

        return view('tenant.builder.index', compact('builder'));
    }

    public function preview(Page $page)
    {
        return $this->themeEngine->render($page->company, $page->slug, true);
    }

    public function addModuleToPage(Request $request)
    {
        $request->validate([
            'company_id'           => 'required|exists:companies,id',
            'page_id'              => 'required|exists:pages,id',
            'theme_page_module_id' => 'required|exists:theme_page_modules,id',
        ]);

        $lastModule = PageModule::where('company_id', $request->company_id)
            ->where('page_id', $request->page_id)
            ->orderByDesc('order')
            ->first();

        $order = $lastModule ? $lastModule->order + 10 : 10;

        PageModule::create([
            'company_id'           => $request->company_id,
            'page_id'              => $request->page_id,
            'theme_page_module_id' => $request->theme_page_module_id,
            'order'                => $order,
            'is_visible'           => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Modul basariyla eklendi.',
        ]);
    }
    public function storePage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        $page = $this->builder->createPage(
            auth()->user()->company,
            $request->title,
            $request->slug,
            $request->input('position', 'end')
        );

        $builder = $this->builder->getBuilderData(auth()->user()->company, $page->slug);

        return $this->builderResponse($builder, [
            'success' => true,
            'page' => $page,
        ]);
    }

    public function save(Request $request): JsonResponse
    {
        $request->validate([
            'contents' => 'array',
            'contents.*.page_module_id' => 'required|integer',
            'contents.*.fields' => 'array',
        ]);

        $company = auth()->user()->company;

        if (!$company) {
            abort(403, 'Sirkete ait kullanici bulunamadi.');
        }

        $this->themeEngine->saveModuleContents(
            $company,
            $request->input('contents', [])
        );

        return response()->json([
            'success' => true,
            'message' => 'Degisiklikler kaydedildi.',
        ]);
    }

    protected function builderResponse(array $builder, array $payload = []): JsonResponse
    {
        return response()->json(array_merge([
            'success' => true,
            'currentPage' => $builder['currentPage'],
            'sidebar' => view('tenant.builder.components.sidebar', compact('builder'))->render(),
            'preview' => view('tenant.builder.components.preview', compact('builder'))->render(),
            'settings' => view('tenant.builder.components.settings-panel', compact('builder'))->render(),
        ], $payload));
    }
}
