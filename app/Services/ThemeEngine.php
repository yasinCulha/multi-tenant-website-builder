<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyThemeSetting;
use App\Models\Theme;
use App\Services\Builder\ThemeInstaller;
use Illuminate\Support\Facades\DB;

class ThemeEngine
{
    public function __construct(
        protected ThemeManager $themeManager,
        protected ThemeInstaller $themeInstaller
    ) {}

    public function activateTheme(Company $company, Theme $theme): void
    {
        DB::transaction(function () use ($company, $theme): void {
            $this->resetCompanyPages($company);

            $defaultSettings = $this->themeManager->defaults(
                $theme->folder_path
            );

            CompanyThemeSetting::updateOrCreate(
                ['company_id' => $company->id],
                [
                    'theme_id' => $theme->id,
                    'settings' => $defaultSettings,
                ]
            );

            $company->update([
                'theme_id' => $theme->id,
            ]);

            $company->setRelation('theme', $theme);

            $this->themeInstaller->install($company);
        });
    }

    private function resetCompanyPages(Company $company): void
    {
        $pageIds = $company->pages()->pluck('id');

        if ($pageIds->isEmpty()) {
            return;
        }

        $pageModuleIds = $company->pageModules()
            ->whereIn('page_id', $pageIds)
            ->pluck('id');

        if ($pageModuleIds->isNotEmpty()) {
            DB::table('page_module_contents')
                ->whereIn('page_module_id', $pageModuleIds)
                ->delete();
        }

        $company->pageModules()
            ->whereIn('page_id', $pageIds)
            ->delete();

        $company->pages()
            ->whereIn('id', $pageIds)
            ->delete();
    }
}
