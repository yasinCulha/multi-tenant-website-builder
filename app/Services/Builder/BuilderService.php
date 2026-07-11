<?php

namespace App\Services\Builder;

use App\Models\Company;

class BuilderService
{
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
                ->where('is_visible', true)
                ->orderBy('order')
                ->get()
            : collect();

        return [
            'company'          => $company,
            'theme'            => $theme,
            'pages'            => $pages,
            'currentPage'      => $currentPage,
            'pageModules'      => $pageModules,
            'availableModules' => collect(),
        ];
    }
}
