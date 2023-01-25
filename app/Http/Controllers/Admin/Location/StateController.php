<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
    use App\Models\Location\State;
    use Illuminate\Support\Facades\Session;
    use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    public function index()
    {
        $data['active'] = 'location';
        $data['states'] = State::all();
        return view('admin.location.state.index',$data);
    }

    public function create()
    {
        $data['active'] = 'location';
        $data['title'] = 'Add State';
        return view('admin.location.state.add-edit',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        State::create($request->all());
        Session::flash("success","state Created Successfully");
        return redirect()->route('state.index');
    }

    public function show($state)
    {
    }

    public function edit($state)
    {
        $state = State::find($state);
        $data['active'] = 'location';
        $data['state'] = $state;
        $data['title'] = 'Edit State';
        return view('admin.location.state.add-edit',$data);
    }

    public function update(Request $request, $state)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        $state = State::find($state);
        $state->update($request->all());
        Session::flash("success","state Updated Successfully");
        return redirect()->route('state.index');
    }

    public function destroy($State)
    {
        $State = State::findOrFail($State);
        $State->delete();

        Session::flash('success','State Delete Successfully');
        return back();
    }

    public function getDatatable()
    {
        $data = State::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '';
                $actionBtn .= '<a href="'. route('state.edit',$row->id) .'" class="delete btn btn-success btn-sm mr-3">Edit</a>';
                $actionBtn .= '<a href="'. route('state.show',$row->id) .'" class="delete btn btn-success btn-sm">View</a>';
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

        $State = State::findOrFail($request->id);
        $State->status = $request->status;
        $State->save();

        return response()->json(['message' => 'Status Changed Successfully','status' => true]);
    }
}
