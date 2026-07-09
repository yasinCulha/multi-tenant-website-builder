<section id="hakkimizda" class="py-5" style="background: linear-gradient(180deg, #030712 0%, #0b0f19 100%);">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="p-5 bg-dark rounded-4 border border-secondary text-center" style="background-color: #111827 !important;">
                        <i class="fa-solid fa-users-gear text-indigo" style="font-size: 120px; color: #6366f1;"></i>
                        <h3 class="text-white fw-bold mt-4">
                            <span data-bind="about.badge_title">
                                {{ data_get($settings,'about.badge_title','Uçtan Uca Yönetim') }}
                            </span>
                        </h3>
                        <p class="small text-muted m-0">
                            <span data-bind="about.badge_desc">
                                {{ data_get($settings,'about.badge_desc','Deneyimli kadromuzla tüm dijital altyapınızı tek merkezden yönetiyoruz.') }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="text-uppercase fw-bold text-indigo tracking-wider" style="color: #6366f1; font-size: 14px;" data-bind="about.section_tag">
                        {{ data_get($settings,'about.section_tag','Biz Kimiz?') }}
                    </span>
                    <h2 class="fw-bold text-white mt-2 mb-4">
                        <span data-bind="about.section_title">
                            {{ data_get($settings,'about.section_title','Teknoloji Dünyasında Güvenilir Çözüm Ortağınız') }}
                        </span>
                    </h2>
                    <p class="text-secondary mb-3">
                        <strong>
                            <span data-bind="general.company_name">
                                {{ data_get($settings,'general.company_name',$company->name) }}
                            </span>
                        </strong>
                        <span data-bind="about.text_p1">
                            {{ data_get($settings,'about.text_p1','olarak kurulduğumuz günden bu yana, işletmelerin dijital çağın getirdiği zorlukları aşmalarını ve teknolojik dönüşümlerini en sorunsuz şekilde tamamlamalarını sağlıyoruz.') }}
                        </span>
                    </p>
                    <p class="text-secondary mb-4" data-bind="about.text_p2">
                        {{ data_get($settings,'about.text_p2','Junior geliştiricilerimizin temiz kod vizyonu ve senior mimarlarımızın kararlı altyapı seçimleri sayesinde, projenizin gelecekte de ölçeklenebilir kalacağını garanti ediyoruz.') }}
                    </p>
                    
                    <div class="d-flex gap-4">
                        <div>
                            <h3 class="fw-bold text-white m-0">
                                <span data-bind="about.stat_1_value">
                                {{ data_get($settings,'about.stat_1_value','100+') }}
                                </span>
                            </h3>
                            <span class="small text-gray">
                                <span data-bind="about.stat_1_label">
                                {{ data_get($settings,'about.stat_1_label','Tamamlanan Proje') }}
                                </span>
                            </span>
                        </div>
                        <div class="border-start border-secondary ps-4">
                            <h3 class="fw-bold text-white m-0" data-bind="about.stat_2_value">
                                {{ data_get($settings,'about.stat_2_value','50+') }}
                            </h3>
                            <span class="small text-gray" data-bind="about.stat_2_label">
                                {{ data_get($settings,'about.stat_2_label','Mutlu Kurumsal Müşteri') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
