<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyThemeSetting;
use App\Models\Theme;
use App\Services\ThemeManager;

class ThemeEngine
{
    public function __construct(
        protected ThemeManager $themeManager
    ) {}

    public function activateTheme(Company $company, Theme $theme): void
    {
        $defaultSettings = $this->themeManager->defaults(
            $theme->folder_path
        );

        $themeSetting = CompanyThemeSetting::where(
            'company_id',
            $company->id
        )->first();

        if (!$themeSetting) {

            CompanyThemeSetting::create([
                'company_id' => $company->id,
                'theme_id'   => $theme->id,
                'settings'   => $defaultSettings,
            ]);

        } else {

            if ($themeSetting->theme_id != $theme->id) {

                $themeSetting->theme_id = $theme->id;
                $themeSetting->settings = $defaultSettings;
                $themeSetting->save();

            }

        }

        $company->update([
            'theme_id' => $theme->id
        ]);
    }
}