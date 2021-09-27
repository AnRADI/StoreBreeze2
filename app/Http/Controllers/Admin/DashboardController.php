<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Category;


class DashboardController extends Controller
{

	// ---------- /dashboard -----------

	public function dashboard(Request $request) {

		$categoriesCount = Category::get()->count();

		return Inertia::render('Admin/Dashboard', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'categoriesCount' => $categoriesCount,
		]);
	}
}
