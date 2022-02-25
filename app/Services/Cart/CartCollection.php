<?php

namespace App\Services\Cart;
use Auth;


class CartCollection
{

	public function get()
	{
		$cartCollection = session()->get('cartCollection');


		if(empty($cartCollection)) $cartCollection = [];


//		if(Auth::check()) {
//
//			$user = Auth::user();
//
//			if(empty($user->cart_collection)) {
//
//				$user->update(['cart_collection' => $cartCollection]);
//			}
//			else {
//				$cartCollection = $user->cart_collection;
//			}
//		}


		return $cartCollection;
	}


	public function add($product, $request)
	{
		$cartCollection = session()->get('cartCollection');


		if(empty($cartCollection)) $cartCollection = [];


		if(empty($cartCollection[$product->code])) {

			$cartCollection[$product->code] = $product;

			$cartCollection[$product->code]->quantity = $request->quantity;
		}
		else {

			$cartCollection[$product->code]->quantity = $request->quantity;
		}


//		if(Auth::check()) {
//
//			Auth::user()
//				->update(['cart_collection' => $cartCollection]);
//		}


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