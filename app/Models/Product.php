<?php

namespace App\Models;

use App\Services\Animal\Lion;
use App\Traits\Filterer;
use App\Services\Uploader\VideoUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


class Product extends Model
{
    use HasFactory, \Staudenmeir\EloquentEagerLimit\HasEagerLimit;


	protected $guarded = [];


	protected $hidden = [
        'created_at',
        'updated_at'
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


	public function scopeFilters(Builder $builder, Filterer $filterer): Builder {

    	return $filterer->apply($builder);
	}

    public function scopePro(Builder $builder) {

        $builder->where('id', 3);
        return $builder;
    }

    public function scopeBro(Builder $builder) {

        return $builder->orWhere('price', '>', 50000);
    }


    /**
     * products->categories <br>
     * products->labels
     *
     * @param Filterer $filterer
     * @return LengthAwarePaginator
     */
	public function paginateProductsWithRelations(Builder $filtererBuilder): LengthAwarePaginator {

		return $filtererBuilder

			->select(['id', 'name', 'price', 'image'])

			->orderBy('updated_at', 'desc')

			->with(['categories' => function($query) {
                $query
                    ->select(['id', 'name', 'slug'])
                    ->take(1); // package eloquent-eager-limit

            }, 'labels:id,name,class'])

			->paginate(6)->withQueryString();
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


		$product = $this

			->select(['id', 'name', 'price', 'image'])

			->with(['categories' => function($query) use($category) {
				$query
					->select(['id', 'name', 'slug'])

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
