<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubSubCategoryController;
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
        Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
            Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('UserRole');

            /*----- Customer all Routes -----*/
            Route::prefix('customer')->group(function () {
                Route::get('/view', [CustomerController::class, 'CustomerView'])->name('all.customers')->middleware('UserRole');
                Route::post('/store', [CustomerController::class, 'CustomerStore'])->name('customer.store')->middleware('UserRole');
                Route::get('/edit/{id}', [CustomerController::class, 'CustomerEdit'])->name('customer.edit')->middleware('UserRole');
                Route::post('/update/{id}', [CustomerController::class, 'CustomerUpdate'])->name('customer.update')->middleware('UserRole');
                Route::get('/get/{id}', [CustomerController::class, 'GetCustomer'])->name('get.customer')->middleware('UserRole');
                /*Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');*/
            });

            /*----- cart all Routes -----*/
            Route::prefix('cart')->group(function () {
                Route::post('/add', [CartController::class, 'addCart'])->name('add.cart')->middleware('UserRole');
                Route::get('/remove/{rowid}', [CartController::class, 'removeCart'])->name('remove.cart')->middleware('UserRole');
                Route::get('/destroy', [CartController::class, 'destroyCart'])->name('destroy.cart')->middleware('UserRole');
                Route::post('/order', [CartController::class, 'makeOrder'])->name('make.order')->middleware('UserRole');
            });

            /*----- Category all Routes -----*/
            Route::prefix('category')->group(function () {
                Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
                Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store')->middleware('UserRole');
                Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit')->middleware('UserRole');
                Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update')->middleware('UserRole');
                Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete')->middleware('UserRole');
            });

            /*----- Sub Category all Routes -----*/
            Route::prefix('subcategory')->group(function () {
                Route::get('/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.sub.category');
                Route::post('/store', [SubCategoryController::class, 'SubCategoryStore'])->name('sub.category.store')->middleware('UserRole');
                Route::get('/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('sub.category.edit')->middleware('UserRole');
                Route::post('/update/{id}', [SubCategoryController::class, 'SubCategoryUpdate'])->name('sub.category.update')->middleware('UserRole');
                Route::get('/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('sub.category.delete')->middleware('UserRole');
                Route::post('/get', [SubCategoryController::class, 'GetSubCategory'])->name('getSubCategories');
            });

            /*----- Sub Sub Category all Routes -----*/
            Route::prefix('sub-sub-category')->group(function () {
                Route::get('/view', [SubSubCategoryController::class, 'SubSubCategoryView'])->name('all.sub.sub.category');
                Route::post('/store', [SubSubCategoryController::class, 'SubSubCategoryStore'])->name('sub.sub.category.store')->middleware('UserRole');
                Route::get('/edit/{id}', [SubSubCategoryController::class, 'SubSubCategoryEdit'])->name('sub.sub.category.edit')->middleware('UserRole');
                Route::post('/update/{id}', [SubSubCategoryController::class, 'SubSubCategoryUpdate'])->name('sub.sub.category.update')->middleware('UserRole');
                Route::get('/delete/{id}', [SubSubCategoryController::class, 'SubSubCategoryDelete'])->name('sub.sub.category.delete')->middleware('UserRole');
                Route::post('/get', [SubSubCategoryController::class, 'GetSubSubCategory'])->name('getSubSubCategories');
            });

            /*----- Product all Routes -----*/
            Route::prefix('product')->group(function () {
                Route::get('/ajax/{category_id}', [ProductController::class, 'GetAllProducts']);
                Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product')->middleware('UserRole');
                Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store')->middleware('UserRole');
                Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
                Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit')->middleware('UserRole');
                Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update')->middleware('UserRole');
                Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete')->middleware('UserRole');
                Route::get('/deleted', [ProductController::class, 'DeletedProducts'])->name('deleted.products')->middleware('UserRole');
                Route::get('/restore/{id}', [ProductController::class, 'RestoreProduct'])->name('product.restore')->middleware('UserRole');
                Route::get('/in-notification', [ProductController::class, 'ProductNotification'])->name('in.notification');
                Route::get('/barcode-gen/{id}', [ProductController::class, 'barcodegen'])->name('barcode');
            });

            /*----- Users -----*/
            Route::prefix('alluser')->group(function () {
                Route::get('/view', [HomeController::class, 'AllUsers'])->name('all-users')->middleware('UserRole');
                Route::get('/set-admin/{id}', [HomeController::class, 'SetAdmin'])->name('SetAdmin')->middleware('UserRole');
                Route::get('/set-normal/{id}', [HomeController::class, 'SetNormal'])->name('SetNormal')->middleware('UserRole');
                Route::get('/set-viewer/{id}', [HomeController::class, 'SetViewer'])->name('SetViewer')->middleware('UserRole');
                Route::get('/set-product/{id}', [HomeController::class, 'SetProduct'])->name('SetProduct')->middleware('UserRole');
                Route::get('/delete-user/{id}', [HomeController::class, 'DeleteUser'])->name('delete.user')->middleware('UserRole');
            });

            /*----- Order -----*/
            Route::prefix('order')->group(function () {
                Route::get('/all', [OrderController::class, 'AllOrders'])->name('all-order');
                Route::get('/view/{id}', [OrderController::class, 'ViewOrder'])->name('view-order');
                Route::get('/print/{id}', [OrderController::class, 'PrintOrder'])->name('print-order')->middleware('UserRole');
                Route::get('/print-en/{id}', [OrderController::class, 'PrintOrderEN'])->name('print-order-en')->middleware('UserRole');
                Route::get('/item/remove/{id}', [OrderController::class, 'RemoveItem'])->name('remove.item')->middleware('UserRole');
                Route::get('/item/delete/{id}', [OrderController::class, 'RemoveAllItem'])->name('remove.all.items')->middleware('UserRole');
                Route::get('/delete/{id}', [OrderController::class, 'DeleteOrder'])->name('delete.order')->middleware('UserRole');
                Route::get('/deleted/all', [OrderController::class, 'DeletedOrders'])->name('deleted.orders')->middleware('UserRole');
                Route::get('/restore/{id}', [OrderController::class, 'RestoreOrder'])->name('restore.order')->middleware('UserRole');
            });

            /*----- returns -----*/
            Route::prefix('returns')->group(function () {
                Route::get('/make', [ReturnController::class, 'AllReturns'])->name('make-returns')->middleware('UserRole');
                Route::post('/make', [ReturnController::class, 'MakeReturns'])->name('make-returns-post')->middleware('UserRole');
                Route::get('/all', [ReturnController::class, 'ViewReturns'])->name('all-returns');
                Route::get('/details/{id}', [ReturnController::class, 'ViewReturn'])->name('view-return');
                Route::get('/delete/{id}', [ReturnController::class, 'DeleteReturn'])->name('delete.return')->middleware('UserRole');
                Route::get('/print/{id}', [ReturnController::class, 'PrintReturn'])->name('print-return')->middleware('UserRole');
                Route::get('/print-en/{id}', [ReturnController::class, 'PrintReturnEN'])->name('print-return-en')->middleware('UserRole');
            });

            /*----- Reports Routes -----*/
            Route::prefix('reports')->group(function () {
                Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports')->middleware('UserRole');
                Route::get('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date')->middleware('UserRole');
                Route::get('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month')->middleware('UserRole');
                Route::get('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year')->middleware('UserRole');
                Route::get('/print/by/date/{date}', [ReportController::class, 'PrintDate'])->name('print-report-day')->middleware('UserRole');
                Route::get('/print/by/month/{date}', [ReportController::class, 'PrintMonth'])->name('print-report-month')->middleware('UserRole');
                Route::get('/print/by/year/{date}', [ReportController::class, 'PrintYear'])->name('print-report-year')->middleware('UserRole');
            });

//        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        });
    });

});

Route::get('Link-Expired', function () {
    return view('errors.419');
})->name('error_419');

\PWA::routes();
