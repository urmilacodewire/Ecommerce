<?php

namespace App\Http\Controllers\Admin\Carts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist\Wishlist;
use App\Models\Cart\Cart;
use App\Models\Orders\Order;
use Session;

class CartController extends Controller
{
    
    public function index()
    {
         $data['carts'] = Cart::join('users','carts.user_id','=','users.id')
                                ->where('carts.is_ordered','no')
                                ->get();
        return view('admin.carts.index',$data);
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

    public function destroy($id)
    {
        //
    }
}
