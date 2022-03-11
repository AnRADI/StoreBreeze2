<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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


	// ---------- /{category_slug}/{product_slug} -----------

	public function index($categorySlug, $productCode)
	{

		$product = Cache::rememberForever(request()->path(), fn() =>
			$this->product
				->firstProductCategoriesCP($categorySlug, $productCode)
		);


		if(empty($product && $product->categories->count() != 0)) abort(404);


		return Inertia::render('Shop/Product', [
			'product' => $product,
		]);
	}
}
