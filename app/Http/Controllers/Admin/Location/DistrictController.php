<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location\District;
use App\Models\Location\State;
use App\Models\Location\Zone;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    public function index()
    {
        $data['active'] = 'location';
        $data['districts'] = District::with('state')->get();
        return view('admin.location.district.index',$data);
    }

    public function create()
    {
        $data['active'] = 'location';
        $data['title'] = 'Add District';
        $data['states'] = State::pluck('name','id');
        return view('admin.location.district.add-edit',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
            'name' => 'required',
        ]);

        District::create($request->all());
        Session::flash("success","district Created Successfully");
        return redirect()->route('district.index');
    }

    public function show($district)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\district\district  $district
     * @return \Illuminate\Http\Response
     */
    public function edit($district)
    {
        $district = District::find($district);
        $data['active'] = 'location';
        $data['district'] = $district;
        $data['title'] = 'Edit district';
        $data['states'] = State::pluck('name','id');
        return view('admin.location.district.add-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\district\district  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $district)
    {
        $request->validate([
            'state_id' => 'required',
            'name' => 'required',
            // 'zone_id' => 'required'
            // 'status' => 'required'
        ]);
        $district = District::find($district);
        $district->update($request->all());
        Session::flash("success","district Updated Successfully");
        return redirect()->route('district.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\district\district  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($district)
    {
        $district = District::findOrFail($district);
        $district->delete();

        Session::flash('success','district Delete Successfully');
        return back();
    }

    public function getDatatable()
    {
        $data = District::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '';
                $actionBtn .= '<a href="'. route('district.edit',$row->id) .'" class="delete btn btn-success btn-sm mr-3">Edit</a>';
                $actionBtn .= '<a href="'. route('district.show',$row->id) .'" class="delete btn btn-success btn-sm">View</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $district = District::findOrFail($request->id);
        $district->status = $request->status;
        $district->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }
}
