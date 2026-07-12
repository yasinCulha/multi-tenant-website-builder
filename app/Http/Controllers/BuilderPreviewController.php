<?php

namespace App\Http\Controllers;

use App\Services\ThemeEngine;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BuilderPreviewController extends Controller
{
    public function __construct(
        protected ThemeEngine $themeEngine
    ) {}

    public function __invoke(Request $request): Response
    {
        $company = $request->user()?->company;

        if (!$company) {
            abort(403, 'Sirkete ait kullanici bulunamadi.');
        }

        return response($this->themeEngine->render(
            $company,
            $request->query('page'),
            true,
            $request->integer('selected_page_module_id') ?: null
        ))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }
}
