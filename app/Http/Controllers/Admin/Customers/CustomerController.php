<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist\Wishlist;
use App\Models\Cart\Cart;
use App\Models\Orders\Order;
use Session;

class CustomerController extends Controller
{
   
    public function index()
    {
        $data['customers'] = User::All();
        return view('admin.customers.index',$data);
    }

    
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)   
    {
        $data['customer'] = User::where('id',$id)->first();
        return view('admin.customers.show',$data);
    }
    public function edit($id)
    {
        $data['customer'] = User::where('id',$id)->first();
        return view('admin.customers.add-edit',$data);
    }
    public function update(Request $request, $id)
    {
         $updates = User::findOrFail($id);
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'image'=>'nullable|mimes:jpg,png,jpeg,pdf|max:1024'
        ]);
        
        $input = $request->all();
           if($request->image){
            $file = time().'User'.rand('1000','9999').'.'.$request->image->extension();
            $request->image->move(public_path('images'),$file);
            $input['image'] = $file;
            $updates->update($input);
           }
           else{
            $updates->update($input);
           }
        Session::flash('success', 'Customer Details is Updated Successfully');
        return back();
    }
    
    public function destroy($id)
    {
        //
    }

    public function wishlist($id)
    {
        $data['wishlists'] = Wishlist::where('user_id',$id)->get();
        $data['customer'] = User::where('id',$id)->first();
        return view('admin.customers.wishlist',$data);

    }
    public function cart($id)
    {
        $data['carts'] = Cart::where(['is_ordered'=>'no','user_id'=>$id])->get();
        $data['customer'] = User::where('id',$id)->first();
        return view('admin.customers.cart',$data);

    }

    public function orders($id)
    {
        $data['orders'] = Order::where('user_id',$id)->get();
        $data['customer'] = User::where('id',$id)->first(); 
        return view('admin.customers.orders',$data);

    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $Brand = User::findOrFail($request->id);
        $Brand->status = $request->status;
        $Brand->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }
}
