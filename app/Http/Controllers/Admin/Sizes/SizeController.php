<?php

namespace App\Http\Controllers\Admin\Sizes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Sizes\Size;

class SizeController extends Controller
{
    public function index()
    {
        $data['size'] = Size::orderBy('id','ASC')->get();
        return view('admin.size.index', $data);
    }
    public function show($size)
    {
        $category = Size::findOrFail($category);
        $data['active'] = 'product';
        $data['size'] = $size;
        return view('admin.size.show');
    }
    public function create(request $request)
    {
        $data['title'] = 'Create Size';
        $data['type'] = $request->type;
        return view('admin.size.add-edit', $data);
    }
    public function store(Request $request)
    {
        $request->validate(['size' => 'required', 'status' => 'required']);
        $check = Size::where('size',$request->size)->first();
        if(empty($check)){
             Size::create($request->all());
             Session::flash('success', 'size is Added Successfuly');

        }
        Session::flash('success', 'This size Already Added.');
        return back();  
    }
    public function edit($size)
    {
        $size = Size::findOrFail($size);
        $data['size'] = $size;
        $data['title'] = 'Edit Size';
        return view('admin.size.add-edit', $data);
    }
    public function update(Request $request, $size)
    {
        $size = Size::findOrFail($size);
        $check = Size::where('size',$request->size)->first();
        $request->validate(['size' => 'required']);
        if(empty($check)){
             $size->update($request->all());
             Session::flash('success', 'size is Updated Successfuly');
        }
        
        Session::flash('success', 'This size Already Added');
        return back();
    }
    public function destroy(Request $request, $size)
    {
        $size = Size::findOrFail($size);
        $size->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'size Delete Successfully', 'status' => true]);
        }
        Session::flash('success', 'size Delete Successfully');
        return back();
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $Size = Size::findOrFail($request->id);
        $Size->status = $request->status;
        $Size->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }

     public function sortable(Request $request)
    {
       
        $size = size::all();

        foreach ($size as $size) {
            foreach ($request->order as $order) {

                if ($order['id'] == $size->id) {
                    $size->update(['order' => $order['position']]);
                   
                }
            }
        }
        
        return response()->json(['message' => 'Order is Changed Successfully','status' => true]);
    }
}
