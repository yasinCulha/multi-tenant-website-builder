<?php

namespace App\Services\Builder;

use App\Models\Company;
use App\Models\CompanyThemeSetting;
use App\Models\Page;
use App\Services\ThemeManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BuilderService
{
    public function __construct(
        protected ThemeManager $themeManager
    ) {}

    public function getBuilderData(Company $company, ?string $pageSlug = null): array
    {
        $theme = $company->theme;

        if (!$theme) {
            return [
                'company' => $company,
                'theme' => null,
                'pages' => collect(),
                'currentPage' => null,
                'pageModules' => collect(),
                'settings' => [],
                'availableModules' => collect(),
            ];
        }

        $pages = $company->pages()
            ->with(['pageModules' => fn ($query) => $query
                ->with('themeModule')
                ->where('is_visible', true)
                ->orderBy('order')
            ])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $pageSlug ??= request()->query('page');

        $currentPage = $pages->firstWhere('slug', $pageSlug)
            ?? $pages->firstWhere('slug', 'home')
            ?? $pages->first();

        $pageModules = $currentPage
            ? $currentPage->pageModules()
                ->with(['themeModule', 'contents'])
                ->where('is_visible', true)
                ->orderBy('order')
                ->get()
            : collect();

        $themeSetting = CompanyThemeSetting::where('company_id', $company->id)->first();
        $settings = array_replace_recursive(
            $this->themeManager->defaults($theme->folder_path),
            $themeSetting?->settings ?? []
        );

        return [
            'company' => $company,
            'theme' => $theme,
            'pages' => $pages,
            'currentPage' => $currentPage,
            'pageModules' => $pageModules,
            'settings' => $settings,
            'availableModules' => $this->getAvailableModules($company),
        ];
    }

    public function createPage(Company $company, string $title, ?string $slug = null, string $position = 'end'): Page
    {
        return DB::transaction(function () use ($company, $title, $slug, $position) {
            $this->normalizePageOrder($company);

            $sortOrder = $this->resolveNewPageOrder($company, $position);

            $company->pages()
                ->where('sort_order', '>=', $sortOrder)
                ->increment('sort_order', 10);

            return Page::create([
                'company_id' => $company->id,
                'title' => $title,
                'slug' => $this->uniquePageSlug($company, $slug ?: $title),
                'sort_order' => $sortOrder,
            ]);
        });
    }

    public function normalizePageOrder(Company $company): void
    {
        $company->pages()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->values()
            ->each(function (Page $page, int $index) {
                $page->forceFill(['sort_order' => ($index + 1) * 10])->save();
            });
    }

    protected function getAvailableModules(Company $company): Collection
    {
        return $company->theme
            ? $company->theme->templateModules()
                ->select('theme_page_modules.*')
                ->orderBy('theme_page_modules.order')
                ->orderBy('theme_page_modules.name')
                ->get()
                ->unique(fn ($module) => $module->view_path ?: $module->name)
                ->values()
            : collect();
    }

    protected function uniquePageSlug(Company $company, string $slugSource): string
    {
        $slug = Str::slug($slugSource) ?: 'sayfa';
        $originalSlug = $slug;
        $counter = 1;

        while (
            Page::where('company_id', $company->id)
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function resolveNewPageOrder(Company $company, string $position): int
    {
        if ($position === 'start') {
            return 10;
        }

        if (Str::startsWith($position, 'after:')) {
            $pageId = (int) Str::after($position, 'after:');
            $page = $company->pages()->whereKey($pageId)->first();

            if ($page) {
                return (int) $page->sort_order + 10;
            }
        }

        $lastOrder = (int) $company->pages()->max('sort_order');

        return $lastOrder + 10;
    }
}
