<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Services\ThemeManager;
use App\Services\ThemeRenderer;
use App\Models\CompanyThemeSetting;
use App\Http\Controllers\BuilderPreviewController;
use App\Http\Controllers\PageBuilderController;

// Ana Sayfa (Tanıtım)

Route::domain('apollonmedya.net')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

});
Route::domain('www.apollonmedya.net')->group(function () {

    Route::get('/', function () {
        return redirect()->route('welcome');
    });

});
Route::domain('lara.apollonmedya.net')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

});


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

Route::get('/company/builder', [PageBuilderController::class, 'index'])->name('tenant.builder');
Route::get('/company/builder/preview', BuilderPreviewController::class)->name('builder.preview');
Route::post('/company/page-builder/add-module', [PageBuilderController::class, 'addModuleToPage']);
Route::delete('/company/page-builder/modules/{pageModule}', [PageBuilderController::class, 'destroyModule'])->name('builder.modules.destroy');
Route::get('/company/preview/{page}', [PageBuilderController::class, 'preview'])->name('tenant.preview');
Route::post('/company/builder/pages', [PageBuilderController::class, 'storePage'])->name('builder.pages.store');
Route::delete('/company/builder/pages/{page}', [PageBuilderController::class, 'destroyPage'])->name('builder.pages.destroy');
Route::post('/company/builder/save', [PageBuilderController::class, 'save'])->name('builder.save');

//MÜŞTERİ SUBDOMAINLERİ İÇİN ROTA GRUBU
Route::domain('{subdomain}.apollonmedya.net')->group(function () {

    // Birisi direkt test.apollonmedya.net olarak ana sayfaya geldiğinde çalışacak rota
    Route::get('/',[AdminController::class, 'showTenantSite'] );
    
});

require __DIR__.'/auth.php';
