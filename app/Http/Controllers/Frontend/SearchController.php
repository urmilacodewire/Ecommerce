<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\Product;
use DB;

class SearchController extends Controller
{
    public function autosearch(Request $request)
    {
        //dd($request->all());
      // if(isset($request->searchNews))
      // {
        
        $data['products'] = Product::select("title")
                ->join('categories','categories.id','=','products.category_id')
                ->select('products.*','categories.name as catname')
                ->where("products.name","LIKE","%".$request->searchNews."%")
                ->orWhere("categories.name","LIKE","%".$request->searchNews."%")
                ->orWhere("description","LIKE","%".$request->searchNews."%")
                ->get();
        return view('index', $data);
      // }
      // else
        if(isset($request->rangeMin) && isset($request->rangeMax) !='')
      {
        $data['popular'] = Product::whereBetween('price', [$request->rangeMin, $request->rangeMax])
               ->get();
        return view('front.shop', $data);
      }elseif(isset($request->color)){
        $data['popular'] = Product::where("color","LIKE","%".$request->color."%")
                ->orWhere("description","LIKE","%".$request->color."%")
                ->get();
        return view('front.shop', $data);
      }else{
        $data['popular'] = Product::where("brand","LIKE","%".$request->brand."%")
                 ->get();
        return view('front.shop', $data);
      }
       //return view('index', $data);
      // return response()->json($data);	
    }
}
