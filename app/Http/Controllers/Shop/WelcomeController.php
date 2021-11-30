<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;


class WelcomeController extends Controller
{
	public $product;

	public function __construct() {

		$this->product = new Product();
	}


	// ---------- / -----------

	public function welcome(Request $request) {

    	$products = $this->product
			->getProductsCategoriesW();
//    	dump(__('Product added :miko zima', ['miko' => 'aaa']));

		//$pr = Product::create(['category_id' => 3, 'name' => 'zok', 'code' => 10022, 'description' => 'ona iri', 'price' => 1033, 'cart_collection' => []]);

		return Inertia::render('Shop/Welcome', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'products' => $products,
			//'top' => session()->get('top'),
		]);
	}

	public function languageLocale($locale) {

		if(empty(in_array($locale, ['en', 'es', 'ru']))) abort(404);

		session(['locale' => $locale]);


		return back();
	}

//	public function submitWelcome(Request $request) {
//
//		return redirect()->route('welcome')->with('top', $request->top);
//	}

}
