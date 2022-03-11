<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function rules()
    {
        return [
			'name' => ['required', 'unique:products', 'regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_.:()%&,+ \/]+$/u', 'max:255'],
			'description' => ['nullable', 'max:65535'],
			//'category_id' => ['required', 'integer', 'numeric', 'between:1,3'],
			'image' => ['required', 'image', 'max:2048'],
			'categories_id' => ['required', 'array'],
			'price' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
        ];
    }


	public function messages()
	{
		return [
			'image.required' => 'Изображение нужно обязательно.',
			'name.regex' => __('Allowed letters of the Russian and English alphabets, numbers, special characters (-_.:()%&,+ /)')
		];
	}


	public function saveImage(&$image) {

    	// Save to disk
		$imageName = $image->getClientOriginalName();

		$image->storeAs('uploads', $imageName, 'public');


		// Save to array
		$hashFile = substr(md5_file($image->getRealPath()), -20);

		$image = '/storage/uploads/' . $imageName . '?id=' . $hashFile;
	}


	public function validationCategories($categories_id) {

		$allCategoriesId = Category::pluck('id')->toArray();


		foreach ($categories_id as $category_id) {

			if(empty(in_array($category_id, $allCategoriesId))) {
				return back()->withErrors(['categories_id' => __("There is no such category or categories.")]);
			}
		}
	}


	public function newCodeProduct(&$form) {

		$fieldCode = Product::orderBy('code', 'desc')
			->value('code');

		$form['code'] = ++$fieldCode;
	}

}
