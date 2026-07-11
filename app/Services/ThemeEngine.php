<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyThemeSetting;
use App\Models\Page;
use App\Models\PageModuleContent;
use App\Models\Theme;
use App\Services\Builder\ThemeInstaller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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

    public function render(Company $company, ?string $pageSlug = null, bool $isBuilderPreview = false): View
    {
        $context = $this->makeRenderContext($company, $pageSlug, $isBuilderPreview);

        return view(
            "tenant.website.themes.{$context['theme']->folder_path}.index",
            $context
        );
    }

    public function makeRenderContext(Company $company, ?string $pageSlug = null, bool $isBuilderPreview = false): array
    {
        $company->loadMissing('theme');
        $theme = $company->theme;

        if (!$theme) {
            abort(404, 'Tema bulunamadi.');
        }

        $pages = $company->pages()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $currentPage = $this->resolveCurrentPage($pages, $pageSlug);

        $pageModules = $currentPage
            ? $currentPage->pageModules()
                ->with(['themeModule', 'contents'])
                ->where('is_visible', true)
                ->orderBy('order')
                ->get()
            : collect();

        return [
            'company' => $company,
            'theme' => $theme,
            'settings' => $this->settingsFor($company, $theme),
            'pages' => $pages,
            'currentPage' => $currentPage,
            'pageModules' => $pageModules,
            'isBuilderPreview' => $isBuilderPreview,
        ];
    }

    public function saveModuleContents(Company $company, array $contents): void
    {
        DB::transaction(function () use ($company, $contents): void {
            foreach ($contents as $item) {
                $pageModule = $company->pageModules()
                    ->whereKey($item['page_module_id'] ?? null)
                    ->first();

                if (!$pageModule) {
                    continue;
                }

                foreach (($item['fields'] ?? []) as $fieldKey => $fieldValue) {
                    PageModuleContent::updateOrCreate(
                        [
                            'page_module_id' => $pageModule->id,
                            'field_key' => $fieldKey,
                        ],
                        [
                            'field_value' => is_scalar($fieldValue) || $fieldValue === null
                                ? $fieldValue
                                : json_encode($fieldValue),
                        ]
                    );
                }
            }
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

    private function resolveCurrentPage($pages, ?string $pageSlug): ?Page
    {
        return $pages->firstWhere('slug', $pageSlug)
            ?? $pages->firstWhere('slug', 'home')
            ?? $pages->first();
    }

    private function settingsFor(Company $company, Theme $theme): array
    {
        $themeSetting = CompanyThemeSetting::where('company_id', $company->id)->first();

        return array_replace_recursive(
            $this->themeManager->defaults($theme->folder_path),
            $themeSetting?->settings ?? []
        );
    }
}
