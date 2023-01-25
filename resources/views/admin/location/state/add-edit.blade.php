
@extends('admin.template.layout')

@section('title', $title)
@section('description', 'state')
{{-- page content --}}
@section('content')
<div class="container-fluid">
    <div class="card card-custom card-custom gutter-t" id="estimator">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">{{ $title }}</h3>
            </div>
        </div>
        <div class="card-body">
            @if (isset($state))
                {{ Form::model($state, ['route' => ['state.update', $state->id], 'method' => 'put','files' => true]) }}
            @else
                {{ Form::open(['route' => 'state.store', 'method' => 'post','files' => true]) }}
            @endif
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('name','Name')}}
                            <span class="text-danger">*</span>
                            {{Form::text('name',null,['class' => 'form-control',' placeholder' => 'State Name','required'])}}
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('code','RTO Code')}}
                            <span class="text-danger">*</span>
                            {{Form::text('code',null,['class' => 'form-control',' placeholder' => 'RTO Code','required'])}}
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('status','Status')}}
                            <span class="text-danger">*</span>
                            {{Form::select('status',[0 => 'Inactive',1=>'Active'],null,['class' => 'form-control','placeholder' => 'Select'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
        </div>
        {{Form::close()}}
        </div>
    </div>
</div>
@endsection


@section('style')
@endsection

@section('script')
@endsection
