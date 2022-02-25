<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\TestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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


		if($request
			->user()
			->hasRole('admin')
		)
			if (App::environment('local'))
				return Inertia::location('http://praktiww.beget.tech.local:3000/dashboard');
			else
				return Inertia::location('http://praktiww.beget.tech.local/dashboard');

		else
			return redirect()->route(RouteServiceProvider::SHOP_HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
    	// get session data
		$cartCollection = Cart::get();
		$locale = session('locale');

		// logout and remove all session data
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // put session data
		session()->put('cartCollection', $cartCollection);
        session()->put('locale', $locale);
        // ----------------

		if (App::environment('local'))
			return Inertia::location('http://praktiww.beget.tech.local:3000');
		else
			return Inertia::location('http://praktiww.beget.tech.local');
    }
}
