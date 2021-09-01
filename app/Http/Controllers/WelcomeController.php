<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Cart;


class WelcomeController extends Controller
{
	public $product;

	public function __construct() {

		$this->product = new Product();
	}


	// ---------- / -----------

	public function welcome(Request $request) {

    	$products = $this->product
			->getProductsCategory();


    	$cartCollection = Cart::get();
		//$pr = Product::create(['category_id' => 3, 'name' => 'zok', 'code' => 10022, 'description' => 'ona iri', 'price' => 1033, 'cart_collection' => []]);


		return Inertia::render('Welcome', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'cartCollection' => $cartCollection,
			'products' => $products,
			'top' => session()->get('top'),
		]);
	}

	public function submitWelcome(Request $request) {

		return redirect()->route('welcome')->with('top', $request->top);
	}

}
