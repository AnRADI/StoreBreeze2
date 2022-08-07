<?php


namespace App\Services\Cart;
use CollectionEloquent;


class CartCollection
{

	public function get()
	{
		$cartCollection = session()->get('cartCollection');


		if(empty($cartCollection)) $cartCollection = new CollectionEloquent;



		return $cartCollection;
	}


	public function add($product, $request)
	{
		$cartCollection = session()->get('cartCollection');


		if(empty($cartCollection)) $cartCollection = new CollectionEloquent;


		if(empty($cartCollection[$product->id])) {

			$cartCollection[$product->id] = $product;

			$cartCollection[$product->id]->quantity = $request->quantity;
		}
		else {

			$cartCollection[$product->id]->quantity = $request->quantity;
		}


		session()->put('cartCollection', $cartCollection);
	}


	public function remove($productCode, $request)
	{
		$cartCollection = session()->get('cartCollection');


		if($request->boolean('delete')) {

			unset($cartCollection[$productCode]);
		}


		session()->put('cartCollection', $cartCollection);
	}


//	public function remove($productCode, $request)
//	{
//		$cartCollection = session()->get('cartCollection');
//
//
//		$cartCollection[$productCode]->quantity -= $request->quantity;
//
//
//		if($cartCollection[$productCode]->quantity <= 0 || $request->boolean('delete')) {
//
//			unset($cartCollection[$productCode]);
//		}
//
//
//		session()->put('cartCollection', $cartCollection);
//	}

}