
@extends('admin.template.layout')

@section('title', $title)
@section('description', 'Products')

{{-- page content --}}
@section('content')
<div class="container-fluid">
	@isset($vendor)
    @include('admin.vendors.nav')
    @endisset
    <div class="card card-custom card-custom gutter-t" id="estimator">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">{{ $title }}</h3>
            </div>
        </div>
        <div class="card-body">
             @if (isset($vendor))
                {{ Form::model($vendor, ['route' => ['vendors.update', $vendor->id], 'method' => 'put']) }}
            @else
                {{ Form::open(['route' => 'vendors.store', 'method' => 'post']) }}
            @endif
            <div class="row">
                <div class="col-md-12 p-2">
                    <h5>{{$title}}</h5>
                    <hr>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('email', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('phone', 'Phone') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('phone', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('alternate_phone', 'Alternate Phone') }}
                        {{ Form::text('alternate_phone', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                 <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('landline_no', 'Landline Phone') }}
                        {{ Form::text('landline_no', null, ['class' => 'form-control']) }}
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('address', 'Address') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('address', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('state', 'State') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('state',$state, null, ['class' => 'form-control','id'=>'state']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('city', 'City') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('city',$city, null, ['class' => 'form-control','id'=>'city']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('pincode', 'Pincode') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('pincode', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('status', 'Status') }}
                        @if(!isset($vendor))<span class="text-danger">*</span>@endif
                        {{ Form::select('status',[''=>'Select','1'=>'Active','0'=>'Inactive'],null, ['class' => 'form-control',isset($vendor)?'':'required']) }}
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-light-primary">Submit</button>
                @if (isset($vendor))
                <a href="{{route('vendors.step2',$vendor->id)}}" class="btn btn-primary">Next</a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection


@section('style')
@endsection

@section('script')

<script>
CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('products.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
})
</script>
@endsection
