<?php

namespace App\Services\Builder;
use App\Models\Company;
use App\Models\Page;
use App\Models\PageModule;
use App\Models\Module;

class BuilderService
{
    public function getBuilderData(Company $company)
{
    $theme = $company->theme;

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
public function installTheme(Company $company)
{
$theme = $company->theme;

$pages = $theme->pages;

foreach ($pages as $page) {

    foreach ($page->modules as $module) {

        PageModule::create([

            'company_id' => $company->id,

            'page_id' => $page->id,

            'module_id' => $module->id,

            'order' => $module->id * 10,

            'content' => [],

            'is_visible' => true,

        ]);

    }

}
}

}