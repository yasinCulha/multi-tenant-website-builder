<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageModule;
use Illuminate\Http\Request;
use App\Services\Builder\BuilderService;
use App\Services\Builder\ThemeInstaller;

class PageBuilderController extends Controller
{
    protected BuilderService $builder;

    public function __construct(BuilderService $builder)
    {
        $this->builder = $builder;

        
    }

    public function index()
    {
        $company = auth()->user()->company;
        
        $builder = $this->builder->getBuilderData($company);

        

        if (!$company) {
            abort(403, 'Şirkete ait kullanıcı bulunamadı.');
        }

        $builder = $this->builder->getBuilderData($company);

        return view('tenant.builder.index', compact('builder'));
    }

    public function preview(Page $page)
    {
        return view('tenant.builder.preview-page', compact('page'));
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
            'message' => 'Modül başarıyla eklendi.',
        ]);
    }
}
