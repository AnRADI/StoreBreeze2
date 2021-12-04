<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

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


	public function submitAddProduct(Request $request) {

//		$form = $request
//			->validate([
//				'name' => ['required', 'unique:products', 'regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_.:()%&,+ \/]+$/u', 'max:255'],
//				'description' => ['nullable', 'max:65535'],
//				//'category_id' => ['required', 'integer', 'numeric', 'between:1,3'],
//				'categories_id' => ['required', 'array'],
//				'price' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
//			]);

		$form = $request->all();


		Validator::make($form, [
			'name' => ['required', 'unique:products', 'regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_.:()%&,+ \/]+$/u', 'max:255'],
			'description' => ['nullable', 'max:65535'],
			//'category_id' => ['required', 'integer', 'numeric', 'between:1,3'],
			'image' => ['required', 'image', 'max:2048'],
			'categories_id' => ['required', 'array'],
			'price' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
		], [
			'image.required' => 'Изображение нужно обязательно.',
			'name.regex' => __('Allowed letters of the Russian and English alphabets, numbers, special characters (-_.:()%&,+ /)')

		])->validate();


		$imageName = $request->image->getClientOriginalName();

		//if(!file_exists(storage_path('app/public/uploads/' . $imageName))) {
		$request->image->storeAs('uploads', $imageName, 'public');
		//}


		$hashFile = substr(md5_file($request->image->getRealPath()), -20);

		$form['image'] = '/storage/uploads/' . $imageName . '?id=' . $hashFile;


		$fieldCode = $this->product
			->valueCodeDSA();

		$allCategoriesId = $this->category
			->arrayIdDSA();


		$categories_id = $form['categories_id'];
		unset($form['categories_id']);

		foreach ($categories_id as $category_id) {

			if(empty(in_array($category_id, $allCategoriesId))) {
				return back()->withErrors(['categories_id' => __("There is no such category or categories.")]);
//				return response()
//					->json(['errors' => [
//						'categories_id' => "Такой категории или категорий не существует."]
//					], 422);
			}
		}


    	//$form['image'] = 'http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg';
    	$form['code'] = ++$fieldCode;


    	$product = $this->product
			->create($form);

    	$product->categories()->attach($categories_id);


    	return back()->with('success', __("Product added"));
//		return "Продукт добавлен";
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
