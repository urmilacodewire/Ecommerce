<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\Banners\BannerController;
use App\Http\Controllers\Admin\Customers\CustomerController;
use App\Http\Controllers\Admin\Orders\OrdersController;
use App\Http\Controllers\Admin\Carts\CartController;
use App\Http\Controllers\Admin\Coupons\CouponController;
use App\Http\Controllers\Admin\Location\CityController;
use App\Http\Controllers\Admin\Location\StateController;
use App\Http\Controllers\Admin\Location\DistrictController;
use App\Http\Controllers\Admin\Vendors\VendorController;
use App\Http\Controllers\Admin\Brands\BrandController;
use App\Http\Controllers\Admin\Sizes\SizeController;
use App\Http\Controllers\Admin\Colors\ColorController;


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

Route::get('/', [AuthController::class, 'getLogin'])->name('adminLogin');
//Route::get('/login', [AuthController::class, 'getLogin']);
Route::post('/login', [AuthController::class, 'postLogin'])->name('admin.login');

Route::group(['middleware' => 'auth:admin'],function () {
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dasboard');

    /* City */
    Route::resource('/city',CityController::class);
    Route::post('city/status',[CityController::class,'status'])->name('city.status');
    Route::post('city/reorder',[CityController::class,'sortable'])->name('city.sortable');
     
     /* State */
    Route::resource('/state',StateController::class);
    Route::post('state/status',[StateController::class,'status'])->name('state.status');
    Route::post('state/reorder',[StateController::class,'sortable'])->name('state.sortable');
               
    /* District */
    Route::resource('/district',DistrictController::class);
    Route::post('district/status',[DistrictController::class,'status'])->name('district.status');
    Route::post('district/reorder',[DistrictController::class,'sortable'])->name('district.sortable');
          

    /* Category */
    Route::resource('/category',CategoryController::class);
    Route::post('category/status',[CategoryController::class,'status'])->name('category.status');
    Route::post('category/reorder',[CategoryController::class,'sortable'])->name('category.sortable');
    
    /* Brands */
    Route::resource('/brands',BrandController::class);
    Route::post('brands/status',[BrandController::class,'status'])->name('brands.status');
    Route::post('brands/reorder',[BrandController::class,'sortable'])->name('brands.sortable');

     /* Sizes */
    Route::resource('/size',SizeController::class);
    Route::post('size/status',[SizeController::class,'status'])->name('size.status');
    Route::post('size/reorder',[SizeController::class,'sortable'])->name('size.sortable');

    Route::resource('/colors',ColorController::class);
    Route::post('colors/status',[ColorController::class,'status'])->name('colors.status');
    Route::post('colors/reorder',[ColorController::class,'sortable'])->name('colors.sortable');

    /* Vendors */
    Route::resource('/vendors',VendorController::class);
    Route::post('vendors/status',[VendorsController::class,'status'])->name('vendors.status');
    Route::post('vendors/reorder',[VendorsController::class,'sortable'])->name('vendors.sortable');
    Route::get('vendors/step2/{vendor}',[VendorController::class,'step2Form'])->name('vendors.step2');
    Route::post('vendors/step2/{vendor}',[VendorController::class,'step2Post']);
    Route::get('vendors/step3/{vendor}',[VendorController::class,'step3Form'])->name('vendors.step3');
    Route::post('vendors/step3/{vendor}',[VendorController::class,'step3Post']);
    Route::get('vendors/contract/{vendor}',[VendorController::class,'Contract'])->name('vendors.contract.index');
    Route::post('vendors/contract/update/{vendor}',[VendorController::class,'ContractUpdate'])->name('vendors.contract');
    Route::get('vendors/location/{vendor}',[VendorController::class,'location'])->name('vendors.location.index');
    Route::post('vendors/location/update/{vendor}',[VendorController::class,'locationUpdate'])->name('vendors.location');
     Route::get('vendors/products/{vendor}',[VendorController::class,'productlist'])->name('vendors.products');

    /*products*/    
    Route::resource('/products',ProductController::class);
    Route::post('uploads', [ProductController::class, 'uploadImage'])->name('products.upload');
    Route::post('products/status',[ProductController::class,'status'])->name('products.status');
    Route::post('products/popular',[ProductController::class,'popular'])->name('products.popular');
    Route::post('products-sortable',[ProductController::class,'sortable'])->name('products.sortable');
    Route::post('products-images/{id}',[ProductController::class,'Images'])->name('products.images');
    Route::post('images-delete/{id}',[ProductController::class,'ImagesDestroy'])->name('images.destroy');
    Route::get('/products-color/{id}',[ProductController::class,'color'])->name('products.color');
    Route::post('/products-color-store/{id}',[ProductController::class,'colorstore'])->name('products.colorstore');
    Route::post('/products-color-delete/{id}',[ProductController::class,'colordelete'])->name('products.colordelete');
    Route::get('/products-size/{id}',[ProductController::class,'size'])->name('products.size');
    Route::post('/products-size-store/{id}',[ProductController::class,'sizestore'])->name('products.sizestore');
    Route::post('/products-size-delete/{id}',[ProductController::class,'sizedelete'])->name('products.sizedelete');
    

    /*Banners*/ 
    Route::resource('/banner',BannerController::class);

    /*Customers*/
    Route::resource('/customers',CustomerController::class);
    Route::get('/customers-wishlist/{id}',[CustomerController::class,'wishlist'])->name('customers.wishlist');
    Route::get('/customers-cart/{id}',[CustomerController::class,'cart'])->name('customers.cart');
    Route::get('/customers-orders/{id}',[CustomerController::class,'orders'])->name('customers.orders');
    Route::post('/customers/status',[CustomerController::class,'status'])->name('customers.status');
    //Route::post('/customers/status',[CustomerController::class,'status'])->name('customers.sh');


    /*Orders*/
    Route::resource('/orders',OrdersController::class);
    

     /*Carts*/
    Route::resource('/carts',CartController::class);

    ///////Coupon codes
	Route::resource('coupons',CouponController::class);
	 Route::post('coupons/status',[CouponController::class,'status'])->name('coupons.status');

});
