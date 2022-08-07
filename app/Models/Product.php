<?php

namespace App\Models;

use App\Services\Filterer\Filterer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;


	protected $guarded = [
		'_method',
		'_token',
	];


	protected $hidden = ['pivot'];


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


	public function scopeFilters(Builder $builder, Filterer $filterer) {

    	return $filterer->filters($builder);
	}


	public function paginateProductsCategoriesAndLabelsW(Filterer $filterer) {

		$columnsProducts = [
			'id',
			'name',
			'price',
			'image',
		];


		$products = $this
			->filters($filterer)
			->select($columnsProducts)
			->orderBy('updated_at', 'desc')
			->with(['categories:id,name,slug', 'labels:id,name,class'])
			->paginate(6)->withQueryString();


		$products->each(function ($product) {
			$product->setRelation('categories', $product->categories->take(1));
		});


		return $products;
	}


	public function firstProductCategoriesCP($category, $product) {

		$columnsProduct = [
			'id',
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
			->with(['categories' => function($query) use($category, $columnsCategories) {
				$query
					->select($columnsCategories)
					->where('slug', $category);
			}])
			->find($product);


		return $product;
	}





	public function firstProductCategoriesCTP($category, $product) {

		$columnsProduct = [
			'id',
			'name',
			'price',
			'image',
		];

		$columnsCategories = [
			'id',
			'name',
			'slug',
		];


		$product = $this
			->select($columnsProduct)
			->with(['categories' => function($query) use($category, $columnsCategories) {
				$query
					->select($columnsCategories)
					->where('slug', $category);
			}])
			->find($product);


		return $product;
	}


	public function paginateProductsCategoriesDP() {

		$columnsProduct = [
			'id',
			'name',
			'price',
			'image',
		];

    	$products = $this
			->select($columnsProduct)
			->orderBy('updated_at', 'desc')
			->with('categories:id,name')
			->paginate(4);

    	return $products;
	}


	public function firstProductDPCE($product) {

		$columnsProduct = [
			'id',
			'name',
			'description',
			'price',
			'image',
		];

		$product = $this
			->select($columnsProduct)
			->find($product);


		return $product;
	}
}
