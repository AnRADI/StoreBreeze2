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


	// ---------- /dashboard/add-product -----------

	public function addProduct() {


    	$categories = $this->category
			->getCategoriesDA();


		return Inertia::render('Admin/AddProduct', [
			'categories' => $categories,
		]);
	}


	public function submitAddProduct(ProductRequest $request) {

		$form = $request->validated();


		$request->validationCategories($form['categories_id']);

		$categories_id = $form['categories_id'];
		unset($form['categories_id']);


		$request->saveImage($form['image']);


		$request->newCodeProduct($form);


    	$product = $this->product
			->create($form);

    	$product->categories()->attach($categories_id);


		Cache::forget('/');

		foreach ($product->categories as $category) {
			Cache::forget($category->slug);
		}


    	return back()->with('success', __("Product added"));
	}


	// ---------- /dashboard/products -----------

	public function products() {

    	$products = $this->product
			->getProductsDps();


		return Inertia::render('Admin/Products', [
			'products' => $products,
		]);
	}
}
