<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;


class ProductController extends Controller
{
    public $product;
    public $category;

    public function __construct() {

    	$this->product = new Product();
		$this->category = new Category();
	}


	// ---------- /dashboard/products -----------


	public function index() {

		$products = $this->product
			->getProductsCategoriesDP();

		return Inertia::render('Admin/Products/Index', [
			'products' => $products,
		]);
	}


	public function create() {

    	$categories = $this->category
			->getCategoriesDPC();


		return Inertia::render('Admin/Products/Create', [
			'categories' => $categories,
		]);
	}


	public function store(ProductRequest $request) {

		$form = $request->validated();


		// ------ Validation categories -------

		$isValidCategories =
			$request->validationCategories($form['categories_id']);

		if($isValidCategories) {
			unset($form['categories_id']);
		}
		else
			return back()->withErrors(['categories_id' => __("There is no such category or categories.")]);


		// ------ Upload image -------

		$form['image'] = $request->saveImage();


		// ------ Add code product -------

		$form['code'] = $request->newCodeProduct();


		// ------ Create product -------

    	$product = $this->product
			->create($form);

    	$product->categories()->attach($request->categories_id);


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

		$product->categories_id = $product->categories()
			->pluck('id')
			->map(fn($item) => strval($item));


		return Inertia::render('Admin/Products/Edit', [
			'categories' => $categories,
			'product' => $product
		]);
	}


	public function update($productCode, ProductRequest $request) {

		$form = $request->validated();


		// ------ Validation categories -------

		$isValidCategories =
			$request->validationCategories($form['categories_id']);

		if($isValidCategories) {
			unset($form['categories_id']);
		}
		else
			return back()->withErrors(['categories_id' => __("There is no such category or categories.")]);


		// ------ Upload image -------

		if(isset($form['image'])) {
			$form['image'] = $request->saveImage();
		}


		// ------ Update product -------

		$product = $this->product
			->where('code', $productCode)
			->first();

		$product->update($form);

		$product->categories()->detach();
		$product->categories()->attach($request->categories_id);


		// ------ Cache -------

		Cache::forget('/');

		foreach ($product->categories as $category) {
			Cache::forget($category->slug);
		}


		return redirect()->route('dashboard.products')->with('success', 'product updated');
	}
}
