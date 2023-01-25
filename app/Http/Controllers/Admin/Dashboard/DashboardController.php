<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(){
        
       $data['banners'] = DB::table('banner')->count();
       $data['products'] = DB::table('products')->count();	
       $data['customers'] = DB::table('users')->count();	
       $data['coupons'] = DB::table('coupons')->count();	
        $data['orders'] = DB::table('orders')->count();	

       
        return view('admin.dashboard',$data);
    }
}
