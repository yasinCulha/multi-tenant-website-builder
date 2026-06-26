    <!DOCTYPE html>
    <html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ana Yönetim Paneli (Super Admin)</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <style>
            body { 
                font-family: 'Inter', sans-serif; 
                background-color: #0b0f19; 
                color: #f1f5f9; 
                overflow-x: hidden;
            }
            
            /* SOL MENÜ (SIDEBAR) STİLLERİ */
            .admin-sidebar-menusu {
                width: 260px;
                height: 100vh;
                position: fixed;
                top: 0; left: 0;
                background-color: #111827; 
                border-right: 1px solid #1f2937;
                padding: 24px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .sidebar-logo {
                font-size: 20px;
                font-weight: 700;
                color: #10b981; 
                margin-bottom: 40px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .menuler-listesi {
                list-style: none;
                padding: 0; margin: 0;
            }

            .menu-linki {
                display: flex;
                align-items: center;
                gap: 12px;
                color: #9ca3af;
                text-decoration: none;
                padding: 12px 16px;
                border-radius: 8px;
                font-weight: 500;
                transition: all 0.2s;
            }

            .menu-linki:hover, .menu-linki.aktif-menu {
                background-color: #1f2937;
                color: #ffffff;
            }

            .menu-linki.aktif-menu i {
                color: #10b981;
            }

            /* SAĞ İÇERİK ALANI */
            .admin-icerik-alani {
                margin-left: 260px; 
                padding: 40px;
                min-height: 100vh;
            }

            .admin-karanlik-kart {
                background-color: #111827;
                border: 1px solid #1f2937;
                border-radius: 12px;
                padding: 25px;
                margin-bottom: 30px;
            }

            .custom-input:focus {
                background-color: #1f2937 !important;
                border-color: #10b981 !important;
                color: #ffffff !important;
                box-shadow: 0 0 10px rgba(16, 185, 129, 0.25) !important;
            }

            /* Modal ve Metin Ayarları */
            .modal-content {
                background-color: #111827;
                border: 1px solid #1f2937;
                color: #f1f5f9;
            }
            .modal-header { border-bottom: 1px solid #1f2937; }
            .modal-footer { border-top: 1px solid #1f2937; }
            .text-gray { color: #9ca3af !important; }
            ::placeholder { color: #9ca3af !important; opacity: 1; }

            /* SweetAlert Karanlık Tema Uyumu */
            .swal2-popup {
                background-color: #111827 !important;
                color: #f1f5f9 !important;
                border: 1px solid #1f2937 !important;
            }
        </style>
    </head>
    <body>

        <div class="admin-sidebar-menusu">
            <div>
                <div class="sidebar-logo">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>SuperAdmin</span>
                </div>

                <ul class="menuler-listesi">
                    <li>
                        <a href="#" class="menu-linki aktif-menu">
                            <i class="fa-solid fa-building-shield"></i>
                            <span>Firma Yönetimi</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="border-top border-secondary pt-3">
                <div class="small text-gray mb-1">Giriş Yapan Yönetici:</div>
                <div class="fw-bold text-light mb-3 text-truncate">{{ auth()->user()->name }}</div>
                
                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-semibold">
                        <i class="fa-solid fa-power-off me-1"></i> Sistemden Çık
                    </button>
                </form>
            </div>
        </div>

        <div class="admin-icerik-alani">
            
            <div class="mb-4">
                <h1 class="fw-bold text-white m-0">Yönetim Merkezi</h1>
                <p class="text-gray m-0 mt-1">Sistemdeki tüm alt firmaları ve kullanıcıları buradan yönetebilirsiniz.</p>
            </div>

            <div class="admin-karanlik-kart shadow-sm">
                <h4 class="fw-bold text-white mb-4"><i class="fa-solid fa-plus-circle me-2 text-success"></i>Yeni Firma & Kullanıcı Tanımla</h4>
                
                <form action="/admin/company/store" method="POST">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-light">Firma Adı</label>
                            <input
                                type="text"
                                name="company_name"
                                class="form-control bg-dark text-light border-secondary custom-input"
                                placeholder="Örn: Çulha Yazılım"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-light">Yönetici E-posta</label>
                            <input
                                type="email"
                                name="user_email"
                                class="form-control bg-dark text-light border-secondary custom-input"
                                placeholder="admin@firma.com"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-light">Başlangıç Şifresi</label>
                            <input
                                type="password"
                                name="user_password"
                                class="form-control bg-dark text-light border-secondary custom-input"
                                required>
                        </div>
                        <div id="sosyal-medya-satirlari">
                            <div class="card bg-dark border-secondary mb-4">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h5 class="mb-0 text-white">
                                        <i class="fa-solid fa-phone text-success me-2"></i>
                                        Şirket Telefonları
                                    </h5>

                                    <button
                                        type="button"
                                        id="btn-telefon-ekle"
                                        class="btn btn-success btn-sm">

                                        <i class="fa-solid fa-plus me-1"></i>

                                        Telefon Ekle

                                    </button>

                                </div>

                                <div class="card-body" id="telefon-numarasi-satirlari">

                                    <div class="row g-2 telefon-input-satir">

                                        <div class="col-md-3">
                                            <select
                                                name="phones[0][type]"
                                                class="form-select bg-dark text-light border-secondary">

                                                <option value="cep">Cep Telefonu</option>
                                                <option value="sabit">Sabit Hat</option>
                                                <option value="whatsapp">WhatsApp</option>
                                                <option value="destek">Destek</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <input
                                                type="text"
                                                name="phones[0][number]"
                                                class="form-control bg-dark text-light border-secondary"
                                                placeholder="0555 555 55 55">
                                        </div>
                                        <div class="col-md-1">
                                            <button
                                                type="button"
                                                class="btn btn-outline-danger w-100 d-none">

                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="card bg-dark border-secondary mb-4">

                                    <div class="card-header d-flex justify-content-between align-items-center">

                                        <h5 class="mb-0 text-white">

                                            <i class="fa-solid fa-share-nodes text-success me-2"></i>

                                            Sosyal Medya Hesapları

                                        </h5>

                                        <button
                                            type="button"
                                            id="btn-sosyal-ekle"
                                            class="btn btn-primary btn-sm">

                                            <i class="fa-solid fa-plus me-1"></i>

                                            Sosyal Medya Ekle

                                        </button>

                                    </div>

                                    <div class="card-body" id="sosyal-medya-satirlari">

                                        <div class="row g-2 sosyal-input-satir">

                                            <div class="col-md-3">

                                                <select
                                                    name="socials[0][platform]"
                                                    class="form-select bg-dark text-light border-secondary">

                                                    <option value="instagram">Instagram</option>
                                                    <option value="facebook">Facebook</option>
                                                    <option value="x">X</option>
                                                    <option value="linkedin">LinkedIn</option>
                                                    <option value="youtube">Youtube</option>
                                                    <option value="tiktok">TikTok</option>

                                                </select>

                                            </div>

                                            <div class="col-md-8">

                                                <input
                                                    type="url"
                                                    name="socials[0][url]"
                                                    class="form-control bg-dark text-light border-secondary"
                                                    placeholder="https://instagram.com/firma">

                                            </div>

                                            <div class="col-md-1">

                                                <button
                                                    type="button"
                                                    class="btn btn-outline-danger w-100 d-none">

                                                    <i class="fa-solid fa-trash"></i>

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                        <div class="text-end">

                            <button
                                class="btn btn-success btn-lg px-5"
                                type="submit">

                                <i class="fa-solid fa-floppy-disk me-2"></i>

                                Sisteme Kaydet ve Dağıt

                            </button>

                        </div>
                        
                    </div>
                </form>
            </div>

            <div class="admin-karanlik-kart shadow-sm">
                <h4 class="fw-bold text-white mb-4"><i class="fa-solid fa-list-check me-2 text-success"></i>Kayıtlı Aktif Firmalar</h4>
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle m-0">
                        <thead>
                            <tr>
                                <th>Firma Adı</th>
                                <th>Canlı URL (Slug)</th>
                                <th>Seçili Aktif Tema</th>
                                <th class="text-center" style="width: 200px;">Yönetimsel İşlemler</th>
                            </tr>
                        </thead>
                        <tbody id="firmaTabloGovdesi">
                            @if($companies->isEmpty())
                                <tr id="bosSatir">
                                    <td colspan="4" class="text-center py-4 text-gray fs-6">Sistemde henüz kayıtlı hiçbir firma bulunamadı.</td>
                                </tr>
                            @else
                                @foreach($companies as $company)
                                    <tr id="company-row-{{ $company->id }}">
                                        <td class="fw-semibold text-white company-name-cell">{{ $company->name }}</td>
                                        <td>
                                            <a href="/site/{{ $company->slug }}" target="_blank" class="text-decoration-none text-info">
                                                <i class="fa-solid fa-link small me-1"></i>/site/{{ $company->slug }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($company->theme)
                                                <span class="badge bg-secondary px-2 py-1">{{ $company->theme->name }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger px-2 py-1">Seçilmemiş</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" 
                                                        class="btn btn-warning btn-sm fw-medium d-flex align-items-center gap-1"
                                                        onclick="verileriGetirVeModalAc({{ $company->id }})">
                                                    <i class="fa-solid fa-pen-to-square"></i> Düzenle
                                                </button>

                                                <button type="button" 
                                                        class="btn btn-danger btn-sm fw-medium d-flex align-items-center gap-1"
                                                        onclick="firmayıSil({{ $company->id }})">
                                                    <i class="fa-solid fa-trash"></i> Sil
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="modal fade" id="companyEditModal" tabindex="-1">

            <div class="modal-dialog modal-xl modal-dialog-scrollable">

                <div class="modal-content bg-dark text-light border-secondary">

                    <div class="modal-header">

                        <h4 class="modal-title">

                            <i class="fa-solid fa-building text-warning me-2"></i>

                            Firma Bilgilerini Düzenle

                        </h4>

                        <button
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                        </button>

                    </div>

                    <form id="companyEditForm">

                        @csrf

                        <div class="modal-body">

                            <input
                                type="hidden"
                                id="editCompanyId">

                            <!-- Firma -->

                            <h5 class="mb-3 text-success">

                                Firma Bilgileri

                            </h5>

                            <div class="row">

                                <div class="col-md-6">

                                    <label>Firma Adı</label>

                                    <input
                                        id="editCompanyName"
                                        class="form-control bg-dark text-light border-secondary">

                                </div>

                                <div class="col-md-6">

                                    <label>Yönetici Maili</label>

                                    <input
                                        id="editCompanyEmail"
                                        type="email"
                                        class="form-control bg-dark text-light border-secondary">

                                </div>

                            </div>

                            <hr>

                            <!-- Şifre -->

                            <h5 class="mb-3 text-success">

                                Şifre Değiştir

                            </h5>

                            <div class="row">

                                <div class="col-md-4">

                                    <label>Eski Şifre</label>

                                    <input
                                        id="oldPassword"
                                        type="password"
                                        class="form-control bg-dark text-light border-secondary">

                                </div>

                                <div class="col-md-4">

                                    <label>Yeni Şifre</label>

                                    <input
                                        id="newPassword"
                                        type="password"
                                        class="form-control bg-dark text-light border-secondary">

                                </div>

                                <div class="col-md-4">

                                    <label>Yeni Şifre Tekrar</label>

                                    <input
                                        id="newPasswordConfirmation"
                                        type="password"
                                        class="form-control bg-dark text-light border-secondary">

                                </div>

                            </div>

                            <hr>

                            <!-- Telefon -->

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <h5 class="text-success m-0">

                                    Telefonlar

                                </h5>

                                <button
                                    id="btnEditPhone"
                                    type="button"
                                    class="btn btn-success btn-sm">

                                    <i class="fa-solid fa-plus"></i>

                                    Telefon

                                </button>

                            </div>

                            <div id="editPhones"></div>

                            <hr>

                            <!-- Sosyal -->

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <h5 class="text-success m-0">

                                    Sosyal Medya

                                </h5>

                                <button
                                    id="btnEditSocial"
                                    type="button"
                                    class="btn btn-primary btn-sm">

                                    <i class="fa-solid fa-plus"></i>

                                    Sosyal Medya

                                </button>

                            </div>

                            <div id="editSocials"></div>

                        </div>

                        <div class="modal-footer">

                            <button
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                                Vazgeç

                            </button>

                            <button
                                id="btnCompanyUpdate"
                                type="submit"
                                class="btn btn-warning">

                                <i class="fa-solid fa-floppy-disk me-2"></i>

                                Güncelle

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            let companyModal;

            function verileriGetirVeModalAc(id) {

                fetch("/admin/company/get-data/" + id)

                .then(function(response){
                    return response.json();
                })

                .then(function(data){

                    // Firma bilgileri
                    document.getElementById("editCompanyId").value = data.company.id;
                    document.getElementById("editCompanyName").value = data.company.name;
                    document.getElementById("editCompanyEmail").value = data.user.email;

                    // Şifre alanlarını boş bırak
                    document.getElementById("oldPassword").value = "";
                    document.getElementById("newPassword").value = "";
                    document.getElementById("newPasswordConfirmation").value = "";

                    // Telefonları temizle
                    document.getElementById("editPhones").innerHTML = "";

                    // Sosyal medyaları temizle
                    document.getElementById("editSocials").innerHTML = "";

                    // Telefonları oluştur
                    if(data.phones.length > 0) {
                        data.phones.forEach(function(phone){
                            telefonSatiriOlustur(phone);
                        });
                    } else {
                        // Eğer telefon yoksa, en az bir boş satır oluştur
                        telefonSatiriOlustur({type: "cep", number: ""});
                    }

                    // Sosyal medyaları oluştur
                    if(data.socials.length > 0) {
                        data.socials.forEach(function(social){
                            sosyalSatiriOlustur(social);
                        });
                    } else {
                        // Eğer sosyal medya yoksa, en az bir boş satır oluştur
                        sosyalSatiriOlustur({platform: "instagram", url: ""});
                    }

                    companyModal = new bootstrap.Modal(
                        document.getElementById("companyEditModal")
                    );

                    companyModal.show();

                })

                .catch(function(error){

                    console.log(error);

                    Swal.fire(
                        "Hata",
                        "Firma bilgileri alınamadı.",
                        "error"
                    );

                });

            }
            function telefonSatiriOlustur(phone){

                let satir = `

                <div class="row mb-2 telefon-satiri">

                    <div class="col-md-3">

                        <select class="form-select phone-type">

                            <option value="cep" ${phone.type=="cep" ? "selected" : ""}>Cep</option>

                            <option value="sabit" ${phone.type=="sabit" ? "selected" : ""}>Sabit</option>

                            <option value="whatsapp" ${phone.type=="whatsapp" ? "selected" : ""}>WhatsApp</option>

                            <option value="destek" ${phone.type=="destek" ? "selected" : ""}>Destek</option>

                        </select>

                    </div>

                    <div class="col-md-8">

                        <input
                            type="text"
                            class="form-control phone-number"
                            value="${phone.number}">

                    </div>

                    <div class="col-md-1">

                        <button
                            type="button"
                            class="btn btn-danger"

                            onclick="this.closest('.telefon-satiri').remove()">

                            <i class="fa-solid fa-trash"></i>

                        </button>

                    </div>

                </div>

                `;

                document
                    .getElementById("editPhones")
                    .insertAdjacentHTML("beforeend", satir);

            }
            function sosyalSatiriOlustur(social){

                let satir = `

                <div class="row mb-2 sosyal-satiri">

                    <div class="col-md-3">

                        <select class="form-select social-platform">

                            <option value="instagram" ${social.platform=="instagram" ? "selected" : ""}>Instagram</option>

                            <option value="facebook" ${social.platform=="facebook" ? "selected" : ""}>Facebook</option>

                            <option value="x" ${social.platform=="x" ? "selected" : ""}>X</option>

                            <option value="linkedin" ${social.platform=="linkedin" ? "selected" : ""}>LinkedIn</option>

                            <option value="youtube" ${social.platform=="youtube" ? "selected" : ""}>Youtube</option>

                        </select>

                    </div>

                    <div class="col-md-8">

                        <input
                            type="text"
                            class="form-control social-url"
                            value="${social.url}">

                    </div>

                    <div class="col-md-1">

                        <button
                            type="button"
                            class="btn btn-danger"

                            onclick="this.closest('.sosyal-satiri').remove()">

                            <i class="fa-solid fa-trash"></i>

                        </button>

                    </div>

                </div>

                `;

                document
                    .getElementById("editSocials")
                    .insertAdjacentHTML("beforeend", satir);

            }

            // 2. SAYFA YENİLEMEDEN GÜNCELLEME YAPMA
            document.getElementById("companyEditForm").addEventListener("submit", function (e) {

                e.preventDefault();

                firmaGuncelle();

            });
            function firmaGuncelle() {
                let id = document.getElementById("editCompanyId").value;
                let name = document.getElementById("editCompanyName").value;
                let email = document.getElementById("editCompanyEmail").value;
                let oldPassword = document.getElementById("oldPassword").value;
                let newPassword = document.getElementById("newPassword").value;
                let newPasswordConfirmation =
                    document.getElementById("newPasswordConfirmation").value;


                let phones = [];
                let socials = [];

                // Telefonları al
                document.querySelectorAll(".telefon-satiri").forEach(function (row) {

                    phones.push({
                        type: row.querySelector(".phone-type").value,
                        number: row.querySelector(".phone-number").value
                    });

                });

                // Sosyal Medyaları al
                document.querySelectorAll(".sosyal-satiri").forEach(function (row) {
                    socials.push({
                        platform: row.querySelector(".social-platform").value,
                        url: row.querySelector(".social-url").value
                    });

                });

                let token = document.querySelector('input[name="_token"]').value;

                fetch("/admin/company/update/" + id, {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                        "Accept": "application/json"
                    },

                    body: JSON.stringify({
                        name: name,
                        email: email,
                        old_password: oldPassword,
                        new_password: newPassword,
                        new_password_confirmation: newPasswordConfirmation,
                        phones: phones,
                        socials: socials
                    })

                })

                .then(function (response) {

                    return response.json();

                })

                .then(function (data) {

                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Başarılı",
                            text: data.message
                        });
                        companyModal.hide();
                        document.querySelector(
                            "#company-row-" + id + " .company-name-cell"
                        ).innerText = name;
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Hata",
                            text: data.message
                        });
                    }
                })

                .catch(function (error) {
                    console.log(error);
                    Swal.fire({
                        icon: "error",
                        title: "Hata",
                        text: "Bir hata oluştu."
                    });
                });
            }

            // 3. SAYFA SİLME İŞLEMİ
            function firmayıSil(companyId) {
                const token = document.querySelector('input[name="_token"]').value;

                Swal.fire({
                    title: 'Emin misin knk?',
                    text: "Bu firmayı ve ona bağlı yönetici hesabını tamamen sileceksin!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Evet, kökten sil!',
                    cancelButtonText: 'İptal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('/admin/company/delete/' + companyId, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': token
                            }
                        })
                        .then(response => {
                            if(response.ok) {
                                // Sayfayı yenilemeden satırı DOM'dan pürüzsüzce kaldırıyoruz
                                const silinecekSatir = document.getElementById('company-row-' + companyId);
                                if(silinecekSatir) {
                                    silinecekSatir.remove();
                                }

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Silindi!',
                                    text: 'Firma sistemden tamamen temizlendi.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                throw new Error('Silme başarısız.');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire({ icon: 'error', title: 'Hata!', text: 'Silme işlemi sırasında bir sorun çıktı!', confirmButtonColor: '#10b981' });
                        });
                    }
                });
            }

        let sosyalSatirIndex = 1;
        let telefonSatirIndex = 1;
        document.addEventListener("DOMContentLoaded", function() {
            
            // 1. Telefon Satırı Ekleme
            const btnTelefonEkle = document.getElementById('btn-telefon-ekle');
            const telKonteyner = document.getElementById('telefon-numarasi-satirlari');

            if (btnTelefonEkle && telKonteyner) {
                btnTelefonEkle.addEventListener('click', function(e) {
                    e.preventDefault(); 
                    
                    const yeniSatir = document.createElement('div');
                    yeniSatir.className = 'row g-2 mb-2 telefon-input-satir';
                    yeniSatir.innerHTML = `
                        <div class="col-md-3">
                            <select name="phones[${telefonSatirIndex}][type]" class="form-select bg-dark border-secondary text-light custom-input">
                                <option value="cep">Cep Telefonu</option>
                                <option value="sabit">Sabit Hat</option>
                                <option value="whatsapp">WhatsApp Hattı</option>
                                <option value="destek">Müşteri Destek</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="phones[${telefonSatirIndex}][number]" class="form-control bg-dark border-secondary text-light custom-input" placeholder="Örn: 0555 555 55 55" required>
                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn btn-outline-danger border-0" onclick="this.closest('.telefon-input-satir').remove()">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    `;
                    telKonteyner.appendChild(yeniSatir);
                    telefonSatirIndex++; 
                });
            }
            document.getElementById("btnEditPhone").addEventListener("click", function () {

                let phone = {
                    type: "cep",
                    number: ""
                };
                telefonSatiriOlustur(phone);
            });
            document.getElementById("btnEditSocial").addEventListener("click", function () {

                let social = {
                    platform: "instagram",
                    url: ""
                };
                sosyalSatiriOlustur(social);
            });

            // 2. DİNAMİK SOSYAL MEDYA SATIRI EKLEME MECHANISM
            const btnSosyalEkle = document.getElementById('btn-sosyal-ekle');
            const sosyalKonteyner = document.getElementById('sosyal-medya-satirlari');

            if (btnSosyalEkle && sosyalKonteyner) {
                btnSosyalEkle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const yeniSatir = document.createElement('div');
                    yeniSatir.className = 'row g-2 mb-2 sosyal-input-satir';
                    yeniSatir.innerHTML = `
                        <div class="col-md-3">
                            <select name="socials[${sosyalSatirIndex}][platform]" class="form-select bg-dark border-secondary text-light custom-input">
                                <option value="instagram">Instagram</option>
                                <option value="x">X / Twitter</option>
                                <option value="linkedin">LinkedIn</option>
                                <option value="youtube">YouTube</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <input type="url" name="socials[${sosyalSatirIndex}][url]" class="form-control bg-dark border-secondary text-light custom-input" placeholder="https://..." required>
                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn btn-outline-danger border-0" onclick="this.closest('.sosyal-input-satir').remove()">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    `;
                    sosyalKonteyner.appendChild(yeniSatir);
                    sosyalSatirIndex++;
                });
            }
        });
        </script>
    </body>
    </html>