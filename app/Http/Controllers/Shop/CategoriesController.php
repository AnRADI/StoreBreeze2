<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class CategoriesController extends Controller
{

	public $category;

	public function __construct()
	{
		$this->category = new Category();
	}


	// ---------- /categories -----------

	public function index() {

		$categories = $this->category
			->getCategoriesC();



		return Inertia::render('Shop/Categories', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'categories' => $categories,
		]);
	}
}
