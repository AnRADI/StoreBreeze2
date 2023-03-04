<?php


namespace App\Http\Controllers\Shop;


use App\Exceptions\TestException;
use App\Http\Requests\Shop\ProductRequest;

use App\Models\Category;
use App\Models\Label;

use App\Services\Animal\Factory\Factory;
use App\Services\Animal\Lion;
use App\Models\Product;

use App\Services\Filterer\ProductFilterer;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

use Inertia\Inertia;
use App\Http\Controllers\Controller;


class WelcomeController extends Controller
{
    public $product, $label;


    public function __construct(Product $product, Label $label)
    {
        $this->product = $product;
        $this->label = $label;
    }


    // ---------- / -----------

    public function index(ProductRequest $productRequest)
    {
        $requestItems = $productRequest->validated();


        $labels = $this->label
            ->select(['id', 'name'])->get();


        $filtererBuilder =
            ProductFilterer::apply($this->product->query(), $requestItems);


        $products = $this->product
            ->paginateProductsWithRelations($filtererBuilder);


        return Inertia::render('Shop/Welcome', [
            'products' => $products,
            'labels' => $labels,
        ]);
    }

}
