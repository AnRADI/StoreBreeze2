<?php

namespace App\Services\Cart;



class CartCollection extends ArrayObject
{

	// return Object Array products
	public function get()
	{
		$cartCollection = session()->get('cartCollection');


		if(empty($cartCollection)) $cartCollection = new CartCollection();


		return $cartCollection->items;
	}


	public function add($product, $request)
	{
		$cartCollection = session()->get('cartCollection');


		if(empty($cartCollection)) $cartCollection = new CartCollection();


		if(empty($cartCollection[$product->code])) {

			$cartCollection[$product->code] = $product;

			$cartCollection[$product->code]->quantity = $request->quantity;
		}
		else {

			$cartCollection[$product->code]->quantity += $request->quantity;
		}


		session()->put('cartCollection', $cartCollection);
	}


	public function remove($productCode, $request)
	{
		$cartCollection = session()->get('cartCollection');


		$cartCollection[$productCode]->quantity -= $request->quantity;


		if($cartCollection[$productCode]->quantity <= 0 || $request->boolean('delete')) {

			unset($cartCollection[$productCode]);
		}


		session()->put('cartCollection', $cartCollection);
	}

}