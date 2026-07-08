<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyThemeSetting;
use App\Services\ThemeManager;
use App\Services\ThemeEngine;
use App\Services\ThemeRenderer;

class AdminController extends Controller
{
    public function adminLoginForm()
    {
        // Eğer zaten giriş yapmış bir Süper Admin ise direkt Yönetim Merkezi'
        if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect('/admin'); 
        }
        
        return view('auth.admin_login');
    }
    // 2. Süper Admin Giriş İşlemini Yönet
    public function adminLoginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
       
        if (Auth::attempt($credentials, $request->has('remember'))) 
        {

            
            // KRİTİK KONTROL: Giriş yapan kişi Süper Admin DEĞİLSE hemen dışarı atıyoruz!
            if (Auth::user()->role != 'admin') { 
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Bu gizli kapı yalnızca Süper Admin yetkililerine özeldir knk!'
                ])->withInput();
            }

            // Kişi Süper Admin ise Yönetim Merkezine başarıyla ulaşıyor
            $request->session()->regenerate();
            return redirect()->route('admin.index'); 
        }
        return back()->withErrors([
            'email' => 'E-posta veya şifre yanlış.'
        ])->withInput();
    }
    public function adminLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin-login');
    }
    // Admin panelinin ana sayfası
    public function index()
    {
        // Giriş yapan kişinin rolü 'admin' değilse, paneli gösterme, ana sayfaya fırlat!
        if (auth()->user()->role !== 'admin') {
            return view('tenant.website.admin.dashboard.index');
        }

        $companies = Company::with('theme')->get();
        $themes = Theme::all();
        return view('admin.index', compact('companies', 'themes'));
    }

    // firma login ekranı 
    public function companyLoginPost(Request $request)
    {
        // 1. Validasyon kontrolü
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'E-posta adresi zorunludur.',
            'password.required' => 'Şifre alanı boş bırakılamaz.',
        ]);

        $credentials = $request->only('email', 'password');

        // 2. Giriş denemesi
        if (Auth::attempt($credentials, $request->has('remember'))) {
            
            // 3. SÜPER ADMIN KORUMASI: Giriş yapan kişi süper admin ise kovuyoruz knk
            if (Auth::user()->role == 'admin') { 
                Auth::logout(); // Oturumu hemen kapat
                
                return back()->withErrors([
                    'email' => 'Geçersiz Giriş'
                ])->withInput();
            }

            // 4. Kullanıcı süper admin değilse normal firmadır, paneline fırlat
            $request->session()->regenerate();
            return redirect()->intended('/company/dashboard'); // Firmanın ana paneli nereye çıkıyorsa
        }

        // Bilgiler tamamen hatalıysa
        return back()->withErrors([
            'email' => 'Girdiğiniz bilgiler sistemdeki hiçbir firma kullanıcısı ile eşleşmedi.',
        ])->withInput();
    }

    // Formdan gelen verilerle Yeni Firma ve Kullanıcı oluşturan fonksiyon
    public function storeCompany(Request $request)
    {
        // 1. Firma adından URL dostu bir slug üretiyoruz (
        $slug = Str::slug($request->company_name);

        // 2. Firmayı oluşturuyoruz
        $company = Company::create([
            'name' => $request->company_name,
            'slug' => $slug,
            'theme_id' => null,
            'settings' => [

                'hero' => [

                    'title' => 'Hoş Geldiniz',

                    'subtitle' => 'Web sitenize hoş geldiniz.',

                    'button' => 'Bize Ulaşın'

                ],

                'about' => [

                    'title' => 'Hakkımızda',

                    'text' => 'Hakkımızda yazınızı buraya ekleyebilirsiniz.'

                ],

                'footer' => [

                    'text' => '© 2026 Tüm Hakları Saklıdır.'

                ],

                'colors' => [

                    'primary' => '#10B981',

                    'secondary' => '#1F2937',

                    'background' => '#FFFFFF'

                ]

            ]
        ]);
        if($request->has('socials')) {
            foreach ($request->socials as $social) {
                if (!empty($social['url'])) {
                    $company->socialMedias()->create([
                        'platform' => $social['platform'],
                        'url' => $social['url']
                    ]);
                }
            }
        }
        if($request->has('phones')){
            foreach ($request->phones as $phone) {
                if (!empty($phone['number'])) {
                    $company->phones()->create([
                        'type' => $phone['type'],
                        'number' => $phone['number']
                    ]);
                }
            }
        }

        // 3. Bu firmaya ait yöneticiyi (Tenant) oluşturup firmaya bağlıyoruz
        User::create([
            'name' => $request->company_name . ' Yöneticisi',
            'email' => $request->user_email,
            'password' => Hash::make($request->user_password),
            'role' => 'tenant',
            'company_id' => $company->id // İşte firmayı kullanıcıya bağladık!
        ]);

        // İşlem bitince sayfayı yenile ve başarı mesajı ver
        return redirect()->back()->with('success', 'Firma ve Kullanıcı başarıyla oluşturuldu!');
    }
    public function getCompanyData($id)
    {
    $company = Company::with([
        'phones',
        'socialMedias',
        'users'
    ])->findOrFail($id);

    return response()->json([
        'company' => [
            'id'   => $company->id,
            'name' => $company->name,
            'slug' => $company->slug,
        ],

        'user' => [
            'email' => optional($company->users->first())->email,
        ],

        'phones' => $company->phones,

        'socials' => $company->socialMedias
    ]);
    }
    public function updateCompany(Request $request, $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Firma bulunamadı.'
            ], 404);
        }

        $user = $company->users()->first();
        DB::beginTransaction();

        try {
            // Firma bilgileri
            $company->name = $request->name;
            $company->save();

            //firma adı boş mu kontrolü
            if (empty($request->name)) {

                return response()->json([
                    'success' => false,
                    'message' => 'Firma adı boş bırakılamaz.'
                ], 400);
            }

            // Kullanıcı maili
            if ($user) {
                $user->email = $request->email;
            }
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){

                    return response()->json([
                        'success' => false,
                        'message' => 'Geçerli bir e-posta adresi girin.'
                    ], 400);

                }

            // ŞİFRE DEĞİŞTİRME
            if (!empty($request->new_password)) {

                if (!Hash::check($request->old_password, $user->password)) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Eski şifre yanlış.'
                    ], 400);

                }

                if ($request->new_password != $request->new_password_confirmation) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Yeni şifreler uyuşmuyor.'
                    ], 400);

                }
                if(strlen($request->new_password) < 8){

                    return response()->json([
                        'success' => false,
                        'message' => 'Yeni şifre en az 8 karakter olmalıdır.'
                    ], 400);
                }
                $user->password = Hash::make($request->new_password);
            }

            if ($user) {
                $user->save();
            }

            // TELEFONLAR
            $company->phones()->delete();

            if ($request->phones) {

                foreach ($request->phones as $phone) {

                    if (!empty($phone['number'])) {

                        $company->phones()->create([

                            'type' => $phone['type'],

                            'number' => $phone['number']

                        ]);

                    }

                }

            }

        //SOSYAL MEDYA
        $company->socialMedias()->delete();

        if ($request->socials) {

            foreach ($request->socials as $social) {

                if (!empty($social['url'])) {

                    $company->socialMedias()->create([

                        'platform' => $social['platform'],

                        'url' => $social['url']

                    ]);

                }

            }

        }

        DB::commit();

        return response()->json([

            'success' => true,

            'message' => 'Firma başarıyla güncellendi.'

        ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ],500);

        }
    }
    public function deleteCompany($id)
    {
        $company = Company::findOrFail($id);

        // Firma ile ilişkili kullanıcıları sil
        $company->users()->delete();

        // Firma kaydını sil
        $company->delete();

        return response()->json([
            'success' => true,
            'message' => 'Firma ve ilişkili kullanıcılar başarıyla silindi.'
        ], 200);
    }

    
    //TENANT SECTİON
