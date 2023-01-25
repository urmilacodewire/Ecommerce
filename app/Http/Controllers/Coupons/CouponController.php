<?php

namespace App\Http\Controllers\Coupons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupons\Coupon;
use Auth;
use Session;

class CouponController extends Controller
{
    
    public function index(Request $request)
    {
       
    }

    public function create()
    {
        //Session::flash('success','Please enter valid code');
            //return back();

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

    public function coupon(Request $request)
    {
         $check = Coupon::where(['code'=>$request->code])->first();
       
        if(isset($check)){
            if($check->status ==1){ 
                if($check->is_one_time ==1){
                   $msg ='code already is used.';
                   $status =  true;
                   return response()->json(['msg'=>$msg,'status' => $status]);
                }else{
                    $min_amt = $check->min_ord_amt;
                    if($min_amt<$request->totalamt){
                            if($check->type == 'Value'){
                               $totalamt = $request->totalamt - $check->value; 
                            }
                            if($check->type == 'Percent'){
                               $discountamt = ($request->totalamt*$check->value)/100; 
                               $totalamt = $request->totalamt - $discountamt;
                            }
                         $msg ='code is applied.';
                         $status =  true;
                         return response()->json(['totalprice'=>$totalamt,'msg'=>$msg,'status' => $status]);
                    }else{
                        $msg ="Total amount must be greater than $min_amt.";
                        $status =  true;
                        return response()->json(['msg'=>$msg,'status' => $status]);
                    }
                }
            }else{
                 $msg ='code is deactivated.';
                 $status =  true;
                  return response()->json(['msg'=>$msg,'status' => true]);
            }
        }else{
            $msg ='Please enter valid code.';
            $status =  true;
            return response()->json(['msg'=>$msg,'status' => true]);
        }
    }
}
