<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Label;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;


class ProductController extends Controller
{

    public $product,
		$label,
		$category;


    public function __construct() {

    	$this->product = new Product();
    	$this->label = new Label();
		$this->category = new Category();
	}


	// ---------- /dashboard/products -----------


	public function index() {

		$products = $this->product
			->paginateProductsCategoriesDP();

		return Inertia::render('Admin/Products/Index', [
			'products' => $products,
		]);
	}


	public function create() {

    	$categories = $this->category
			->getCategoriesDPC();

		$labels = $this->label
			->getLabelsDPC();


		return Inertia::render('Admin/Products/Create', [
			'categories' => $categories,
			'labels' => $labels
		]);
	}


	public function store(ProductRequest $request) {

		$form = $request->validated();


		// ------ Label validation -------

		$labelIds = [];

		if(isset($form['label_names'])) {

			$labelIds =
				$request->labelValidation($form['label_names']);

			if(empty($labelIds))
				return back()->withErrors(['label_names' => __("There is no such label or labels.")]);
		}


		// ------ Category validation -------

		$categoryIds =
			$request->categoryValidation($form['category_ids']);

		if(empty($categoryIds))
			return back()->withErrors(['category_ids' => __("There is no such category or categories.")]);


		// ------ Upload image -------

		$form['image'] = $request->saveImage();


		// ------ Add code product -------

		$form['code'] = $request->newCodeProduct();


		// ------ Create product -------

    	$product = $this->product
			->create($form);


    	$product->categories()->attach($categoryIds);

    	if(isset($labelIds))
    		$product->labels()->attach($labelIds);


		// ------ Cache -------

		Cache::forget('/');

		foreach ($product->categories as $category) {
			Cache::forget($category->slug);
		}


    	return back()->with('success', __("Product added"));
	}


	public function edit($productCode) {

		$categories = $this->category
			->getCategoriesDPCE();

		$product = $this->product
			->firstProductDPCE($productCode);

		$product->category_ids = $product->categories()
			->pluck('id')
			->map(fn($item) => strval($item));


		$labels = $this->label
			->getLabelsDPCE();

		$product->label_names = $product->labels()
			->pluck('name')
			->toArray();


		return Inertia::render('Admin/Products/Edit', [
			'categories' => $categories,
			'labels' => $labels,
			'product' => $product
		]);
	}


	public function update($productCode, ProductRequest $request) {

		$form = $request->validated();


		// ------ Label validation -------

		$labelIds = [];

		if(isset($form['label_names'])) {

			$labelIds =
				$request->labelValidation($form['label_names']);

			if(empty($labelIds))
				return back()->withErrors(['label_names' => __("There is no such label or labels.")]);
		}


		// ------ Validation categories -------

		$categoryIds =
			$request->categoryValidation($form['category_ids']);

		if(empty($categoryIds))
			return back()->withErrors(['category_ids' => __("There is no such category or categories.")]);


		// ------ Upload image -------

		if(isset($form['image'])) {
			$form['image'] = $request->saveImage();
		}
		else {
			unset($form['image']);
		}


		// ------ Update product -------

		$product = $this->product
			->where('code', $productCode)
			->first();

		$form['updated_at'] = date("Y-m-d H:i:s");

		$product->update($form);


		$product->categories()->detach();
		$product->categories()->attach($categoryIds);


		$product->labels()->detach();
		if(isset($labelIds))
			$product->labels()->attach($labelIds);


		// ------ Cache -------

		Cache::forget('/');

		foreach ($product->categories as $category) {
			Cache::forget($category->slug);
		}


		return redirect()->route('dashboard.products')->with('success', 'product updated');
	}
}
