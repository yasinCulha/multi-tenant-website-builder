<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
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

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
