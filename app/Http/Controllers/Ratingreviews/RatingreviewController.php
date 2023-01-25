<?php

namespace App\Http\Controllers\Ratingreviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders\Order;
use App\Models\RatingReviews\Rating_review;
use Auth;
use Session;
use Carbon\Carbon;

class RatingreviewController extends Controller
{
    
    public function index()
    {
        // $data['rating'] = Rating_review::All();
        // return view('product_detail',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
                    'product_id'  => 'required',
                    'user_id'  => 'required',
                    'rating'  => 'required',
                    'review'  => 'required'
                ]);
        
           $check = Rating_review::where(['user_id'=>Auth::user()->id,'product_id'=>$request->product_id])->first();     
        if($check) {
            Rating_review::where(['user_id'=>Auth::user()->id,'product_id'=>$request->product_id])
                    ->update([
                    'rating'=>$request->rating,
                    'review'=>$request->review
            ]);
             Session::flash('success','Rated Successfully');
              return back();
        }else{
            Rating_review::create($request->all());
            Session::flash('success','Rated Successfully');
             return back();
        }    
        
    }

    public function show($id)
    {
        // $data['rating'] = Rating_review::where();
        // return view('product_detail',$data);
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
