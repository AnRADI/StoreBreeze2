<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

	protected $guarded = [
		'_method',
		'_token',
	];


	// ========== RELATIONSHIPS ============

    public function categories()
	{
    	return $this->belongsToMany(Category::class);
	}


	// =========== METHODS =============


	// ---------- Shop/Welcome Controller -----------

	public function getProductsCategoriesW() {

		$columns = [
			'id',
			'name',
			'price',
			'image',
			'code',
		];

		$products = $this
			->select($columns)
			->with('categories:id,name,slug')
			->get();

		return $products;
	}


	// ---------- Shop/Product Controller -----------

	public function firstProductCategoriesCP($productCode) {

		$columns = [
			'id',
			'code',
			'name',
			'image',
			'price',
			'description'
		];


		$product = $this
			->select($columns)
			->where('code', $productCode)
			->with('categories:id,name,slug')
			->first();


		return $product;
	}


	// ---------- Shop/Cart Controller-----------

	public function firstProductCategoriesAPC($productCode) {

		$columns = [
			'id',
			'name',
			'price',
			'image',
			'code'
		];

		$product = $this
			->select($columns)
			->where('code', $productCode)
			->with('categories:id,slug')
			->first();

		return $product;
	}


	// ---------- Admin/Product Controller-----------

	public function getProductsDps() {

    	$products = $this
			->get();

    	return $products;
	}

	public function valueCodeDSA() {

    	$fieldCode = $this
			->orderBy('code', 'desc')
			->value('code');

    	return $fieldCode;
	}
}
