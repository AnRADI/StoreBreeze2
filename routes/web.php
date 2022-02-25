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
use Inertia\Inertia;



Route::middleware(['admin'])->group(function () {


	// -------- /dashboard ----------

	Route::get('/dashboard', [DashboardController::class, 'dashboard'])
		->name('dashboard');


	// -------- /dashboard/add-product ----------

	Route::get('/dashboard/add-product', [AdminProductController::class, 'addProduct'])
		->name('dashboard.add-product');

	Route::delete('/dashboard/submit/add-product', [AdminProductController::class, 'submitAddProduct'])
		->name('dashboard.submit.add-product');


	// -------- /dashboard/products ----------

	Route::get('/dashboard/products', [AdminProductController::class, 'products'])
		->name('dashboard.products');

});




Route::middleware(['guest'])->group(function () {


	// -------- /register ----------

	Route::get('/register', [RegisteredUserController::class, 'create'])
		->name('register');

	Route::post('/register', [RegisteredUserController::class, 'store']);


	// -------- /login ----------

	Route::get('/login', [AuthenticatedSessionController::class, 'create'])
		->name('login');

	Route::post('/login', [AuthenticatedSessionController::class, 'store']);

});


Route::middleware(['user_or_admin'])->group(function () {


	// -------- /logout ----------

	Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
		->name('logout');
	//require __DIR__.'/auth.php';

});


Route::middleware(['guest_or_user'])->group(function () {


	// -------- /welcome ----------

	Route::get('/', [WelcomeController::class, 'index'])
		->name('welcome');


//	Route::patch('/language/{language_locale}', [WelcomeController::class, 'language'])
//		->name('language.language_locale');


	// --------/cart ----------

	Route::get('/cart', [CartController::class, 'index'])
		->name('cart');


	Route::patch('/cart/{category_slug}/{product_code}', [CartController::class, 'update'])
		->name('cart.category_slug.product_code');


	Route::delete('/remove/{product}/cart', [CartController::class, 'removeProductCart'])
		->name('remove.product.cart');


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



