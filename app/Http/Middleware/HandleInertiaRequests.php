<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Cart;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {

        return parent::version($request);
    }



    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {

        return array_merge(parent::share($request), [

            'auth' => [
                'user' => fn() => $request->user(),
            ],

			'flash' => [
				'message' => fn() => session()->get('success'),
				'message419' => fn() => session()->get('message419'),
			],

			'cartCollection' => fn() => Cart::get(),

			'currentRouteName' => fn() => \Route::currentRouteName(),

			'permissions' => fn() => $request->user()->getAllPermissions(),

			'translations' => fn() =>
				translations(
					resource_path('lang/'. app()->getLocale() .'.json')
				),
        ]);
    }
}
