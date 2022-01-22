<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
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
Route::group(['middleware' => ['expiry']], function () {


    Route::get('/home', function () {
        return redirect()->route('home');
    });
    Route::group(['prefix' => (new Mcamara\LaravelLocalization\LaravelLocalization)->setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
        Auth::routes();
        Route::group(['middleware' => ['auth:sanctum', 'verified'/*, 'UserRole'*/]], function () {
            Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

            /*----- Customer all Routes -----*/
            Route::prefix('customer')->group(function () {
                Route::get('/view', [CustomerController::class, 'CustomerView'])->name('all.customers');
                Route::post('/store', [CustomerController::class, 'CustomerStore'])->name('customer.store');
                Route::get('/edit/{id}', [CustomerController::class, 'CustomerEdit'])->name('customer.edit');
                Route::post('/update/{id}', [CustomerController::class, 'CustomerUpdate'])->name('customer.update');
                Route::get('/get/{id}', [CustomerController::class, 'GetCustomer'])->name('get.customer');
                /*Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');*/
            });

            /*----- cart all Routes -----*/
            Route::prefix('cart')->group(function () {
                Route::post('/add', [CartController::class, 'addCart'])->name('add.cart');
                Route::get('/remove/{rowid}', [CartController::class, 'removeCart'])->name('remove.cart');
                Route::get('/destroy', [CartController::class, 'destroyCart'])->name('destroy.cart');
                Route::post('/order', [CartController::class, 'makeOrder'])->name('make.order');
            });

            /*----- Category all Routes -----*/
            Route::prefix('category')->group(function () {
                Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
                Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
                Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
                Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
                Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
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

            /*----- Order -----*/
            Route::prefix('order')->group(function () {
                Route::get('/all', [OrderController::class, 'AllOrders'])->name('all-order');
                Route::get('/view/{id}', [OrderController::class, 'ViewOrder'])->name('view-order');
                Route::get('/print/{id}', [OrderController::class, 'PrintOrder'])->name('print-order');
                Route::get('/print-en/{id}', [OrderController::class, 'PrintOrderEN'])->name('print-order-en');
                Route::get('/item/remove/{id}', [OrderController::class, 'RemoveItem'])->name('remove.item');
                Route::get('/item/delete/{id}', [OrderController::class, 'RemoveAllItem'])->name('remove.all.items');
                Route::get('/delete/{id}', [OrderController::class, 'DeleteOrder'])->name('delete.order');
                Route::get('/deleted/all', [OrderController::class, 'DeletedOrders'])->name('deleted.orders');
                Route::get('/restore/{id}', [OrderController::class, 'RestoreOrder'])->name('restore.order');
            });

            /*----- Reports Routes -----*/
            Route::prefix('reports')->group(function () {
                Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');
                Route::get('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');
                Route::get('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');
                Route::get('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');
            });

//        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        });
    });

});

Route::get('Link-Expired', function () {
    return view('errors.419');
})->name('error_419');
