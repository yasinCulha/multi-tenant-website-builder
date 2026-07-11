<?php

namespace App\Services\Builder;

use App\Models\Company;
use App\Models\Page;
use App\Models\PageModule;

class ThemeInstaller
{
    public function install(Company $company): void
    {
        $theme = $company->theme;

        if (!$theme) {
            return;
        }

        $themePages = $theme
            ->templatePages()
            ->with(['modules' => fn ($query) => $query->orderBy('order')])
            ->orderBy('id')
            ->get();

        foreach ($themePages->values() as $index => $themePage) {

            $page = Page::firstOrCreate(
                [
                    'company_id' => $company->id,
                    'slug'       => $themePage->slug,
                ],
                [
                    'title' => $themePage->title,
                    'sort_order' => ($index + 1) * 10,
                ]
            );

            if (!$page->sort_order) {
                $page->forceFill(['sort_order' => ($index + 1) * 10])->save();
            }

            foreach ($themePage->modules as $themeModule) {

                PageModule::firstOrCreate(
                    [
                        'company_id'           => $company->id,
                        'page_id'              => $page->id,
                        'theme_page_module_id' => $themeModule->id,
                    ],
                    [
                        'order'      => $themeModule->order,
                        'is_visible' => true,
                    ]
                );
            }
        }
    }
}
