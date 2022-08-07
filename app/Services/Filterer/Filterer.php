<?php

namespace App\Services\Filterer;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filterer {

	protected $requestItems;
	protected $builder;

	public function __construct(Request $request) {

		$this->requestItems = $request->validated();
	}


	public function filters(Builder $builder) {

		$this->builder = $builder;

		foreach($this->requestItems as $requestName => $requestItem) {

			if(method_exists($this, $requestName)) {
				call_user_func_array([$this, $requestName], array_filter([$requestItem]));
			}
		}

		return $this->builder;
	}

}