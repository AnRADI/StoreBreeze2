<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
	public $product;

	public function __construct() {

		$this->product = new Product;
	}


	// ---------- /products -----------

	public function show($category, $product) {


		// ------ Find product->categories -------

		$product =	$this->product
				->firstProductCategoriesCP($category, $product);

		if(empty($product && $product->categories->count())) abort(404);


		return Inertia::render('Shop/Product', [
			'product' => $product,
		]);
	}
}
