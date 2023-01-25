<?php

namespace App\Http\Controllers\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist\Wishlist;
use App\Models\Products\Product;
use Auth;
use Session;

class WishlistController extends Controller
{
    public function additem(Request $request , $prod_id)
    {
        $check = Product::where('id',$prod_id)->first();
        if($check->quantity > 0){
            $item = Wishlist::where(['product_id'=>$prod_id,'user_id'=>Auth::user()->id])->first();

            if($item)
            {
                Session::flash('success', 'Product already is Added to Wishlist.');
                return back();
            }else
            {   $input = $request->all();

                $input['user_slug'] = Auth::user()->slug;
                $input['product_id'] = $prod_id;
                $input['product_qunty'] = $check->quantity;
                Wishlist::create($input);
                Session::flash('success', 'Product is Added to cart Successfuly.');
                return back();
            }
        }else{
            Session::flash('success', 'Product is not available in stock.');
                return back();
        }
    }

    public function wishlist($slug)
    {
        $data['items'] = Wishlist::where(['user_slug'=>Auth::user()->slug])
                                ->join('products','products.id','=','wishlists.product_id')
                                ->select('wishlists.*','products.price')
                                ->get();
        return view('front.wishlist',$data);
    }
}
