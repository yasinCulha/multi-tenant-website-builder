@php
    $navigationLinks = $navigationLinks ?? collect();
    $brandUrl = data_get($navigationLinks->firstWhere('slug', 'home'), 'url')
        ?? data_get($navigationLinks->first(), 'url')
        ?? '#';
@endphp

<nav class="navbar navbar-expand-lg modern-karanlik-navbar fixed-top py-3">
    <div class="container">
        <a class="navbar-brand navbar-brand-text" href="{{ $brandUrl }}">
            <i class="fa-solid fa-terminal me-2"></i>{{ $company->name }}
        </a>

        <button class="navbar-toggler border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarIcerik">
            <span class="navbar-toggler-icon text-light"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarIcerik">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                @foreach($navigationLinks as $link)
                    <li class="nav-item">
                        <a
                            class="nav-link {{ $link['is_active'] ? 'active' : '' }}"
                            href="{{ $link['url'] }}"
                            data-page-slug="{{ $link['slug'] }}"
                        >
                            {{ $link['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            @if($navigationLinks->isNotEmpty())
                <a
                    href="{{ $navigationLinks->last()['url'] }}"
                    class="btn btn-primary btn-sm ms-lg-3 px-4 py-2 fw-semibold"
                    style="background-color: #6366f1; border: none; border-radius: 8px;"
                >
                    {{ data_get($settings, 'navbar.cta_button_text', 'Teklif Al') }}
                </a>
            @endif
        </div>
    </div>
</nav>
