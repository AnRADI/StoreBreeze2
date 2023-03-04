<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class TestException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {

		return response()->json(['error' => $this->getMessage()]);
		//return response()->json([1 => 2, 'sfddfs' => 'fdf'])->header('Content-Type', 'application/json');
    }
}
