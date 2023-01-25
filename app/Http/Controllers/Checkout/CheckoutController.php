<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart\Cart;
use Auth;
use Session;
use DB;

class CheckoutController extends Controller
{
    public function orderitem($slug)
    {
    	$data['items'] = Cart::where(['is_ordered'=>'no','user_slug'=>$slug])->get();

    	if(isset($data['items'])){
    		$total = DB::table('carts')->where(['is_ordered'=>'no','user_slug'=>Auth::user()->slug])->sum(DB::raw('carts.total_price'));
    		$couponcode = DB::table('coupons')->get();
    		foreach ($couponcode as $couponvalue) {
    			if($couponvalue->min_ord_amt< $total){
    					$data['codes'] = DB::table('coupons')->where('min_ord_amt',$couponvalue->min_ord_amt)->first();
    				}
    			}                 
    	}

    	return view('front.checkout',$data);
    }
}
