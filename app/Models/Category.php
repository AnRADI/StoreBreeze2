<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;


    protected $guarded = [
		'_method',
		'_token',
	];


	// ========== RELATIONSHIPS ============

    public function products() {

    	return $this->belongsToMany(Product::class);
	}


	// =========== METHODS =============

	public function firstCategoryProductsC($categorySlug)
	{
		$categoryColumns = [
			'id',
			'name',
			'slug',
			'description'
		];

		$category = $this
			->select($categoryColumns)
			->where('slug', $categorySlug)
			->with('products:id,name,image,code,price')
			->first();


		return $category;
	}


	public function getCategoriesC()
	{
		$columns = [
			'id',
			'name',
			'slug',
			'description'
		];

		$categories = $this
			->select($columns)
			->get();

		return $categories;
	}


	public function getCategoriesDA() {

    	$columns = [
    		'id',
			'name',
		];

    	$categories = $this
			->select($columns)
			->get();

    	return $categories;
	}


}
