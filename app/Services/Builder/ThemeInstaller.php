<?php

namespace App\Services\Builder;

use App\Models\Company;
use App\Models\Page;

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
            ->orderBy('id')
            ->get();

        foreach ($themePages as $themePage) {

            Page::firstOrCreate(
                [
                    'company_id' => $company->id,
                    'slug'       => $themePage->slug,
                ],
                [
                    'title' => $themePage->title,
                ]
            );
        }
        dd($themePage->modules()->get());
    }
}