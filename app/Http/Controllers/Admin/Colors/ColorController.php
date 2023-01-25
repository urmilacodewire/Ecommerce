<?php

namespace App\Http\Controllers\Admin\Colors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Colors\Color;

class ColorController extends Controller
{
    public function index()
    {
        $data['colors'] = Color::orderBy('id','ASC')->get();
        return view('admin.colors.index', $data);
    }
    public function show($colors)
    {
        $category = Color::findOrFail($category);
        $data['active'] = 'product';
        $data['colors'] = $colors;
        return view('admin.colors.show');
    }
    public function create(request $request)
    {
        $data['title'] = 'Create Brand';
        $data['type'] = $request->type;
        return view('admin.colors.add-edit', $data);
    }
    public function store(Request $request)
    {
        $request->validate(['color' => 'required', 'status' => 'required']);
        $check = Color::where('color',$request->color)->first();
        if(empty($check)){
             Color::create($request->all());
             Session::flash('success', 'Colors is Added Successfuly');

        }
        Session::flash('success', 'This Colors Already Added.');
        return back();  
    }
    public function edit($colors)
    {
        $colors = Color::findOrFail($colors);
        $data['colors'] = $colors;
        $data['title'] = 'Edit Brand';
        return view('admin.colors.add-edit', $data);
    }
    public function update(Request $request, $colors)
    {
        $colors = Color::findOrFail($colors);
        $check = Color::where('color',$request->color)->first();
        $request->validate(['color' => 'required']);
        if(empty($check)){
             $colors->update($request->all());
             Session::flash('success', 'Colors is Updated Successfuly');
        }
        
        Session::flash('success', 'This Colors Already Added');
        return back();
    }
    public function destroy(Request $request, $colors)
    {
        $colors = Color::findOrFail($colors);
        $colors->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Colors Delete Successfully', 'status' => true]);
        }
        Session::flash('success', 'Colors Delete Successfully');
        return back();
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $Brand = Color::findOrFail($request->id);
        $Brand->status = $request->status;
        $Brand->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }

     public function sortable(Request $request)
    {
       
        $colors = Color::all();

        foreach ($colors as $colors) {
            foreach ($request->order as $order) {

                if ($order['id'] == $colors->id) {
                    $colors->update(['order' => $order['position']]);
                   
                }
            }
        }
        
        return response()->json(['message' => 'Order is Changed Successfully','status' => true]);
    }
}
