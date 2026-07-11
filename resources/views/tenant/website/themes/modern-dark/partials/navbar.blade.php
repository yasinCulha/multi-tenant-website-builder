@php
    $navigationLinks = $navigationLinks ?? collect();
    $brandUrl = data_get($navigationLinks->firstWhere('slug', 'home'), 'url')
        ?? data_get($navigationLinks->first(), 'url')
        ?? '#';
@endphp

<header class="md-navbar">
    <div class="md-container md-navbar__inner">
        <a class="md-navbar__brand" href="{{ $brandUrl }}">
            {{ $company->name ?? data_get($settings ?? [], 'general.company_name', 'Firma Adi') }}
        </a>

        <nav class="md-navbar__menu" aria-label="Ana menu">
            @foreach($navigationLinks as $link)
                <a
                    href="{{ $link['url'] }}"
                    class="{{ $link['is_active'] ? 'is-active' : '' }}"
                    data-page-slug="{{ $link['slug'] }}"
                >
                    {{ $link['title'] }}
                </a>
            @endforeach
        </nav>

        @if($navigationLinks->isNotEmpty())
            <a class="md-button md-button--sm" href="{{ $navigationLinks->last()['url'] }}">
                {{ data_get($settings ?? [], 'navbar.cta_button_text', 'Iletisime Gec') }}
            </a>
        @endif
    </div>
</header>
