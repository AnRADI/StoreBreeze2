<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\Shop\ProductRequest;
use App\Models\Label;
use App\Models\Product;
use App\Services\Filterer\ProductFilterer;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class WelcomeController extends Controller
{

	public $product, $label;

	public function __construct() {

		$this->product = new Product();
		$this->label = new Label();
	}


	// ---------- / -----------

	public function index(ProductRequest $productRequest) {


		// ------ Get labels -------

		$labels = $this->label->getLabelsW();


		// ------ Product filter -------

		$productFilterer = new ProductFilterer($productRequest);


		// ------ Paginate products(filter)->categories(take) -------
		// ------ Paginate products(filter)->labels -------

		$products = $this->product->paginateProductsCategoriesAndLabelsW($productFilterer);


		return Inertia::render('Shop/Welcome', [
			'products' => $products,
			'labels' => $labels,
		]);
	}
}
