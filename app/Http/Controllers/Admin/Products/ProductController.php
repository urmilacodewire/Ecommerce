<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Products\Product;
use App\Models\Productimages\Productimages;
use App\Models\Colors\Color;
use App\Models\Sizes\Size;
use DB;

class ProductController extends Controller
{
    
    public function index()
    {
        $data['products'] = DB::table('products')
                            -> join('categories','products.category_id','=','categories.id')
                            //->join('rating_review','products.id','=','rating_review.product_id')
                            ->where('products.status',1)->orderBy('products.id','DESC')
                            ->select('products.*','categories.name as catname')
                            ->get();
        // 
        $data['categories'] = DB::table('categories')->where('status',1)->pluck('name','id');
        return view('admin.products.index', $data);
    }

    public function create()
    {                       
        $data['color'] = DB::table('colors')->distinct('color')->pluck('color','id');
        $data['size'] = DB::table('sizes')->distinct('size')->pluck('size','id');
        $data['brand'] = DB::table('brands')->distinct('name')->pluck('name','id');
        $data['vendor'] = DB::table('vendors')->where('status','active')->pluck('name','id');
        $data['categories'] = DB::table('categories')->where('status',1)->pluck('name','id');
        $data['title'] = 'Create Product';
        //dd($data);
        return view('admin.products.add-edit', $data);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'vendor_id'    => 'required',
            'name'        => 'required',
            'category_id' => 'required',
            //'type'        => 'required' ,
            'brand'       => 'required',
            'model'       => 'required',
            'color'       => 'required',
            'size'        => 'required',
            'slug'        => 'nullable|unique:products,slug',
            'warranty'    => 'required',
            'mrp'         => 'required',
            'price'       => 'required',
            'quantity'    => 'required',
            'description' => 'required',
            'image'       =>'required|mimes:jpg,png,jpeg,pdf|max:1024',
            'meta_title'  =>'required',
            'meta_keyword'=>'required',
            'meta_desc'   =>'required',
            'popular'     =>'nullable'
        ]);

        $input = $request->all();
        $file = time().'Image'.rand('1000','9999').'.'.$request->image->extension();
        $request->image->move(public_path('images'),$file);
        $input['image'] = $file;
        $slug  = str_replace(' ', '_', $request->name);
        $input['slug'] = $slug;
        $insert = product::create($input);
        Session::flash('success', 'product is Added Successfuly');
        return back();  
    }
    
    public function show($id)
    {
        $data['product'] = Product::where('id',$id)->first();
        $data['products'] = Product::findOrFail($id);
        $data['images'] = Productimages::where('product_id',$id)->get();
        $data['title'] = 'Upload Images';
        //dd($data);
        return view('admin.products.images',$data);
    }

    public function edit($id)
    {
         $data['color'] = DB::table('colors')->pluck('color','id');
        $data['size'] = DB::table('sizes')->pluck('size','id');
        $data['brand'] = DB::table('brands')->pluck('name','id');
        $data['vendor'] = DB::table('vendors')->where('status','active')->pluck('name','vendor_id');
        $data['categories'] = DB::table('categories')->where('status',1)->pluck('name','id');
        $product = Product::findOrFail($id);
        $data['products'] = $product;
        $data['title'] = 'Edit Product';
        return view('admin.products.add-edit', $data);
    }
   
    public function update(Request $request, $id)
    {
       // dd($request->all());

        $product = Product::findOrFail($id);
        $request->validate([
            'vendor_id'    => 'required',
            'name'         => 'required',
            'category_id' => 'required',
            //'type'     => 'required' ,
            'brand'       => 'required',
            'model'       => 'required',
            'color'       => 'required',
            'size'        => 'required',
            'warranty'    => 'required',
            'mrp'         => 'required',
            'price'       => 'required',
            'quantity'    => 'required',
            'description' => 'required',
            'image'       =>'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'meta_title'  =>'required',
            'meta_keyword'=>'required',
            'meta_desc'   =>'required',
            'popular'     =>'nullable'
         ]);

        $input = $request->all();
       if($request->image){
        $file = time().'Image'.rand('1000','9999').'.'.$request->image->extension();
        $imgdata = $request->image->move(public_path('images'),$file);
        $input['image'] = $file;
        $updateid = $product->update($input);
       }
       else{
        $updateid = $product->update($input);
       }

       Session::flash('success', 'Product is Updated Successfully');
       return back();
    }

    public function destroy(Request $request , $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Product is Deleted Successfully', 'status' => true]);
        }
        Session::flash('success', 'Product is Deleted Successfully');
        return back();
    }

    public function uploadImage(Request $request)
    {
        if($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$extension;
            $request->file('upload')->move('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/'.$filenametostore);
            $message = 'File uploaded successfully';
            $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $result;
        }
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $produc = Product::findOrFail($request->id);
        $product->status = $request->status;
        $product->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }

    public function Images(Request $request,$prodid)
    {
        $request->validate([
            'imagename'       =>'required|mimes:jpg,png,jpeg,pdf|max:1000'
        ]);

        $input = $request->except('_token');
       
        $file = time().'Image'.rand('1000','9999').'.'.$request->imagename->extension();
        $imgdata = $request->imagename->move(public_path('images'),$file);
        $input['imagename'] = $file;
        Productimages::create([
                'product_id' => $prodid,
                'imagename'  => $file
        ]);
       Session::flash('success', 'Image is uploded Successfully');
       return back();
    }

    public function ImagesDestroy(Request $request , $id)
    {
        $image = Productimages::findOrFail($id);
        //dd($image); 
        if (Storage::exists('/public/images'.$image->imagename)) {
           Storage::delete('/public/images'.$image->imagename);
        }
        
        $image->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Image is Deleted Successfully', 'status' => true]);
        }
        Session::flash('success', 'Image is Deleted Successfully');
        return back();
    }

    public function color($id)
    {
        $data['colors'] = Color::where(['product_id'=>$id])->get();
        $data['product'] = Product::where('id',$id)->first();
        
        return view('admin.products.color',$data);
    }

    public function colorstore(Request $request,$id)
    {
        $data['product'] = Product::where('id',$id)->first();
        Color::create([
                'color' => $request->color,
                'status'=> $request->status,
                'product_id' => $id
        ]);
        Session::flash('success', 'Color is Added Successfully');
        return back()->with($data);
    }

    public function colordelete(Request $request,$id)
    {
        $image = Color::findOrFail($id);
        $image->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Color is Deleted Successfully', 'status' => true]);
        }
        Session::flash('success', 'Color is Deleted Successfully');
        return back();
    }

    public function size($id)
    {
        $data['sizes'] = Size::where('product_id',$id)->get();
        $data['product'] = Product::where('id',$id)->first(); 
        return view('admin.products.size',$data);

    }

    public function sizestore(Request $request,$id)
    {
        $data['product'] = Product::where('id',$id)->first();
        Size::create([
                'size' => $request->size,
                'status'=> $request->status,
                'product_id' => $id
        ]);
        Session::flash('success', 'Size is Added Successfully');
        return back()->with($data);
    }

    public function sizedelete(Request $request,$id)
    {
        $image = Size::findOrFail($id);
        $image->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Size is Deleted Successfully', 'status' => true]);
        }
        Session::flash('success', 'Size is Deleted Successfully');
        return back();
    }
}