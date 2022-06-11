<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Label;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProductRequest extends FormRequest
{
    public function rules()
    {
    	switch ($this->method())
		{
			case 'POST': {
				return [
					'name' => ['required', 'unique:products', 'regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_.:()%&,+ \/]+$/u', 'max:255'],
					'description' => ['nullable', 'max:65535'],
					'image' => ['required', 'image', 'max:2048'],
					'category_ids' => ['required', 'array'],
					'price' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
					'label_names' => ['nullable', 'array']
				];
			}
			case 'PATCH': {
				return [
					'name' => ['required', Rule::unique('products')->ignore($this->id), 'regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_.:()%&,+ \/]+$/u', 'max:255'],
					'description' => ['nullable', 'max:65535'],
					'image' => ['nullable', 'image', 'max:2048'],
					'category_ids' => ['required', 'array'],
					'price' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
					'label_names' => ['nullable', 'array']
				];
			}
		}
    }


	public function messages()
	{
		return [
			'image.required' => 'Изображение нужно обязательно.',
			'name.regex' => __('Allowed letters of the Russian and English alphabets, numbers, special characters (-_.:()%&,+ /)')
		];
	}


	public function saveImage() {

    	// Save to disk
		$imageName = $this->image->getClientOriginalName();

		$this->image->storeAs('uploads', $imageName, 'public');


		// Save to array
		$hashFile = substr(md5_file($this->image->getRealPath()), -20);

		return '/storage/uploads/' . $imageName . '?id=' . $hashFile;
	}


	public function labelValidation(&$label_names) {

		$labels = Label::select(['id', 'name'])->get();

		$labelNames = $labels->pluck('name')->toArray();
		$labelIds = [];


		foreach($label_names as $label_name) {

			if(in_array($label_name, $labelNames)) {

				foreach($labels as $label) {

					if ($label_name == $label->name)
						array_push($labelIds, $label->id);
				}
			}
			else
				return [];
		}

		unset($label_names);

		return $labelIds;
	}


	public function categoryValidation(&$category_ids) {

		$categoryIds = Category::pluck('id')->toArray();

		foreach ($category_ids as $category_id) {

			if(empty(in_array($category_id, $categoryIds)))
				return [];
		}

		unset($category_ids);

		return $this->category_ids;
	}


	public function newCodeProduct() {

		$fieldCode = Product::orderBy('code', 'desc')
			->value('code');

		return ++$fieldCode;
	}

}
