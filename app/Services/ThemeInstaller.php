<?php

namespace App\Services\Builder;

use App\Models\Company;
use App\Models\PageModule;

class ThemeInstaller
{
    public function install(Company $company): void
    {
        $theme = $company->theme;

        if (!$theme) {
            return;
        }

        $pages = $theme->pages()->with('modules')->get();

        foreach ($pages as $page) {

            foreach ($page->modules as $module) {

                PageModule::firstOrCreate(
                    [
                        'company_id' => $company->id,
                        'page_id'    => $page->id,
                        'module_id'  => $module->id,
                    ],
                    [
                        'order'      => $module->id * 10,
                        'content'    => [],
                        'is_visible' => true,
                    ]
                );

            }

        }
    }
}