<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\Shop\WelcomeRequest;
use App\Models\Category;
use App\Models\Label;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
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


	// ---------- /{category_slug} -----------

	public function index($categorySlug, WelcomeRequest $request) {

		$filterRequest = $request->validated();


		$labels = $this->label->getLabelsC();

		$category = $this->category
			->firstCategoryC($categorySlug);

		$productsQuery = $this->product->query();


		if(isset($filterRequest['price_from']))
			$productsQuery->where('price', '>=', $filterRequest['price_from']);

		if(isset($filterRequest['price_to']))
			$productsQuery->where('price', '<=', $filterRequest['price_to']);


		if(isset($filterRequest['label_names'])) {

			$hasValidationLabels =
				$request->labelsValidation($labels, $filterRequest['label_names'], $productsQuery);

			if(empty($hasValidationLabels))
				return back()->withErrors(['label_names' => 'Фильтр сломан']);
		}


		$products =	$this->product
			->paginateProductsCategoriesAndLabelsC($productsQuery);

		$category->setRelation('products', $products);


//		$category = Cache::rememberForever(request()->path(), fn() =>

//		);


		if(empty($category)) abort(404);


		return Inertia::render('Shop/Category', [
			'category' => $category,
			'labels' => $labels,
			'filterRequest' => $filterRequest
		]);
	}
}
