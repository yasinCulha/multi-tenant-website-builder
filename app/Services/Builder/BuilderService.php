<?php

namespace App\Services\Builder;

use App\Models\Company;
use App\Models\CompanyThemeSetting;
use App\Services\ThemeManager;

class BuilderService
{
    public function __construct(
        protected ThemeManager $themeManager
    ) {}

    public function getBuilderData(Company $company): array
    {
        $theme = $company->theme;

        if (!$theme) {
            return [
                'company' => $company,
                'theme' => null,
                'pages' => collect(),
                'currentPage' => null,
                'pageModules' => collect(),
                'pageTree' => collect(),
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
            ->orderBy('id')
            ->get();

        $pageSlug = request()->query('page');

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

        $pageTree = $pages->map(fn ($page) => [
            'page' => $page,
            'modules' => collect([[
                'id' => 'navbar-' . $page->id,
                'title' => 'Navbar',
                'type' => 'layout',
            ]])->merge($page->pageModules->map(fn ($pageModule) => [
                'id' => 'module-' . $pageModule->id,
                'title' => $pageModule->themeModule?->name ?? 'Modul',
                'type' => 'module',
                'pageModule' => $pageModule,
            ])),
        ]);

        $themeSetting = CompanyThemeSetting::where('company_id', $company->id)->first();
        $settings = array_replace_recursive(
            $this->themeManager->defaults($theme->folder_path),
            $themeSetting?->settings ?? []
        );

        return [
            'company'          => $company,
            'theme'            => $theme,
            'pages'            => $pages,
            'currentPage'      => $currentPage,
            'pageModules'      => $pageModules,
            'pageTree'         => $pageTree,
            'settings'         => $settings,
            'availableModules' => collect(),
        ];
    }
}
