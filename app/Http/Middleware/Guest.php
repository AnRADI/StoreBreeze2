<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

		$guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

        	$authGuardUser = Auth::guard($guard)->user();

			if ($authGuardUser->hasRole('user')) {

				return redirect()->route(RouteServiceProvider::SHOP_HOME);
			}
            if ($authGuardUser->hasRole('admin')) {

                return redirect()->route(RouteServiceProvider::ADMIN_HOME);
            }
        }

        return $next($request);
    }
}