// Sadece parametre adını $slug yerine $subdomain yapıyoruz knk, gerisi NOKTASINA kadar aynı!
public function showTenantSite($subdomain, ThemeManager $themeManager)
{
    // Firmayı bul (Burada artık veritabanındaki 'slug' sütununa tarayıcıdan gelen $subdomain'i soruyoruz)
    $company = Company::where('slug', $subdomain)->firstOrFail();
    if (!$company) {
         return response()->view('errors.tenant-not-found', [
        'subdomain' => $subdomain,
    ], 404);
    }

    // Aktif tema
    $theme = $company->theme;

    if (!$theme) {
        abort(404, 'Tema bulunamadı.');
    }

    // Firma ayarları
    $themeSetting = CompanyThemeSetting::where(
        'company_id',
        $company->id
    )->first();

    // Default ayarlar
    $defaultSettings = $themeManager->defaults($theme->folder_path);

    // Veritabanındaki ayarlar
    $companySettings = $themeSetting?->settings ?? [];

    // Default + Firma ayarlarını birleştir
    $settings = array_replace_recursive(
        $defaultSettings,
        $companySettings
    );

    return view("tenant.website.themes.{$theme->folder_path}.index", [
        'company'  => $company,
        'settings' => $settings,
    ]);
}
    public function companyDashboard()
    {
        // Giriş yapan kullanıcının firmasını çekiyoruz
        $company = auth()->user()->company;
        
        // Firma yoksa (ana adminsse veya hatayla oluştuysa) ana sayfaya at
        if (!$company) {
            return redirect('/admin');
        }

        // tüm temaları listeliyoruz
        $themes = Theme::all();

        return view('tenant.website.admin.dashboard.index', compact('company', 'themes'));
    }

    // Firma sahibinin formdan seçtiği temayı veri tabanına kaydeden fonksiyon
    public function updateTheme(Request $request,ThemeEngine $themeEngine,ThemeManager $themeManager)
    {
        $company = auth()->user()->company;

        if (!$company) {
            return back()->with('error', 'Firma bulunamadı.');
        }

        $theme = Theme::findOrFail($request->theme_id);

        $themeEngine->activateTheme(
            $company,
            $theme
        );

        return redirect()->back()
            // ->route(
            //     'company.theme.editor',
            //     $theme->id
            // )
            ->with(
                'success',
                'Tema başarıyla seçildi.'
            );
    }
    public function themeEditor(Theme $theme, ThemeManager $themeManager)
{
    $company = auth()->user()->company;

    if (!$company) {
        return back()->with('error', 'Firma bulunamadı.');
    }

    $themeSetting = CompanyThemeSetting::where(
        'company_id',
        $company->id
    )->first();

    if (!$themeSetting) {
        return back()->with('error', 'Tema ayarı bulunamadı.');
    }

    $defaultSettings = $themeManager->defaults($theme->folder_path);

    $dbSettings = $themeSetting->settings ?? [];

    $settings = array_replace_recursive(
        $defaultSettings,
        $dbSettings
    );
    return view('tenant.editor.index', [
        'company'  => $company,
        'theme'    => $theme,
        'editor'   => $themeManager->editor($theme->folder_path),
        'settings' => $settings,
    ]);
}
   public function saveTheme(Request $request)
{
    $company = auth()->user()->company;

    if (!$company) {
        return response()->json([
            'success' => false,
            'message' => 'Firma bulunamadı.'
        ], 404);
    }

    $themeSetting = CompanyThemeSetting::where(
        'company_id',
        $company->id
    )->firstOrFail();

    // Gelen JSON verisini settings alanına yazıyoruz
    $themeSetting->settings = $request->settings;
    $themeSetting->save(); // Veritabanına kaydetmeyi aktif ettik knk

    return response()->json([
        'success' => true,
        'message' => 'Tema başarıyla kaydedildi knk.',
        // Debug etmek istediğin verileri buraya koy ki JS konsolunda görebil:
        'debug_data_type' => gettype($request->settings),
        'debug_data' => $request->settings
    ]);
}
    
    public function handleContactForm(Request $request, $slug)
    {
        // URL'deki slug ile veri tabanındaki firmayı eşleştiriyoruz
        
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-ZçÇğĞıİöÖşŞüÜ\s]+$/',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'Lütfen adınızı girin.',
            'name.regex' => 'Adınız sadece harflerden oluşmalıdır.',
            'email.required' => 'Lütfen e-posta adresinizi girin.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi girin.',
            'subject.required' => 'Lütfen konuyu girin.',
            'message.required' => 'Lütfen mesajınızı girin.',
        ]);

        // DB kayıt işlemleri veya mail gönderme kodların varsa tam bu araya gelebilir.

        // Sayfa yenilemeden çalışan Fetch API'ye başarılı yanıtı fırlatıyoruz:
        return response()->json([
            'success' => true,
            'message' => 'Mesajınız başarıyla gönderildi! Teşekkür ederiz.'
        ], 200);
    }
   public function themePreview($themeId)
{
    $theme = Theme::findOrFail($themeId);

    $viewPath = 'themes.' . $theme->slug . '.index';


    // View kontrolü
    if (!view()->exists( $viewPath)) {
        // Hata durumunda Laravel'in aradığı gerçek klasör yolunu gösterelim
        $displayPath = 'resources/views/' . str_replace('.', '/',  $viewPath) . '.blade.php';
        return "<code>" . $displayPath . "</code> dosyası bulunamadı, klasör veya dosya adını kontrol et!";
    }

    $company = Company::with(['socialMedias','phones'])->first(); 

    if (!$company) {
        $company = new \stdClass();
        $company->name = "Örnek Firma Adı (Ön İzleme)";
        $company->slug = "ornek-firma";
        $company->phones = collect([]);
        $company->email = "info@ornekfirma.com";
        $company->about = "Bu bir tema ön izleme alanıdır. Sistemde kayıtlı firma bulunduğunda buradaki veriler dinamik olarak değişecektir.";
        $company->socialMedias = collect([]);
    }
    
    $settings='';
    // Doğru klasör rotasıyla view'ı döndürüyoruz
    return view( $viewPath, compact('theme', 'company','settings'));
}

    
}