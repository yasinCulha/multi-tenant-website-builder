<footer class="py-5" style="background:#111827; border-top:1px solid #374151;">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-white">
                    <span data-bind="general.company_name">
                        {{ $company->name }}
                    </span>
                </h3>
            </div>
            <div class="row g-4">

                {{-- Sosyal Medya --}}
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 h-100" style="background:#1f2937;">
                        <h5 class="text-success mb-4">
                            <i class="fa-solid fa-share-nodes me-2"></i>
                            <span data-bind="footer.social_title">
                                Sosyal Medya
                            </span>
                        </h5>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($company->socialMedias as $index => $social)
                                <a
                                    href="{{ data_get($settings, "footer.social_media.$index.url", $social->url) }}"
                                    data-bind="footer.social_media.{{ $index }}.url"
                                    data-bind-attr="href"
                                    target="_blank"
                                    class="d-flex align-items-center justify-content-center rounded-circle text-white text-decoration-none"
                                    style="width:50px;height:50px;background:#374151;transition:.3s;">

                                    @if($social->platform=="instagram")
                                        <i class="fa-brands fa-instagram fs-4"></i>
                                    @elseif($social->platform=="x")
                                        <i class="fa-brands fa-x fs-4"></i>
                                    @elseif($social->platform=="linkedin")
                                        <i class="fa-brands fa-linkedin fs-4"></i>
                                    @elseif($social->platform=="youtube")
                                        <i class="fa-brands fa-youtube fs-4"></i>
                                    @endif

                                </a>

                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Telefonlar --}}
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 h-100" style="background:#1f2937;">
                        <h5 class="text-success mb-4">
                            <i class="fa-solid fa-phone me-2"></i>
                            <span data-bind="footer.contact_title">
                                İletişim
                            </span>
                        </h5>
                        @foreach($company->phones as $index => $phone)
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    @if($phone->type=="cep")
                                        <i class="fa-solid fa-mobile-screen-button text-success fs-5"></i>
                                    @elseif($phone->type=="sabit")
                                        <i class="fa-solid fa-phone text-success fs-5"></i>
                                    @elseif($phone->type=="whatsapp")
                                        <i class="fa-brands fa-whatsapp text-success fs-5"></i>
                                    @else
                                        <i class="fa-solid fa-headset text-success fs-5"></i>
                                    @endif
                                </div>

                                <div>
                                    <div class="text-secondary small">
                                        <span data-bind="footer.phone.{{ $index }}.type">
                                            {{ data_get($settings,"footer.phone.$index.type", ucfirst($phone->type)) }}
                                        </span>
                                    </div>

                                    @if($phone->type=="whatsapp")
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone->number) }}"
                                            target="_blank" 
                                            class="text-white text-decoration-none"
                                            data-bind="footer.phone.{{ $index }}.number">
                                            {{$phone->number}}
                                        </a>
                                    @else
                                        <p class="text-white text-decoration-none m-0" data-bind="footer.phone.{{ $index }}.number">
                                            {{$phone->number}}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr class="my-5 border-secondary">
            <div class="text-center text-secondary small">
                <span data-bind="footer.copyright_text">
                {{ data_get($settings,'footer.copyright_text','© 2026 Tüm Hakları Saklıdır. Güvenli Kurumsal Altyapı Çözümleri.') }}
                </span>
            </div>
        </div>
    </footer>