<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

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
		if(Cache::has('locale')) {

			//$user = $request->user();

			//if($user->hasRole(['guest', 'user'])) {

				App::setLocale(Cache::get('locale'));
			//}
		}

        return $next($request);
    }
}
