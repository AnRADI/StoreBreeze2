<?php

namespace App\Http\Requests\Shop;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;


class WelcomeRequest extends FormRequest
{
    public function rules()
    {
		return [
			'price_from' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
			'price_to' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
			'label_names' => ['nullable', 'array']
		];

    }





	public function labelsValidation($labels, &$label_names, $productsQuery) {

		$labelNames = $labels->pluck('name')->toArray();
		$label_ids = [];


		foreach($label_names as $label_name) {

			if(in_array($label_name, $labelNames)) {

				foreach($labels as $label) {

					if ($label_name == $label->name)
						$label_ids[] = $label->id;
				}
			}
			else
				return false;
		}

		$productsQuery->whereHas('labels', function (Builder $query) use($label_ids) {
			$query->whereIn('label_id', $label_ids);
		});

		return true;
	}

}
