<?php

namespace App\Facades;

use App\Services\Cart\CartCollection;
use illuminate\Support\Facades\Facade;


class CartFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return CartCollection::class;
	}
}