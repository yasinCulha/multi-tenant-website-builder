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
        // Eksik page_modules kayıtlarını oluştur
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

        // Temaya ait sayfalar
        $pages = $theme->pages()
            ->orderBy('id')
            ->get();

        // URL'den seçili sayfa
        $pageSlug = request()->query('page');

        $currentPage = $pages->firstWhere('slug', $pageSlug)
            ?? $pages->first();

        // Sayfadaki modüller
        $pageModules = $currentPage
            ? $currentPage->pageModules()
                ->with('module')
                ->orderBy('order')
                ->get()
            : collect();

        // Bu sayfaya eklenebilecek modüller
        $availableModules = $currentPage
            ? $currentPage->modules()
                ->orderBy('id')
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