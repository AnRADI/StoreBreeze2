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

	public function labels()
	{
		return $this->belongsToMany(Label::class);
	}


	// =========== METHODS =============


	public function paginateProductsCategoriesAndLabelsW($productsQuery) {

		$columnsProducts = [
			'id',
			'name',
			'price',
			'code',
			'image'
		];


		$products = $productsQuery
			->select($columnsProducts)
			->orderBy('updated_at', 'desc')
			->with(['categories:id,name,slug', 'labels:id,name,class'])
			->paginate(6)
			->withQueryString();


		$products->each(function ($product) {
			$product->setRelation('categories', $product->categories->take(1));
		});


		return $products;
	}

	public function paginateProductsCategoriesAndLabelsC($productsQuery) {

		$columnsProducts = [
			'id',
			'name',
			'price',
			'code',
			'image'
		];


		$products = $productsQuery
			->select($columnsProducts)
			->orderBy('updated_at', 'desc')
			->with(['labels:id,name,class'])
			->paginate(6)
			->withQueryString();


		return $products;
	}

	public function firstProductCategoriesCP($categorySlug, $productCode) {

		$columnsProduct = [
			'id',
			'code',
			'name',
			'image',
			'price',
			'description',
		];

		$columnsCategories = [
			'id',
			'name',
			'slug',
		];

		$product = $this
			->select($columnsProduct)
			->where('code', $productCode)
			->with(['categories' => function($query) use($categorySlug, $columnsCategories) {
				$query
					->select($columnsCategories)
					->where('slug', $categorySlug);
			}])
			->first();


		return $product;
	}


	public function firstProductCategoriesCTP($categorySlug, $productCode) {

		$columnsProduct = [
			'id',
			'name',
			'price',
			'image',
			'code'
		];

		$columnsCategories = [
			'id',
			'name',
			'slug',
		];


		$product = $this
			->select($columnsProduct)
			->where('code', $productCode)
			->with(['categories' => function($query) use($categorySlug, $columnsCategories) {
				$query
					->select($columnsCategories)
					->where('slug', $categorySlug);
			}])
			->first();


		return $product;
	}


	public function paginateProductsCategoriesDP() {

		$columnsProduct = [
			'id',
			'name',
			'price',
			'image',
			'code'
		];

    	$products = $this
			->select($columnsProduct)
			->orderBy('updated_at', 'desc')
			->with('categories:id,name')
			->paginate(4);

    	return $products;
	}


	public function firstProductDPCE($productCode) {

		$columnsProduct = [
			'id',
			'name',
			'code',
			'description',
			'price',
			'image',
		];

		$product = $this
			->select($columnsProduct)
			->where('code', $productCode)
			->first();


		return $product;
	}
}
