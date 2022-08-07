<?php

namespace App\Services\Filterer;


class ProductFilterer extends Filterer {


	public function label_ids($requestItems) {

		$this->builder->whereHas('labels', fn($query) =>
			$query->whereIn('id', $requestItems)
		);
	}


	public function price_from($requestItem) {

		$this->builder->where('price', '>=', $requestItem);
	}


	public function price_to($requestItem) {

		$this->builder->where('price', '<=', $requestItem);
	}
}