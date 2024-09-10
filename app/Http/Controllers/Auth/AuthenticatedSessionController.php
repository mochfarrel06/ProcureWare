<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->role === 'manager_a') {
            session()->flash('success', 'Berhasil masuk aplikasi');
            return redirect()->intended(RouteServiceProvider::DASHBOARD);
        } else if ($request->user()->role === 'manager_b') {
            session()->flash('success', 'Berhasil masuk aplikasi');
            return redirect()->intended(RouteServiceProvider::DASHBOARD);
        } else if ($request->user()->role === 'staff_purchase') {
            session()->flash('success', 'Berhasil masuk aplikasi');
            return redirect()->intended(RouteServiceProvider::PURCHASE);
        } else if ($request->user()->role === 'staff_warehouse') {
            session()->flash('success', 'Berhasil masuk aplikasi');
            return redirect()->intended(RouteServiceProvider::WAREHOUSE);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
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
