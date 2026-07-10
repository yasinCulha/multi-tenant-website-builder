<?php

namespace App\Services\Builder;
use App\Models\Company;
use App\Models\Page;
use App\Models\PageModule;

class BuilderService
{
    public function getBuilderData(Company $company)
    {
        $theme = $company->theme;
        dd($theme->id);
        $pages = $theme->pages()->orderBy('id')->get();
        $currentPage = $pages->first();

        $pageModules = $currentPage
        ? $currentPage->pageModules()
            ->with('module')
            ->orderBy('order')
            ->get()
        : collect();

        $availableModules = $currentPage
        ? $currentPage->modules()->orderBy('id')->get()
        : collect();

        return [
        'company' => $company,
        'theme' => $theme,
        'pages' => $pages,
        'currentPage' => $currentPage,
        'pageModules' => $pageModules,
        'availableModules' => $availableModules,
    ];

    }   

}