<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location\District;
use App\Models\Location\City;
use App\Models\Location\State;
use Illuminate\Support\Facades\Session;
use DataTables;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $data['active'] = 'location';
         ////////////
            if ($request->ajax()) {
                 $data = City::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                       $actionBtn = '';
                        $actionBtn .= '<a href="'. route('city.edit',$row->id) .'" class=" btn btn-info btn-sm mr-3">Edit</a>';
                        $actionBtn .= '<a href="'. route('city.show',$row->id) .'" class=" btn btn-success btn-sm">View</a>';
                        $actionBtn .= '<a href="'. route('city.destroy',$row->id) .'" class=" btn btn-danger btn-sm">Delete</a>';
                         return $actionBtn;  
                    })
                    ->addColumn('status', function ($row){
                        
                      $status = '<span class="switch"><input type="checkbox" class="my_checkbox "'. ($row->status ? 'checked':'').' data-id="'.$row->id.'"/></span>';
                      return $status;

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.location.city.index',$data);
   }

    public function create()
    {
        $data['active'] = 'location';
        $data['title'] = 'Add City';
        $data['states'] = State::pluck('name','id');
        $data['districts'] = District::pluck('name','id');
        return view('admin.location.city.add-edit',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'state_id' => 'required',
            'districtid' => 'required',
            'status' => 'required'
        ]);

        City::create($request->all());
        Session::flash("success","City Created Successfully");
        return redirect()->route('city.index');
    }

    public function show($city)
    {
    }

    public function edit($city)
    {
        $city = City::find($city);
        $data['active'] = 'location';
        $data['city'] = $city;
        $data['title'] = 'Edit City';
        $data['states'] = State::pluck('name','id');
        $data['districts'] = District::where('state_id',$city->state_id)->pluck('name','id');
        return view('admin.location.city.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\city\city  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $city)
    {
        $request->validate([
            'name' => 'required',
            'state_id' => 'required',
            'districtid' => 'required',
            'status' => 'required'
        ]);
        $city = City::find($city);
        $city->update($request->all());
        Session::flash("success","City Updated Successfully");
        return redirect()->route('city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\city\city  $city
     * @return \Illuminate\Http\Response
     */

 
    public function getDatatable()
    {
        $data = City::with(['state','district']);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '';
                $actionBtn .= '<a href="'. route('city.edit',$row->id) .'" class="delete btn btn-success btn-sm mr-3">Edit</a>';
                $actionBtn .= '<a href="'. route('city.show',$row->id) .'" class="delete btn btn-success btn-sm">View</a>';
                $actionBtn .= '<a href="'. route('city.delete',$row->id) .'" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->editColumn('status',function ($row){
                return '<label class="switch s-icons s-outline s-outline-primary mr-2">
                    <input type="checkbox" class="my_checkbox" '.($row->status?'checked':'').' data-id="'.$row->id.'">
                    <span class="slider round"></span>
                </label>';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $City = City::findOrFail($request->id);
        $City->status = $request->status;
        $City->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }

    public function destroy(Request $request,$id){

        $city = City::findOrFail($id);
        $city->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'City Delete Successfully','status' => true]);
        }
        Session::flash('success','City Delete Successfully');
        return back();
    }
}
