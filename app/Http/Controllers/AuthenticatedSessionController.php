<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        // return Inertia::render('Auth/Login', [
        //     'canResetPassword' => Route::has('password.request'),
        //     'status' => session('status'),
        // ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(Request $request)
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     if ($request->user()->email === 'admin@gmail.com') {
    //         return redirect()->intended(route('admin', absolute: false));
    //     } else {

    //         return redirect()->intended(route('home', absolute: false));
    //     }

    // }

    // /**
    //  * Destroy an authenticated session.
    //  */
    // public function destroy(Request $request)
    // {
    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }
}
