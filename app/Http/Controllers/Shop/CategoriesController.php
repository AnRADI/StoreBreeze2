<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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

	public function categories() {

		$categories = $this->category
			->getCategories();


		return Inertia::render('Shop/Categories', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'categories' => $categories
		]);
	}
}
