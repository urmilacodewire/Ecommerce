<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ShopController extends Controller
{
    public function index()
    {
        $data['popular'] = DB::table('products')->where('popular',1)
                          ->limit(5)
                           ->orderBy('id','desc')
                           ->get();
        return view('front.shop',$data );
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
