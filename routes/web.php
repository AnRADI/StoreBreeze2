<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\CategoriesController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\DashboardController;
use Inertia\Inertia;


// -------- Welcome ----------

Route::get('/', [WelcomeController::class, 'welcome'])
	->name('welcome');

Route::post('/submit/welcome', [WelcomeController::class, 'submitWelcome'])
	->name('submit.welcome');


// -------- Dashboard ----------

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

	Route::get('/dashboard', [DashboardController::class, 'dashboard'])
		->name('dashboard');
});

// -------- Auth ----------

require __DIR__.'/auth.php';


// -------- Test ----------

Route::get('/zero', function () {
	return Inertia::render('Zero');
});


// -------- Cart ----------

Route::get('/cart', [CartController::class, 'cart'])
	->name('cart');


Route::post('/add/{product}/cart', [CartController::class, 'addProductCart'])
	->name('add.product.cart');


Route::delete('/remove/{product}/cart', [CartController::class, 'removeProductCart'])
	->name('remove.product.cart');



// -------- Categories ----------

Route::get('/categories', [CategoriesController::class, 'categories'])
	->name('categories');


// -------- Category ----------

Route::get('/{category}', [CategoryController::class, 'category'])
	->name('category');


// -------- Product ----------

Route::get('/{category}/{product}', [ProductController::class, 'product'])
	->name('category.product');
