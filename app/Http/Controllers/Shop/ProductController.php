<?php

namespace App\Http\Controllers\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Cart;


class ProductController extends Controller
{
	public $product;

	public function __construct() {

		$this->product = new Product;
	}


	// ---------- /{category}/{product} -----------

	public function product($categorySlug, $productCode)
	{
		$product = $this->product
			->firstProductCategoriesCP($productCode);


		$isCategoryProduct = false;
		$categoryName = '';

		foreach($product->categories as $category) {

			if($product && ($categorySlug === $category->slug)) {

				$isCategoryProduct = true;
				$categoryName = $category->name;

				break;
			};
		}


		if(empty($isCategoryProduct)) abort(404);


		return Inertia::render('Shop/Product', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'product' => $product,
			'categorySlug' => $categorySlug,
			'categoryName' => $categoryName
		]);
	}
}
