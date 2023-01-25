<?php

namespace App\Http\Controllers\Admin\Vendors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location\City;
use App\Models\Location\District;
use App\Models\Location\State;
use Illuminate\Support\Facades\Session;
use App\Models\Vendor;
use App\Models\Vendorlocation;
use Illuminate\Support\Facades\DB;
use App\Models\Products\Product;
use App\Models\Productimages\Productimages;

class VendorController extends Controller
{
    public function index()
    {
        $data['city']  = City::pluck('name','name');
        $data['state'] = State::pluck('name','id');
        $data['active'] = 'vendor';
        $data['vendors'] = Vendor::all();
        return view('admin.vendors.index', $data);
    }

    public function show($vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $data['active'] = 'vendor';
        $data['vendor'] = $vendor;
        return view('admin.vendors.show');
    }

    public function create()
    {
        $data['city']  = City::pluck('name','name');
        $data['state'] = State::pluck('name','id');
        $data['active'] = 'vendor';
        $data['title'] = 'Create Vendor';
        return view('admin.vendors.add-edit', $data);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
        ]);

        $vendor2 = Vendor::where('email',$request->email)->first();
        if($vendor2) {
            Session::flash('error','Email Already Exists');
            return redirect()->back()->withData($request->all());
        }

        $data = $request->all();
        $data['status'] = 'active';
        $data['vendor_id'] = 'FT-'.rand('10000','99999');
        $vendor = Vendor::create($data);

        Session::flash('success', 'Vendor Add Successfuly');
        return redirect()->route('vendors.step2',['vendor' => $vendor]);
    }

    public function edit($vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $data['active'] = 'vendor';
         $data['city']  = City::pluck('name','name');
         $data['state'] = State::pluck('name','id');
        $data['vendor'] = $vendor;
        $data['title'] = 'Edit Vendor';
        return view('admin.vendors.add-edit', $data);
    }

    public function update(Request $request, $vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'status'  => 'required',
        ]);

        $vendor2 = Vendor::where('email',$request->email)->where('id','!=',$vendor->id)->first();
        if($vendor2) {
            Session::flash('error','Email Already Exists');
            return redirect()->back()->withData($request->all());
        }

        $vendor->update($request->all());
        Session::flash('success', 'Vendor Update Successfully');
        return redirect()->route('vendors.step2',['vendor' => $vendor]);
    }

    public function destroy(Request $request, $vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $vendor->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Vendor Delete Successfully', 'status' => true]);
        }
        Session::flash('success', 'Vendor Delete Successfully');
        return back();
    }


    public function step2Form($vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $data['vendor'] = $vendor;
        $data['active'] = 'hr_management';
        $data['title'] = 'KYC Detail';
        $data['industry'] = DB::table('assets')->where('type','Industry')
                                               ->pluck('name','name');

        return view('admin.vendors.step-2', $data);
    }

    public function step2Post(Request $request, $vendor)
    {

        $vendor = Vendor::findOrFail($vendor);
        $vendor->update($request->all());
        Session::flash('success', 'Vendor Update Successfully');
        return redirect()->route('vendors.contract.index',['vendor' => $vendor]);
    }

    public function step3Form($vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $data['vendor'] = $vendor;

        $data['active'] = 'hr_management';
        $data['title'] = 'KYC Detail';
        $data['choises'] = ['1' => 'Yes', '0' => 'No'];
        return view('admin.vendors.step-3', $data);
    }

    public function step3Post(Request $request, $vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        $request->validate([
            'account_number' => 'required',
            'ifsc_code' => 'required',
            'bank_name' => 'required',
            'passbook_photo' => 'required',
            'account_holder_name' => 'required'
        ]);

        $vendor->update($request->all());
        Session::flash('success', 'Vendor Update Successfully');
        return redirect()->route('vendors.step3', ['vendor' => $vendor]);
    }

    public function Contract($vendor){

        $data['title'] = 'Contract';
        $data['vendor'] = Vendor::findOrFail($vendor);
        $data['payment_type'] = ['Percentage'=>'Percentage','Fixed Amount' => 'Fixed Amount'];

        return view('admin.vendors.contract',$data);
    }

    public function ContractUpdate(request $request , $vendor){

        Vendor::where('id',$vendor)
              ->update([
                'payment_type' => $request->payment_type,
              ]);

        Session::flash('success','Successfully Update');
        return back();
    }

    public function location($vendor){

        $data['title'] = 'Location';
        $vendors = Vendorlocation::where('vendor_id',$vendor)->get();  
        $data['location'] = $vendors;
        $data['vendor'] = Vendor::findOrFail($vendor);
        return view('admin.vendors.location',$data);
    }

    public function productlist($vendor){

        $data['title'] = 'Products';
        $data['products'] = Product::where('vendor_id',$vendor)->get();  
        //dd($data);
        return view('admin.vendors.products',$data);
    }
}
