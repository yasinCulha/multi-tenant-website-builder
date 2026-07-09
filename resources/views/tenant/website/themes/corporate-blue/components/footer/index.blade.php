<footer class="kurumsal-footer bg-dark text-light py-5 border-top border-secondary">
        <div class="container">
            {{-- Üst Kısım: Firma Adı --}}
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h5 class="text-white fw-bold mb-2 tracking-wide text-uppercase" style="letter-spacing: 1px;" data-bind="general.company_name">
                        {{ var_export(data_get($settings, 'general.company_name', $company->name), true) ? data_get($settings, 'general.company_name', $company->name) : $company->name }}
                    </h5>
                    <p class="m-0 text-gray">
                        <span data-bind="footer.copyright_text">{{ data_get($settings, 'footer.copyright_text', '© 2026 Tüm Hakları Saklıdır. Güvenli Kurumsal Altyapı Çözümleri.') }}</span>
                    </p>
                    <div class="mx-auto bg-primary" style="width: 50px; height: 3px; border-radius: 2px;"></div>
                </div>
            </div>
        
            {{-- Orta Kısım: Sosyal Medya ve İletişim Bilgileri --}}
            <div class="row g-4 justify-content-center align-items-start my-3">
                
                {{-- SOSYAL MEDYA SÜTUNU --}}
                @if($company->socialMedias && $company->socialMedias->isNotEmpty())
                    <div class="col-md-5 text-center text-md-end border-end-md border-secondary pe-md-4">
                        <span class="text-muted d-block small text-uppercase fw-bold mb-3" style="letter-spacing: 0.5px;" data-bind="footer.social_title">
                            {{ data_get($settings, 'footer.social_title', 'Sosyal Medya Hesaplarımız') }}
                        </span>
                        <div class="d-flex gap-2 justify-content-center justify-content-md-end flex-wrap">
                            @foreach($company->socialMedias as $index => $social)
                                <a href="{{ data_get($settings, "footer.social_media.$index.url", $social->url) }}" 
                                   data-bind="footer.social_media.{{ $index }}.url"
                                   data-bind-attr="href"
                                   target="_blank" 
                                   class="btn btn-outline-light btn-sm rounded-circle d-inline-flex align-items-center justify-content-center" 
                                   style="width: 38px; height: 38px;">
                                   
                                    @if($social->platform == 'instagram')
                                        <i class="fa-brands fa-instagram fs-5"></i>
                                    @elseif($social->platform == 'twitter' || $social->platform == 'x')
                                        <i class="fa-brands fa-x fs-5"></i>
                                    @elseif($social->platform == 'linkedin')
                                        <i class="fa-brands fa-linkedin-in fs-5"></i>
                                    @elseif($social->platform == 'youtube')
                                        <i class="fa-brands fa-youtube fs-5"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- İLETİŞİM NUMARALARI SÜTUNU --}}
                @if($company->phones && $company->phones->isNotEmpty())
                    <div class="col-md-5 text-center text-md-start ps-md-4">
                        <span class="text-muted d-block small text-uppercase fw-bold mb-3" style="letter-spacing: 0.5px;" data-bind="footer.contact_title">
                            {{ data_get($settings, 'footer.contact_title', 'İletişim Numaralarımız') }}
                        </span>
                        <div class="d-flex flex-column gap-2 align-items-center align-items-md-start">
                            @foreach($company->phones as $index => $phone)
                                @if($phone->type == 'cep')
                                    <p class="text-light text-decoration-none d-flex align-items-center gap-2 link-primary-hover m-0">
                                        <i class="fa-solid fa-mobile-screen-button text-primary"></i> 
                                        <span>
                                            <strong data-bind="footer.phone.{{ $index }}.type">{{ data_get($settings, "footer.phone.$index.type", 'Cep') }}:</strong> 
                                            <span data-bind="footer.phone.{{ $index }}.number">{{ data_get($settings, "footer.phone.$index.number", $phone->number) }}</span>
                                        </span>
                                    </p>
                                @elseif($phone->type == 'sabit')
                                    <p class="text-light text-decoration-none d-flex align-items-center gap-2 link-primary-hover m-0">
                                        <i class="fa-solid fa-phone text-primary"></i> 
                                        <span>
                                            <strong data-bind="footer.phone.{{ $index }}.type">{{ data_get($settings, "footer.phone.$index.type", 'Sabit Hat') }}:</strong> 
                                            <span data-bind="footer.phone.{{ $index }}.number">{{ data_get($settings, "footer.phone.$index.number", $phone->number) }}</span>
                                        </span>
                                    </p>
                                @elseif($phone->type == 'whatsapp')
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', data_get($settings, "footer.phone.$index.number", $phone->number)) }}" 
                                       data-bind="footer.phone.{{ $index }}.number"
                                       data-bind-attr="href"
                                       target="_blank" 
                                       class="text-light text-decoration-none d-flex align-items-center gap-2 link-success-hover">
                                        <i class="fa-brands fa-whatsapp text-success fs-5"></i> 
                                        <span>
                                            <strong data-bind="footer.phone.{{ $index }}.type">{{ data_get($settings, "footer.phone.$index.type", 'WhatsApp') }}:</strong> 
                                            <span>{{ data_get($settings, "footer.phone.$index.number", $phone->number) }}</span>
                                        </span>
                                    </a>
                                @elseif($phone->type == 'destek')
                                    <p class="text-light text-decoration-none d-flex align-items-center gap-2 link-primary-hover m-0">
                                        <i class="fa-solid fa-headset text-primary"></i> 
                                        <span>
                                            <strong data-bind="footer.phone.{{ $index }}.type">{{ data_get($settings, "footer.phone.$index.type", 'Destek') }}:</strong> 
                                            <span data-bind="footer.phone.{{ $index }}.number">{{ data_get($settings, "footer.phone.$index.number", $phone->number) }}</span>
                                        </span>
                                    </p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <hr class="border-secondary my-4">

            {{-- Alt Kısım: Copyright --}}
            <div class="row">
                <div class="col-12 text-center">
                    <p class="m-0 text-muted small">
                        <span data-bind="footer.copyright_subtext">{{ data_get($settings, 'footer.copyright_subtext', '© 2026 Tüm Hakları Saklıdır. Güvenli Kurumsal Altyapı Çözümleri.') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>