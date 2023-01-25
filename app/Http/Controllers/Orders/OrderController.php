<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders\Order;
use App\Models\Cart\Cart;
use Auth;
use Session;
use Carbon\Carbon;

class OrderController extends Controller
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
        //dd($request->all());  
        $request->validate([
                 'user_slug'            => 'required',
                 'product_ids'        => 'required',
                 'product_qunty'      => 'required',
                 'per_prod_price'     => 'required',
                 'total_amt'          => 'required',
                 'delivery_addr'      => 'required',
                 'pincode'            =>  'required|digits:6',
                 'payment_type'       => 'required'
                
        ]) ; 
        $order_id     = strtoupper(Auth::user()->name).rand('10000','99999');
        $o_date       = Carbon::parse(date('d-m-Y'))->format('d-m-Y');
        $o_time       = Carbon::parse(now('Asia/Kolkata'))->format('h:i:s A');
        
        $product_ids = $request->product_ids;
        $product_qunty = $request->product_qunty;
        $per_prod_price = $request->per_prod_price;

        for ($i=0; $i<count($request->product_ids);$i++) {
           $ordered = Order::create([
                'order_id'      => $order_id,
                'user_slug'       => Auth::user()->slug,
                'product_ids'   => $product_ids[$i],
                'product_qunty' => $product_qunty[$i],
                'per_prod_price'=> $per_prod_price[$i],
                'total_amt'     => $request->total_amt,
                'delivery_addr' => $request->delivery_addr,
                'city'          => $request->city,  
                'state'         => $request->state,
                'pincode'       => $request->pincode,
                'payment_id'    => 1,
                'payment_type'  => $request->payment_type,
                'payment_status'=> 'Pending',
                'couponcode'    => $request->couponcode,
                'couponvalue'   => $request->couponvalue,
                'coupontype'    => $request->coupontype,
                'amt_after_coupon'=>$request->amt_after_coupon,
                'o_date'        => $o_date,
                'o_time'        => $o_time 
            ]);
        }

        $idss = $request->product_ids;
        if($ordered){
            Cart::whereIn('product_id', $idss)  
                ->update([
                    'is_ordered' => 'yes' 
                ]);
                }

        Session::flash('success', 'Order is Added Successfuly.');
        return back();
       
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
       
    }

    public function destroy($id)
    {
        //
    }

    ///User orders list view 

    public function ordersList()
    {
        $data['orderslist'] = Order::where('user_id',Auth::user()->id)->get();
        return view('front.orderslist',$data);
    }

    public function ordersdetails($orderid)
    {
        $data['orderItem'] = Order::where(['order_id'=>$orderid,'user_slug'=>Auth::user()->slug])
                            ->join('products','products.id','=','orders.product_ids')
                            ->select('orders.*','products.name','products.price','products.image')
                            ->get();
        
        return view('front.orderItemDetail',$data);
    }
}
