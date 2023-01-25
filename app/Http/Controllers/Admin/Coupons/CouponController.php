<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Coupons\Coupon;
use DB;

class CouponController extends Controller
{
   
    public function index()
    {
         $data['coupons'] = DB::table('coupons')
                            ->where('status',1)->orderBy('id','DESC')
                            ->get();
        return view('admin.coupons.index', $data);
    }

    
    public function create()
    {
        //$data['categories'] = DB::table('categories')->where('status',1)->pluck('name','id');
        $data['title'] = 'Create Coupons';
        return view('admin.coupons.add-edit', $data);
    }

    public function store(Request $request)
    {
        $check = Coupon::where('code',$request->code)->first();
         $request->validate([
            
            'title'             => 'required',
            'code'              => 'required|unique:coupons,code' ,
            'value'             => 'required',
            'type'              => 'required',
            'min_ord_amt'       => 'required',
            'is_one_time'       => 'required',
            'status'            => 'required'
        ]);

      if(empty($check)){
        Coupon::create($request->all());
        Session::flash('success', 'Code is Added Successfuly');
        return back();  
        }else{
            Session::flash('success', 'Code Already is Added.');
        return back();  
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['coupons'] = Coupon::findOrFail($id);
        $data['title'] = 'Edit Coupon';
        return view('admin.coupons.add-edit', $data);
    }

    public function update(Request $request, $id)
    {
        $coupons = Coupon::findOrFail($id);
        
        $request->validate([ 
            'title'             => 'required',
            'code'              => 'required' ,
            'value'             => 'required',
            'type'              => 'required',
            'min_ord_amt'       => 'required',
            'is_one_time'       => 'required',
            'status'            => 'required']);
       
             $coupons->update($request->all());
             Session::flash('success', 'Coupon is Updated Successfuly');
       
        return back();
    }

    public function destroy(Request $request,$id)
    {
        $coupons = Coupon::findOrFail($id);
        $coupons->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Coupon is Deleted Successfully', 'status' => true]);
        }
        Session::flash('success', 'Coupon is Deleted Successfully');
        return back();
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $Brand = Coupon::findOrFail($request->id);
        $Brand->status = $request->status;
        $Brand->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }

}
