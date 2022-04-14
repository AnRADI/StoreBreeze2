<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use App\Models\Product;

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
					'categories_id' => ['required', 'array'],
					'price' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
				];
			}
			case 'PATCH': {
				return [
					'name' => ['required', Rule::unique('products')->ignore($this->id), 'regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_.:()%&,+ \/]+$/u', 'max:255'],
					'description' => ['nullable', 'max:65535'],
					'image' => ['nullable', 'image', 'max:2048'],
					'categories_id' => ['required', 'array'],
					'price' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
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


	public function validationCategories($categories_id) {

		$allCategoriesId = Category::pluck('id')->toArray();

		foreach ($categories_id as $category_id) {

			if(empty(in_array($category_id, $allCategoriesId))) {
				return false;
			}
		}

		return true;
	}


	public function newCodeProduct() {

		$fieldCode = Product::orderBy('code', 'desc')
			->value('code');

		return ++$fieldCode;
	}

}
