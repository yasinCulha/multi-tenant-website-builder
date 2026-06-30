<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Admin panelinin ana sayfası
    public function index()
    {
        // Giriş yapan kişinin rolü 'admin' değilse, paneli gösterme, ana sayfaya fırlat!
        if (auth()->user()->role !== 'admin') {
            return redirect('/tenant/dashboard');
        }

        $companies = Company::with('theme')->get();
        $themes = Theme::all();
        return view('admin.index', compact('companies', 'themes'));
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
            'theme_id' => null
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
    public function showTenantSite($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();

        if($company->theme){
            $themePath = $company->theme->folder_path;
        } else {
            $themePath = 'themes.corporate_blue';
        }

        // Dinamik olarak o temanın blade dosyasını yüklüyor ve içine firma verilerini gönderiyoruz
        return view($themePath, compact('company'));
    }
    public function tenantDashboard()
    {
        // Giriş yapan kullanıcının firmasını çekiyoruz
        $company = auth()->user()->company;
        
        // Firma yoksa (ana adminsse veya hatayla oluştuysa) ana sayfaya at
        if (!$company) {
            return redirect('/admin');
        }

        // tüm temaları listeliyoruz
        $themes = Theme::all();

        return view('tenant.dashboard', compact('company', 'themes'));
    }

    // Firma sahibinin formdan seçtiği temayı veri tabanına kaydeden fonksiyon
    public function updateTheme(Request $request)
    {
        $company = auth()->user()->company;

        if ($company) {
            $company->update([
                'theme_id' => $request->theme_id
            ]);
        }

        return redirect()->back()->with('success', 'Web sitenizin teması başarıyla güncellendi!');
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
        $viewPath = str_replace('/', '.', $theme->folder_path);

        if (!view()->exists($viewPath)) {
            return "<code>resources/views/" . str_replace('.', '/', $viewPath) . ".blade.php</i> dosyası bulunamadı, adını kontrol et!";
        }

        $company = Company::with(['socialMedias','phones'])->first(); 

        if (!$company) {
            // Eğer veritabanın tamamen boşsa, hata vermemesi için geçici nesne oluşturuyoruz
            $company = new \stdClass();
            $company->name = "Örnek Firma Adı (Ön İzleme)";
            $company->slug = "ornek-firma";
            $company->phones = collect([]);
            $company->email = "info@ornekfirma.com";
            $company->about = "Bu bir tema ön izleme alanıdır. Sistemde kayıtlı firma bulunduğunda buradaki veriler dinamik olarak değişecektir.";
            $company->socialMedias=collect([]);
        }
        return view($viewPath, compact('theme','company'));
    }
}