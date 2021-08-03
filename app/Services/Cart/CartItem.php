<?php

namespace App\Services\Cart;


class CartItem
{
	public $code;
	public $name;
	public $price;
	public $quantity;

	public $cost;


	/**
	 * @return int|float
	 */
	public function getCost()
	{
		$cartCollection = session()->get('cartCollection');


		$cost = $this->price * $this->quantity;
		$slug = $this->code;

		$cartCollection[$slug]->cost = $cost;


		session()->put('cartCollection', $cartCollection);

		return $cost;
	}

}