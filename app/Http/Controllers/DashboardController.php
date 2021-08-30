<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Auth;
use Cart;

class DashboardController extends Controller
{

	// ---------- /dashboard -----------

	public function dashboard(Request $request) {



		return Inertia::render('Dashboard', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
		]);
	}
}
