<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist\Wishlist;
use App\Models\Cart\Cart;
use App\Models\Orders\Order;
use Session;
use Auth;
use DB;

class OrdersController extends Controller
{
    
    public function index()
    {
        $data['orders'] = Order::join('users','users.id','=','orders.user_id')
                            ->select('orders.*','users.name')->get();
        return view('admin.orders.index',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($orderid)
    {
        $data['orderItem'] = Order::where(['order_id'=>$orderid,'user_id'=>Auth::user()->id])
                            ->join('products','products.id','=','orders.product_ids')
                            ->select('orders.*','products.name','products.price','products.image')
                            ->get();
        
        return view('admin.orders.order-detail',$data);
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        DB::table('orders')->where('order_id',$id)->update([
            'order_status' => $request->order_status
        ]);

        return back();
    }

    public function destroy($id)
    {
        //
    }
}
