<?php

namespace App\Http\Controllers\Shop;

use App\Contracts\Uploader;
use App\Http\Requests\Shop\ProductRequest;
use App\Models\Cart;
use App\Models\Cat as Lop;
use App\Models\Category;
use App\Models\Label;
use App\Services\Animal\Cat;
use App\Services\Animal\Factory;
use App\Services\Animal\Lion;
use App\Models\Product;
use App\Models\User;
use App\Services\Animal\AnimalFactorys;
use App\Services\Downloader\ImageDownloader;
use App\Services\Filterer\ProductFilterer;
use App\Services\Goll;
use App\Services\Son;
use App\Services\Top;
use App\Services\Uploader\Dob;

use App\Services\Uploader\ImageUploader;

use App\Services\Uploader\Rob;
use App\Services\Uploader\VideoUploader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Http\Controllers\Controller;



class WelcomeController extends Controller
{
	public $product, $label;

	public function __construct() {

		$this->product = new Product();
		$this->label = new Label();
	}


	// ---------- / -----------

	public function index(ProductRequest $productRequest) {

//	    $lion = Factory::data(['class' => Lion::class, 'count' => 1])->create();
//        $lion->voice();


        //$interface = array_values(class_implements(static::class))[0];
        function top()
        {
            $gg = 6;
            return $gg;
        }

        dump(top());

//	    $animalNames = ['Lion', 'Cat'];
//
//
//        foreach ($animalNames as $animalName) {
//
//            $animals[] = AnimalFactory::initial($animalName);
//        }
//        dump(Lion::factory(5));
//        dump(Lion::factory());

//        $animal1 = Animal::initial('Lion');
//        $animal2 = Animal::initial('Cat');

//        $cake = new SimpleCake();
//        $cake = new WithSprinkles($cake);
//        $cake = new WithWhippedCream($cake);
//        dump($cake->ingredients());

		// ------ Get labels -------

		$labels = $this->label->getLabelsW();


		// ------ Product filter -------

		$productFilterer = new ProductFilterer($productRequest);


		// ------ Paginate products(filter)->take categories -------
		// ------ Paginate products(filter)->labels -------

		$products = $this->product->paginateProductsCategoriesAndLabelsW($productFilterer);


		return Inertia::render('Shop/Welcome', [
			'products' => $products,
			'labels' => $labels,
		]);
	}

}
