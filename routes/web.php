<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\CategoriesController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use Inertia\Inertia;


// -------- Welcome ----------

Route::get('/', [WelcomeController::class, 'welcome'])
	//->middleware('guest')
	->name('welcome');

Route::post('/submit/welcome', [WelcomeController::class, 'submitWelcome'])
	//->middleware('guest')
	->name('submit.welcome');


// -------- Dashboard ----------

Route::get('/dashboard', function () {

	return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// -------- Auth ----------

require __DIR__.'/auth.php';


// -------- Test ----------

Route::get('/zero', function () {
	return Inertia::render('Zero');
});


// -------- Cart ----------

Route::get('/cart', [CartController::class, 'cart'])
	->middleware('guest')
	->name('cart');


Route::post('/add/{product}/cart', [CartController::class, 'addProductCart'])
	->middleware('guest')
	->name('add.product.cart');


Route::delete('/remove/{product}/cart', [CartController::class, 'removeProductCart'])
	->middleware('guest')
	->name('remove.product.cart');



// -------- Categories ----------

Route::get('/categories', [CategoriesController::class, 'categories'])
	->middleware('guest')
	->name('categories');


// -------- Category ----------

Route::get('/{category}', [CategoryController::class, 'category'])
	->middleware('guest')
	->name('category');


// -------- Product ----------

Route::get('/{category}/{product}', [ProductController::class, 'product'])
	->middleware('guest')
	->name('category.product');
