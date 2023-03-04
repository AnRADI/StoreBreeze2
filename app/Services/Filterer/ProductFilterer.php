<?php

namespace App\Services\Filterer;

use App\Traits\Filterer;
use Illuminate\Database\Eloquent\Builder;


class ProductFilterer {

    use Filterer;


	private function label_ids($requestItems) {

		$this->builder->whereHas('labels', function(Builder $query) use($requestItems) {
			$query->whereIn('id', $requestItems);
		});
	}


    private function price_from($requestItem) {

		$this->builder->where('price', '>=', $requestItem);
	}


    private function price_to($requestItem) {

		$this->builder->where('price', '<=', $requestItem);
	}
}
