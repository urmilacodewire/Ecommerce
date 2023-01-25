<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Cart\CartsController;
use App\Http\Controllers\Wishlist\WishlistController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Ratingreviews\RatingreviewController;
use App\Http\Controllers\Coupons\CouponController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\Shop\ShopController;
use App\Mail\MyTestMail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/////////////////////////

Route::get('/',[HomeController::class,'index'])->name('front.home');
Route::get('products/{name}',[HomeController::class,'products']);

Route::get('product-detail/{slug}',[HomeController::class,'productdetail'])->name('product-detail');
Route::get('news-detail/{id}',[HomeController::class,'newsdetail'])->name('news-detail');
Route::get('generate-pdf/{slug}', [HomeController::class, 'generatePDF'])->name('generate-pdf');
//Route::get('search',[SearchController::class,'index'])->name('search');
Route::post('autosearch',[SearchController::class,'autosearch'])->name('autosearch');

////////	
Route::group(['middleware' => 'auth:web'],function () {

	////////User
	Route::get('myaccount/{id?}',[HomeController::class,'myaccount'])->name('myaccount');

	////////Shop
	Route::resource('shop',ShopController::class);

	/////Cart
	Route::get('cart/{id}',[CartsController::class,'additem']);
	Route::get('cartlist/{id}',[CartsController::class,'cartList']);
	Route::get('cartlist/increase/{id}',[CartsController::class,'cartListIncrease'])->name('cart.increase');
	Route::get('cartlist/decrease/{id}',[CartsController::class,'cartListDecrease'])->name('cart.decrease');
	//Route::post('cart/{id}',[CartController::class,'destroy'])->name('cart.destroy');
	Route::resource('cartlist',CartsController::class);

	///////Wishlist
	Route::get('wishlist/{id}',[WishlistController::class,'additem']);
	Route::get('wishlist-items/{slug}',[WishlistController::class,'wishlist']);

	////////Checkout
	Route::get('checkout/{id}',[CheckoutController::class,'orderitem'])->name('checkout');

	////////Orders 
	Route::resource('order',OrderController::class);
	Route::get('user-orders/{id}',[OrderController::class,'ordersList']);
	Route::get('order-details/{id}',[OrderController::class,'ordersdetails']);
	Route::get('payment/{id}',[OrderController::class,'payment']);

	////////Rating & Reviews
	Route::resource('rating-reviews',RatingreviewController::class);

	///////Coupon codes
	Route::resource('coupon',CouponController::class);
	Route::post('couponcode',[CouponController::class,'coupon']);

	/////////paypal payment
	Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
	Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
	Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
	Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

	Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    Mail::to('urmila.codewire@gmail.com')->send(new \App\Mail\MyTestMail($details));
    dd("Email is Sent.");
	});
	Route::post("send-email", [HomeController::class, "composeEmail"])->name("send-email");
 

});

Route::get('/about', function(){
		return view('about');
});
Route::get('/advertising', function(){
		return view('advertising');
});
Route::get('/term-condition', function(){
		return view('term_condition');
});
Route::get('/privacy-policy', function(){
		return view('privacy');
});

