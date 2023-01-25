<?php

namespace App\Http\Controllers\Admin\Brands;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Brand\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $data['brands'] = Brand::orderBy('id','ASC')->get();
        return view('admin.brands.index', $data);
    }
    public function show($brands)
    {
        $category = Brand::findOrFail($category);
        $data['active'] = 'product';
        $data['brands'] = $brands;
        return view('admin.brands.show');
    }
    public function create(request $request)
    {
        $data['title'] = 'Create Brand';
        $data['type'] = $request->type;
        return view('admin.brands.add-edit', $data);
    }
    public function store(Request $request)
    {
        $request->validate(['name' => 'required','image'=>'required|mimes:jpg,png,jpeg,pdf|max:500', 'status' => 'required']);
        $check = Brand::where('name',$request->name)->first();
        if(empty($check)){
            $input = $request->all();
            $file = time().'Brand'.rand('1000','9999').'.'.$request->image->extension();
            $request->image->move(public_path('images'),$file);
            $input['image'] = $file;
            $input['slug'] = str_replace(' ', '_', $request->name);
             Brand::create($input);
             Session::flash('success', 'brands is Added Successfuly');

        }
        Session::flash('success', 'This brands Already Added.');
        return back();  
    }
    public function edit($brands)
    {
        $brands = Brand::findOrFail($brands);
        $data['brands'] = $brands;
        $data['title'] = 'Edit Brand';
        return view('admin.brands.add-edit', $data);
    }
    public function update(Request $request, $brands)
    {
        $brands = Brand::findOrFail($brands);
        //$check = Brand::where('name',$request->name)->first();
        $request->validate(['name' => 'required', 'image' => 'nullable|mimes:jpg,png,jpeg,pdf|max:500','status'=>'required']);
        //if(empty($check)){
            $input = $request->all();
           if($request->image){
            $file = time().'Brand'.rand('1000','9999').'.'.$request->image->extension();
            $request->image->move(public_path('images'),$file);
            $input['image'] = $file;
            $brands->update($input);
           }
           else{
            $brands->update($input);
           }
             //$brands->update($input);
             Session::flash('success', 'brands is Updated Successfuly');
        //}
        
        //Session::flash('success', 'This brands Already Added');
        return back();
    }
    public function destroy(Request $request, $brands)
    {
        $brands = Brand::findOrFail($brands);
        $brands->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'brands Delete Successfully', 'status' => true]);
        }
        Session::flash('success', 'brands Delete Successfully');
        return back();
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $Brand = Brand::findOrFail($request->id);
        $Brand->status = $request->status;
        $Brand->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }

     public function sortable(Request $request)
    {
       
        $brands = brands::all();

        foreach ($brands as $brands) {
            foreach ($request->order as $order) {

                if ($order['id'] == $brands->id) {
                    $brands->update(['order' => $order['position']]);
                   
                }
            }
        }
        
        return response()->json(['message' => 'Order is Changed Successfully','status' => true]);
    }
}
