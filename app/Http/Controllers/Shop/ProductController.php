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
			->getProductCategoryPro($productCode);


		if(
			empty($product && ($categorySlug === $product->category->slug))
		) abort(404);


		$cartCollection = Cart::get();


		return Inertia::render('Shop/Product', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'product' => $product,
			'cartCollection' => $cartCollection
		]);
	}
}
