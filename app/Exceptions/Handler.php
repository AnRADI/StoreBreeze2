<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }



	public function render($request, Throwable $e) {

    	$response = parent::render($request, $e);


    	if($response->status() == 419) {

    		$request->session()->flash('message419', 'Сессия истекла');

			if (App::environment('local'))
				return Inertia::location('http://praktiww.beget.tech.local:3000/login');
			else
				return Inertia::location('http://praktiww.beget.tech.local/login');
		}


		return $response;
	}
}
