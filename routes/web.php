<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => (new Mcamara\LaravelLocalization\LaravelLocalization)->setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Auth::routes();
    Route::group(['middleware' => ['auth:sanctum', 'verified'/*, 'UserRole'*/]], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


        /*----- Category all Routes -----*/
        Route::prefix('category')->group(function () {
            Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
            Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
            Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
            Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
        });

        /*----- Customer all Routes -----*/
        Route::prefix('customer')->group(function () {
            Route::get('/view', [CustomerController::class, 'CustomerView'])->name('all.customers');
            Route::post('/store', [CustomerController::class, 'CustomerStore'])->name('customer.store');
            Route::get('/edit/{id}', [CustomerController::class, 'CustomerEdit'])->name('customer.edit');
            Route::post('/update/{id}', [CustomerController::class, 'CustomerUpdate'])->name('customer.update');
            /*Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');*/
        });

        /*----- Product all Routes -----*/
        Route::prefix('product')->group(function () {
            Route::get('/ajax/{category_id}', [ProductController::class, 'GetAllProducts']);
            Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
            Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
            Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
            Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
            Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');
            Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
            Route::get('/deleted', [ProductController::class, 'DeletedProducts'])->name('deleted.products');
            Route::get('/restore/{id}', [ProductController::class, 'RestoreProduct'])->name('product.restore');
            Route::get('/in-notification', [ProductController::class, 'ProductNotification'])->name('in.notification');
        });

        /*----- Users -----*/
        Route::prefix('alluser')->group(function () {
            Route::get('/view', [HomeController::class, 'AllUsers'])->name('all-users');
            Route::get('/set-admin/{id}', [HomeController::class, 'SetAdmin'])->name('SetAdmin');
            Route::get('/set-normal/{id}', [HomeController::class, 'SetNormal'])->name('SetNormal');
        });

//        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
});
