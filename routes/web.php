<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Services\ThemeManager;
use App\Services\ThemeRenderer;
use App\Models\CompanyThemeSetting;

// Ana Sayfa (Tanıtım)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/login', function(){abort(404);});


//Süper Admin Giriş Sayfası
Route::get('admin-login',[AdminController::class, 'adminLoginForm'])->name('admin.login');// login urli canlıya alma zamanı güncelle
//Süper Admin Post Aksiyonu
Route::post('admin-login',[AdminController::class, 'adminLoginPost'])->name('admin.login.submit');
Route::post('admin-logout',[AdminController::class, 'adminLogout'])->name('admin.logout');



// Giriş Yapmış Kullanıcılar

Route::middleware(['auth'])->group(function () {

    // Süper Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');  

    Route::post('/admin/company/store', [AdminController::class, 'storeCompany']);

    Route::get('/admin/company/get-data/{id}', [AdminController::class, 'getCompanyData']);

    Route::post('/admin/company/update/{id}', [AdminController::class, 'updateCompany']);

    Route::post('/admin/company/delete/{id}', [AdminController::class, 'deleteCompany']); 

});

// Firma Paneli
Route::get('/company/dashboard', [AdminController::class, 'companyDashboard'])->name('dashboard');

Route::get('/company/theme-editor/{theme}', [AdminController::class, 'themeEditor'])->name('company.theme.editor');
Route::post('/company/theme/update', [AdminController::class, 'updateTheme'])->name('company.theme.update');

// Firma Web Sitesi


Route::get('/site/{slug}', [AdminController::class, 'showTenantSite']);

Route::post('/site/{slug}/contact', [AdminController::class, 'handleContactForm'])->name('site.contact.submit');
Route::get('/site/theme-preview/{themeId}', [AdminController::class, 'themePreview'])->name('theme.preview');
Route::get('/company/theme-editor/{theme}',[AdminController::class, 'themeEditor'])->name('company.theme.editor');
Route::post('/company/theme/save',[AdminController::class, 'saveTheme'])->name('company.theme.save');

//MÜŞTERİ SUBDOMAINLERİ İÇİN ROTA GRUBU
Route::domain('{subdomain}.apollonmedya.net')->group(function () {

    // Birisi direkt test.apollonmedya.net olarak ana sayfaya geldiğinde çalışacak rota
    Route::get('/', function ($subdomain) {
        dd('DOMAIN ROUTE', $subdomain);
    });
    Route::get('/host-test', function () {
    dd('DOMAIN ROUTE',
            $subdomain,
            request()->getHost());
});
    
    
    // İleride firmanın sitesi içindeki diğer sayfalar için (Örn: test.apollonmedya.net/hakkimizda)
    // Route::get('/hakkimizda', [FrontendController::class, 'showAboutPage']);
});

require __DIR__.'/auth.php';