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

        return redirect()->intended(RouteServiceProvider::HOME);
////        $request->authenticate();
////
////        $request->session()->regenerate();
////
////        return redirect()->intended(RouteServiceProvider::HOME);
//
//
//        // dd(Hash::make('mohamedashrafelbayoumi@gmail.com'));
//        $credentials = $request->only('email', 'password');
////         dd($credentials);
//        // dd(Hash::make('admin@gmail.com'));
//        // dd(Auth::guard('web')->attempt($credentials));
//        if (Auth::guard('web')->attempt($credentials)) {
//
//            return redirect()->intended(RouteServiceProvider::HOME);
//
//        }
//
//        if (Auth::guard('admin')->attempt($credentials)) {
//
//            return redirect()->intended(RouteServiceProvider::ADMIN);
//        }
//
//        return back()->withErrors(['email' => 'Invalid credentials']);
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
