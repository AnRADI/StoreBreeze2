<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'category_id',
		'code',
		'description',
		'price',
	];


	// ========== RELATIONSHIPS ============

    public function category()
	{
    	return $this->belongsTo(Category::class);
	}


	// =========== METHODS =============


	// ---------- Welcome -----------

	public function getProductsCategory() {

		$columns = [
			'id',
			'category_id',
			'name',
			'price',
			'code',
		];

		$products = $this
			->select($columns)
			->with('category:id,name,slug')
			->get();


		return $products;
	}


	// ---------- Product -----------

	public function getProductCategoryPro($productCode) {

		$columns = [
			'id',
			'category_id',
			'code',
			'name',
			'price',
			'description'
		];


		$product = $this
			->select($columns)
			->where('code', $productCode)
			->with('category:id,name,slug')
			->first();


		return $product;
	}


	// ---------- Cart -----------

	public function getProductCategoryCar($productCode) {

		$columns = [
			'id',
			'category_id',
			'name',
			'price',
			'code'
		];

		$product = $this
			->select($columns)
			->where('code', $productCode)
			->with('category:id,slug')
			->first();

		return $product;
	}

}
