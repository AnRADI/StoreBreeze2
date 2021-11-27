<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
		if(session()->has('locale')) {

			//$user = $request->user();

			//if($user->hasRole(['guest', 'user'])) {

				App::setLocale(session('locale'));
			//}
		}

        return $next($request);
    }
}
