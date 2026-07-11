<?php

namespace App\Http\Controllers;

use App\Services\ThemeEngine;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BuilderPreviewController extends Controller
{
    public function __construct(
        protected ThemeEngine $themeEngine
    ) {}

    public function __invoke(Request $request): View
    {
        $company = $request->user()?->company;

        if (!$company) {
            abort(403, 'Sirkete ait kullanici bulunamadi.');
        }

        return $this->themeEngine->render(
            $company,
            $request->query('page'),
            true
        );
    }
}
