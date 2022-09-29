<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Cart;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {

        return Inertia::render('Auth/Login', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();


		// ------ Merge carts (db and session) -------

        Cart::mergeCarts();


		if($request->user()->hasRole('admin'))
			return Inertia::location(route(RouteServiceProvider::ADMIN_HOME));

		else
			return redirect()->route(RouteServiceProvider::SHOP_HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {

		// ------- Get data before logout ------

		$isAdmin = $request
			->user()
			->hasRole('admin');

		$cartCollection = Cart::get();


		// ------- Logout and remove all session data -------

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        // ------- Set data ------

		session()->put('cartCollection', $cartCollection);


		if($isAdmin)
			return Inertia::location(route(RouteServiceProvider::SHOP_HOME));

		else
			return redirect()->route(RouteServiceProvider::SHOP_HOME);
    }
}
