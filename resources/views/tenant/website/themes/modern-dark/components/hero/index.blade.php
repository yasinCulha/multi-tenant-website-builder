<section id="ana-sayfa" class="hero-bölümü">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="hero-baslik text-white mb-4">
                        <span data-bind="hero.title_prefix">
                            {{ data_get($settings,'hero.title_prefix','Geleceğin Teknolojisini') }}
                        </span>
                        <br>
                        <span class="renkli-gradyan-yazi" data-bind="hero.company_name">
                            {{ data_get($settings,'hero.company_name',$company->name) }}
                        </span>

                        <span data-bind="hero.title_suffix">
                            {{ data_get($settings,'hero.title_suffix','İle İnşa Edin') }}
                        </span>
                    </h1>
                    <p class="fs-5 mb-4 text-secondary">
                        <span data-bind="hero.description">
                            {{ data_get($settings,'hero.description','Yapabilirliklerinizi veri analitiği ve modern web mimarileriyle ölçeklendirin. Sizin için en stabil çözümleri üretiyoruz.') }}
                        </span>
                    </p>
                    <div class="d-flex gap-3">
                        <a
                            href="{{ data_get($settings,'hero.button_primary_url','#hizmetler') }}"
                            data-bind="hero.button_primary_url"
                            data-bind-attr="href"
                            class="btn btn-primary px-4 py-3 fw-semibold"
                            style="background-color:#6366f1;border:none;border-radius:10px;">

                            <span data-bind="hero.button_primary_text">
                                {{ data_get($settings,'hero.button_primary_text','Çözümlerimizi İnceleyin') }}
                            </span>

                        </a>
                        <a href="{{ data_get($settings,'hero.button_secondary_url','#iletisim') }}"
                            data-bind="hero.button_secondary_url"
                            data-bind-attr="href"
                            class="btn btn-outline-secondary text-light px-4 py-3 fw-semibold"
                            style="border-radius:10px;">

                            <span data-bind="hero.button_secondary_text">
                                {{ data_get($settings,'hero.button_secondary_text','Bizimle Tanışın') }}
                            </span>

                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fa-solid fa-laptop-code text-indigo d-none d-lg-block" style="font-size: 280px; color: rgba(99, 102, 241, 0.15);"></i>
                </div>
            </div>
        </div>
    </section>