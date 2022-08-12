<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\WelcomeController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;


// -------- / ----------

Route::get('/', [WelcomeController::class, 'index'])
	->name('welcome');


// -------- /categories ----------

Route::get('/categories', [CategoryController::class, 'index'])
	->name('categories');

Route::get('/categories/{category_slug}', [CategoryController::class, 'show'])
	->name('categories.category.show');


// -------- /products/{category_slug}/{product} ----------

Route::get('products/{category_slug}/{product}', [ProductController::class, 'show'])
	->name('products.category.product.show');


// --------/cart ----------

Route::patch('/cart/{category_slug}/{product}', [CartController::class, 'addToCart'])
	->name('cart.category.product.update');


Route::middleware(['auth', 'role:user|admin'])->group(function () {


	// -------- /logout ----------

	Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
		->name('logout.store');

});


Route::middleware(['auth', 'role:admin'])->group(function () {


	// -------- /dashboard ----------

	Route::get('/dashboard', [DashboardController::class, 'index'])
		->name('dashboard');


	// -------- /dashboard/products ----------

	Route::get('/dashboard/products', [AdminProductController::class, 'index'])
		->name('dashboard.products');

	Route::get('/dashboard/products/create', [AdminProductController::class, 'create'])
			->name('dashboard.products.create');

	Route::get('/dashboard/products/{product}/edit', [AdminProductController::class, 'edit'])
		->name('dashboard.products.product.edit');

	Route::patch('/dashboard/products/{product}', [AdminProductController::class, 'update'])
		->name('dashboard.products.product.update');

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




