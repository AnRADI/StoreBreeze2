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
					'name' => ['required', 'unique:products', 'regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_.:()%&,+ \/]+$/u', 'min:4', 'max:255'],
					'description' => ['nullable', 'max:65535'],
					'image' => ['required', 'image', 'max:2048'],
					'price' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],

					'category_ids' => ['required', 'array'],
					'category_ids.*' => ['exists:categories,id'],

					'label_ids' => ['nullable', 'array'],
					'label_ids.*' => ['exists:labels,id']
				];
			}
			case 'PATCH': {
				return [
					'name' => ['required', Rule::unique('products')->ignore($this->id), 'regex:/^[a-zA-Zа-яёА-ЯЁ0-9-_.:()%&,+ \/]+$/u', 'max:255'],
					'description' => ['nullable', 'max:65535'],
					'image' => ['nullable', 'image', 'max:2048'],
					'price' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],

					'category_ids' => ['required', 'array'],
					'category_ids.*' => ['exists:categories,id'],

					'label_ids' => ['nullable', 'array'],
					'label_ids.*' => ['exists:labels,id']
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

}
