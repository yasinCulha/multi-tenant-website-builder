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

    $pageSlug = request()->query('page');

    $currentPage = $pages
        ->firstWhere('slug', $pageSlug)
        ?? $pages->first();

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
public function installTheme(Company $company): void
{
    // Şirket için modüller zaten oluşturulduysa tekrar oluşturma
    if (PageModule::where('company_id', $company->id)->exists()) {
        return;
    }

    $theme = $company->theme;

    if (!$theme) {
        return;
    }

    $pages = $theme->pages()->with('modules')->get();

    foreach ($pages as $page) {

        $order = 10;

        foreach ($page->modules as $module) {

            PageModule::create([
                'company_id' => $company->id,
                'page_id' => $page->id,
                'module_id' => $module->id,
                'order' => $order,
                'content' => [],
                'is_visible' => true,
            ]);

            $order += 10;
        }
    }
}

}