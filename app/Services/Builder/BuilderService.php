<?php

namespace App\Services\Builder;

use App\Models\Company;

class BuilderService
{
    public function __construct(
        protected ThemeInstaller $installer
    ) {}

    public function getBuilderData(Company $company): array
    {
        $this->installer->install($company);

        $theme = $company->theme;

        if (!$theme) {
            return [
                'company' => $company,
                'theme' => null,
                'pages' => collect(),
                'currentPage' => null,
                'pageModules' => collect(),
                'availableModules' => collect(),
            ];
        }

        $pages = $company->pages()
            ->orderBy('id')
            ->get();

        $pageSlug = request()->query('page');

        $currentPage = $pages->firstWhere('slug', $pageSlug)
            ?? $pages->first();

        $pageModules = $currentPage
            ? $currentPage->pageModules()
                ->with(['themeModule', 'contents'])
                ->orderBy('order')
                ->get()
            : collect();

        $templatePage = $currentPage
            ? $theme->templatePages()
                ->where('slug', $currentPage->slug)
                ->first()
            : null;

        $availableModules = $templatePage
            ? $templatePage->modules()
                ->orderBy('order')
                ->get()
            : collect();

        return [
            'company'          => $company,
            'theme'            => $theme,
            'pages'            => $pages,
            'currentPage'      => $currentPage,
            'pageModules'      => $pageModules,
            'availableModules' => $availableModules,
        ];
    }
}
