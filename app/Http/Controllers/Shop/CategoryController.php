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
			->getCategoryProducts($categorySlug);

		if(empty($category)) abort(404);

		$category->products->loadMissing('category:id,slug');


		$cartCollection = Cart::get();


		return Inertia::render('Shop/Category', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'category' => $category,
			'cartCollection' => $cartCollection
		]);
	}
}
