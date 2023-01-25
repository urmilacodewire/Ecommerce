<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::orderBy('order','ASC')->get();  
        return view('admin.category.index', $data);
    }
    public function show($category)
    {
        $category = Category::findOrFail($category);
        $data['active'] = 'product';
        $data['category'] = $category;
        return view('admin.category.show');
    }
    public function create(request $request)
    {
        $data['title'] = 'Create Category';
        $data['type'] = $request->type;
        return view('admin.category.add-edit', $data);
    }
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'status' => 'required']);
        $check = Category::where('name',$request->name)->first();
        if(empty($check)){
             Category::create($request->all());
             Session::flash('success', 'Category is Added Successfuly');

        }
        Session::flash('success', 'This Category Already Added.');
        return back();  
    }
    public function edit($category)
    {
        $category = Category::findOrFail($category);
        $data['category'] = $category;
        $data['title'] = 'Edit Category';
        return view('admin.category.add-edit', $data);
    }
    public function update(Request $request, $category)
    {
        $category = Category::findOrFail($category);
        $check = Category::where('name',$request->name)->first();
        $request->validate(['name' => 'required', 'image' => 'image']);
        if(empty($check)){
             $category->update($request->all());
             Session::flash('success', 'Category is Updated Successfuly');
        }
        
        Session::flash('success', 'This Category Already Added');
        return back();
    }
    public function destroy(Request $request, $category)
    {
        $category = Category::findOrFail($category);
        $category->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Category Delete Successfully', 'status' => true]);
        }
        Session::flash('success', 'Category Delete Successfully');
        return back();
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $Brand = Category::findOrFail($request->id);
        $Brand->status = $request->status;
        $Brand->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }

     public function sortable(Request $request)
    {
        $categorys = Category::all();
        foreach ($categorys as $category) {
            foreach ($request->order as $order) {
                if ($order == $category->id) {
                    $category->update(['order' => $order]);   
                }
            }
        }
        return response()->json(['id'=>$order.' '.$category->id,'message' => 'Order is Changed Successfully','status' => true]);
    }
}
