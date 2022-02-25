<?php

namespace App\Http\Controllers\Shop;


use App\Models\Category;
use App\Models\Product;

use Illuminate\Support\Facades\App;


use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;



class WelcomeController extends Controller
{
	public $product;

	public function __construct() {

		$this->product = new Product();
	}


	// ---------- / -----------

	public function index(Request $request) {

    	$products = $this->product
			->getProductsCategoriesW();

//		$columns = [
//			'id',
//			'name',
//			'price',
//			'image',
//			'code',
//		];
//		$product = Product::select($columns)->with('categories:id,name,slug')->first();
//		dump($product->categories()->first());
//		$products = Product::where('id', 3)->orWhere('id', 5)->get();
//		$products[0]->delete();
		//dump(Cookie::get('zon'));
		//return $request->r;

    	//return route('categories');
		//throw new TestException('sfdsfd');


//    	dump(__('Product added :miko zima', ['miko' => 'aaa']));

		//$pr = Product::create(['category_id' => 3, 'name' => 'zok', 'code' => 10022, 'description' => 'ona iri', 'price' => 1033, 'cart_collection' => []]);

		return Inertia::render('Shop/Welcome', [
			'products' => $products,

			//'top' => session()->get('top'),
		]);
	}

	public function language($languageLocale) {

		if(empty(in_array($languageLocale, ['en', 'es', 'ru']))) abort(404);

		session(['locale' => $languageLocale]);


		return back();
	}


}
