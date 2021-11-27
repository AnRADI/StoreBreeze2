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
use Inertia\Inertia;



Route::middleware(['admin'])->group(function () { //'auth', 'verified',


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

	Route::get('/', [WelcomeController::class, 'welcome'])
		->name('welcome');

	Route::post('/submit/welcome', [WelcomeController::class, 'submitWelcome'])
		->name('submit.welcome');

	Route::get('/language/{locale}', [WelcomeController::class, 'languageLocale'])
		->name('language.locale');


	// --------/cart ----------

	Route::get('/cart', [CartController::class, 'cart'])
		->name('cart');


	Route::post('/add/{category}/cart', [CartController::class, 'addProductCart'])
		->name('add.product.cart');


	Route::delete('/remove/{product}/cart', [CartController::class, 'removeProductCart'])
		->name('remove.product.cart');


	// -------- /categories ----------

	Route::get('/categories', [CategoryController::class, 'categories'])
		->name('categories');


	// -------- /{category} ----------

	Route::get('/{category}', [CategoryController::class, 'category'])
		->name('category');


	// -------- /{category}/{product} ----------

	Route::get('/{category}/{product}', [ProductController::class, 'product'])
		->name('category.product');
});



