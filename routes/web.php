<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\WelcomeController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\CategoriesController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;




Route::middleware(['admin'])->group(function () {


	// -------- /dashboard ----------

	Route::get('/dashboard', [DashboardController::class, 'index'])
		->name('dashboard');


	// -------- /dashboard/products ----------

	Route::get('/dashboard/products', [AdminProductController::class, 'index'])
		->name('dashboard.products');

	Route::get('/dashboard/products/create', [AdminProductController::class, 'create'])
			->name('dashboard.products.create');

	Route::get('/dashboard/products/{product_code}/edit', [AdminProductController::class, 'edit'])
		->name('dashboard.products.product_code.edit');

	Route::patch('/dashboard/products/{product_code}', [AdminProductController::class, 'update'])
		->name('dashboard.products.product_code.update');

	Route::post('/dashboard/products', [AdminProductController::class, 'store'])
		->name('dashboard.products.store');


});




Route::middleware(['guest'])->group(function () {


	// -------- /register ----------

	Route::get('/register/create', [RegisteredUserController::class, 'create'])
		->name('register.create');

	Route::post('/register', [RegisteredUserController::class, 'store'])
		->name('register.store');

	// -------- /login ----------

	Route::get('/login/create', [AuthenticatedSessionController::class, 'create'])
		->name('login.create');

	Route::post('/login', [AuthenticatedSessionController::class, 'store'])
		->name('login.store');

});


Route::middleware(['user_or_admin'])->group(function () {


	// -------- /logout ----------

	Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
		->name('logout.store');
	//require __DIR__.'/auth.php';

});


Route::middleware(['guest_or_user'])->group(function () {


	// -------- /welcome ----------

	Route::get('/', [WelcomeController::class, 'index'])
		->name('welcome');

//	Route::get('/zippo', function () {
//		return Inertia::render('Shop/Zippo');
//	});
//	Route::patch('/language/{language_locale}', [WelcomeController::class, 'language'])
//		->name('language.language_locale');


	// --------/cart ----------

	Route::get('/cart', [CartController::class, 'cart'])
		->name('cart');


	Route::patch('/cart/{category_slug}/{product_code}', [CartController::class, 'addToCart'])
		->name('cart.category_slug.product_code.update');


//	Route::delete('/remove/{product}/cart', [CartController::class, 'removeProductCart'])
//		->name('remove.product.cart');


	// -------- /categories ----------

	Route::get('/categories', [CategoriesController::class, 'index'])
		->name('categories');


	// -------- /{category_slug} ----------

	Route::get('/{category_slug}', [CategoryController::class, 'index'])
		->name('category_slug');


	// -------- /{category_slug}/{product_code} ----------

	Route::get('/{category_slug}/{product_code}', [ProductController::class, 'index'])
		->name('category_slug.product_code');
});



