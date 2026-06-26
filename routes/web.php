<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Sitenin ana sayfasına gelindiğinde direkt Giriş Ekranı açılsın
Route::get('/', function () {
    return view('auth.login');
});

/**
 * 1. KORUMALI ALAN (MIDDLEWARE: AUTH)
 * Giriş yapmış kullanıcıların yönlendirileceği ve işlem yapacağı alanlar.
 */
Route::middleware(['auth'])->group(function () {
    
    // Ana Admin Paneli Rotaları
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/company/store', [AdminController::class, 'storeCompany']);
    Route::get('/admin/company/get-data/{id}', [AdminController::class, 'getCompanyData']);
    Route::post('/admin/company/update/{id}', [AdminController::class, 'updateCompany']);
    Route::post('/admin/company/delete/{id}', [AdminController::class, 'deleteCompany']);
    
    // KULLANICI (TENANT) PANELİ ROTALARI
    Route::get('/tenant/dashboard', [AdminController::class, 'tenantDashboard'])->name('dashboard');
    Route::post('/tenant/theme/update', [AdminController::class, 'updateTheme']);
    
});

/**
 * 2. SİTE ROTA (TENANT)
 */
// Dinamik firma sitelerini açacak dış rota
Route::get('/site/{slug}', [AdminController::class, 'showTenantSite']);
Route::post('/site/{slug}/contact', [AdminController::class, 'handleContactForm'])->name('site.contact.submit');
Route::get('/site/theme-preview/{themeId}', [AdminController::class, 'themePreview'])->name('theme.preview');


/**
 * 3. LARAVEL BREEZE AUTH ROTASI
 */
require __DIR__.'/auth.php';