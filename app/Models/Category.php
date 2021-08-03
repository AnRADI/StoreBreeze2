<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;


	// ========== RELATIONSHIPS ============

    public function products() {

    	return $this->hasMany(Product::class);
	}


	// =========== METHODS =============


	// ---------- Category -----------

	public function getCategoryProducts($categorySlug)
	{
		$categoryColumns = [
			'id',
			'name',
			'description'
		];

		$category = $this
			->select($categoryColumns)
			->where('slug', $categorySlug)
			->with('products:id,category_id,name,code,price')
			->first();


		return $category;
	}


	// ---------- Categories -----------

	public function getCategories()
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

}
