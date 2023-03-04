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

	public function show(Category $category, Product $product) {


		return Inertia::render('Shop/Product', [
            'category' => $category,
			'product' => $product,
		]);
	}
}
