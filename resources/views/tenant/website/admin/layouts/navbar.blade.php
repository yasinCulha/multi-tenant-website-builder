<div class="admin-navbar">

    <div class="admin-navbar-left">

        <h1 class="admin-navbar-title">
            Web Sitesi Temaları
        </h1>

        <p class="admin-navbar-subtitle">
            Mevcut Şirketiniz:
            <span class="text-white fw-semibold">
                {{ $company->name }}
            </span>
        </p>

    </div>

    <div class="admin-navbar-right">

        <a href="/site/{{ $company->slug }}"
           target="_blank"
           class="btn btn-dark border-secondary text-light">

            <i class="fa-solid fa-external-link me-2"></i>

            Sitemi Canlı Gör

        </a>

    </div>

</div>