<?php

namespace App\Models;

use App\Services\Filterer\Filterer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;


    protected $guarded = [
		'_method',
		'_token',
	];

	protected $hidden = ['pivot'];

	// ========== RELATIONSHIPS ============

    public function products() {

    	return $this->belongsToMany(Product::class);
	}


	// =========== METHODS =============

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


	public function firstCategoryProductsLabelsC(Filterer $filterer, $category) {

		$category = $this
			->select([
				'id',
				'name',
				'slug',
				'description'
			])
			->where('slug', $category)
			->first();


		if($category == null) return;


		$category->setRelation('products', $category->products()
			->filters($filterer)
			->select([
				'id',
				'name',
				'price',
				'image'
			])
			->orderBy('updated_at', 'desc')
			->with(['labels:id,name,class'])
			->paginate(6)->withQueryString());


		return $category;
	}


	public function getCategoriesDPC() {

    	$columns = [
    		'id',
			'name',
		];

    	$categories = $this
			->select($columns)
			->get();

    	return $categories;
	}


	public function getCategoriesDPCE() {

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
