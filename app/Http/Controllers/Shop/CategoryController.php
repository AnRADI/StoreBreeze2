<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\Shop\ProductRequest;
use App\Models\Cat;
use App\Models\Category;
use App\Models\Label;
use App\Models\Product;
use App\Services\Animal\Lion;
use App\Services\Filterer\ProductFilterer;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{

	public $category;

	public function __construct()
	{
		$this->category = new Category();
		$this->product = new Product();
		$this->label = new Label();
	}


	// ---------- /categories -----------

	public function index() {


		// ------ Get categories -------

		$categories = $this->category
			->getCategoriesC();


		return Inertia::render('Shop/Categories', [
			'categories' => $categories,
		]);
	}



    public function show(ProductRequest $productRequest, $category) {


		// ------ Get labels -------

		$labels = $this->label->getLabelsC();


		// ------ Product filter -------

		$productFilterer = new ProductFilterer($productRequest);


		// ------ First category->paginate products(filter)->labels -------

		$category =	$this->category
			->firstCategoryProductsLabelsC($productFilterer, $category);

		if(empty($category)) abort(404);



		return Inertia::render('Shop/Category', [
			'category' => $category,
			'labels' => $labels,
		]);
	}
}
