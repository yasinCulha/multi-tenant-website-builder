<div class="row align-items-center mb-5">

    <div class="col-md-8">

        <h1 class="fw-bold text-white mb-1">

            Web Sitesi Temaları

        </h1>

        <p class="text-gray mb-0">

            Mevcut Şirketiniz:

            <span class="text-white fw-semibold">

                {{ $company->name }}

            </span>

        </p>

    </div>

    <div class="col-md-4 text-md-end mt-3 mt-md-0">

        <a href="/site/{{ $company->slug }}"
           target="_blank"
           class="btn btn-dark border-secondary text-light">

            <i class="fa-solid fa-external-link me-2"></i>

            Sitemi Canlı Gör

        </a>

    </div>

</div>