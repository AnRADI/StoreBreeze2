<?php

namespace App\Http\Controllers\Shop;



use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

use App\Http\Controllers\Controller;




class WelcomeController extends Controller
{
	public $product;

	public function __construct() {

		$this->product = new Product();
	}


	// ---------- / -----------

	public function index() {


		$products = Cache::rememberForever(request()->path(), fn() =>
			$this->product
				->getProductsCategoriesW()
		);

//		$user = \Auth::user();
//		$cartCollection = session()->get('cartCollection');

//		$order = Order::create();
//		$user->orders()->attach($order);

//		$insertCartCollection = $cartCollection->map(function ($product) {
//
//			$product->order_id = 1;
//			$product->product_id = $product->id;
//
//			return $product->only(['order_id', 'product_id', 'quantity']);
//
//		})->toArray();

//		\DB::table('order_product')->insert($insertCartCollection);





//		if(Cache::has($routeName)) {
//
//			$products = Cache::get($routeName);
//		}
//		else {
//			$products = $this->product
//				->getProductsCategoriesW();
//
//			Cache::put($routeName, $products);
//		}

//		$product = $this->product->create(['name' => 'zeros', 'description' => 'ggggg', 'image' => 'fffds', 'price' => 2222, 'code' => 33333 ]);
//
//		$product->categories()->attach([2, 3]);
//		$product->load('categories:id,name,slug');
//		dump($product->categories);
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
		]);
	}

	public function language($languageLocale) {

		if(empty(in_array($languageLocale, ['en', 'es', 'ru']))) abort(404);

		Cache::put('locale', $languageLocale);


		return back();
	}


}
