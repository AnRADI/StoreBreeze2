<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Cart;

class CategoryController extends Controller
{

	public $category;

	public function __construct()
	{
		$this->category = new Category();
	}


	// ---------- /{category} -----------

	public function category($categorySlug) {

		$category = $this->category
			->firstCategoryProductsC($categorySlug);

		if(empty($category)) abort(404);

		$category->products->loadMissing('categories:id,slug');


		return Inertia::render('Shop/Category', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'category' => $category,
		]);
	}


	// ---------- /categories -----------

	public function categories() {

		$categories = $this->category
			->getCategoriesCs();


		return Inertia::render('Shop/Categories', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'categories' => $categories
		]);
	}
}
