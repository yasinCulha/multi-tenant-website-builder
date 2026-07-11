@php
    $navigationLinks = $navigationLinks ?? collect();
    $brandUrl = data_get($navigationLinks->firstWhere('slug', 'home'), 'url')
        ?? data_get($navigationLinks->first(), 'url')
        ?? '#';
@endphp

<nav class="navbar navbar-expand-lg kurumsal-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ $brandUrl }}">
            <i class="fa-solid fa-briefcase"></i>
            <span>{{ data_get($settings, 'general.company_name', $company->name) }}</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fa-solid fa-bars fs-4 text-dark"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-2">
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
        </div>
    </div>
</nav>
