<?php

namespace App\Http\Controllers\Shop;


use App\Http\Requests\Shop\WelcomeRequest;
use App\Models\Label;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
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

	public function index(WelcomeRequest $request) {

		$filterRequest = $request->validated();

//		Cache::flush();
//		session()->flush();

		//$products = Cache::rememberForever(request()->path(), fn() =>
//		$this->product
//				->getProductsCategoriesAndLabelsW();
		//);
		$labels = $this->label->getLabelsW();


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
			->paginateProductsCategoriesAndLabelsW($productsQuery);


		return Inertia::render('Shop/Welcome', [
			'products' => $products,
			'labels' => $labels,
			'filterRequest' => $filterRequest
		]);
	}

//	public function language($languageLocale) {
//
//		if(empty(in_array($languageLocale, ['en', 'es', 'ru']))) abort(404);
//
//		Cache::put('locale', $languageLocale);
//
//
//		return back();
//	}


}
