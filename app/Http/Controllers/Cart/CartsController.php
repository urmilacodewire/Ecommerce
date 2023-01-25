<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart\Cart;
use App\Models\Products\Product;
use Auth;
use Session;
use DB;

class CartsController extends Controller
{
   
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request ,$id)
    {   
        DB::table('carts')->where(['user_slug'=>Auth::user()->slug,'product_id'=>$id])->delete();
       // $item = Cart::findOrFail($id)->delete();    
        // if ($request->ajax() || $request->wantsJson()) {
        //     return response()->json(['message' => 'Item is Deleted Successfully', 'status' => true]);
        // }
        Session::flash('success', 'Item is Deleted Successfully');
        return back();
    }

     public function additem(Request $request , $prod_id)
    {
        $check = Product::where('id',$prod_id)->first();
        if($check->quantity > 0){
            $item = Cart::where(['product_id'=>$prod_id,'is_ordered'=>'no','user_slug'=>Auth::user()->slug])->first();

            if($item)
            {
                Session::flash('success', 'Product already is Added to cart.');
                return back();
            }else
            {   $input = $request->all();

                $input['user_slug'] = Auth::user()->slug;
                $input['product_id'] = $prod_id;
                $input['total_price'] = $request->prod_price*1; 
                //dd($input);
                Cart::create($input);
                Session::flash('success', 'Product is Added to cart Successfuly.');
                return back();
            }
        }else{
            Session::flash('success', 'Product is not available in stock.');
                return back();
        }
    }

    public function cartList($userid)
    {
        $data['items'] = Cart::where(['is_ordered'=>'no','user_slug'=>Auth::user()->slug])->get();
        return view('front.cartlist',$data);
    }

    public function cartListIncrease($pid)
    {
        Cart::where(['user_slug'=>Auth::user()->slug,'product_id'=>$pid])->increment('product_qunty',1);

        $item = Cart::where(['user_slug'=>Auth::user()->slug,'product_id'=>$pid])->first();
        Cart::where(['user_slug'=>Auth::user()->slug,'product_id'=>$pid])->update([
            'total_price' => $item->product_qunty*$item->prod_price
        ]);
        return back();
    }

     public function cartListDecrease($pid)
    {
        $item = Cart::where(['user_slug'=>Auth::user()->slug,'product_id'=>$pid])->first();

        if($item->product_qunty > 0){
            Cart::where(['user_slug'=>Auth::user()->slug,'product_id'=>$pid])->decrement('product_qunty',1);
            $item = Cart::where(['user_slug'=>Auth::user()->slug,'product_id'=>$pid])->first();

            Cart::where(['user_slug'=>Auth::user()->slug,'product_id'=>$pid])->update([
            'total_price' => $item->product_qunty*$item->prod_price ]);
            
        }

        return back();
    }

}
