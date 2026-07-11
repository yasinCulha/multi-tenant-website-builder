@extends('tenant.website.themes.corporate-blue.layouts.app')

@section('content')
    @forelse($pageModules ?? collect() as $pageModule)
        @php
            $module = $pageModule->themeModule;
            $moduleView = $module?->view_path
                ? 'tenant.website.themes.corporate-blue.' . ltrim(trim($module->view_path), '.')
                : null;
        @endphp

        @if($moduleView && view()->exists($moduleView))
            @include($moduleView, [
                'company' => $company,
                'settings' => $settings ?? [],
                'pageModule' => $pageModule,
                'module' => $module,
            ])
        @endif
    @empty
    @endforelse
@endsection
