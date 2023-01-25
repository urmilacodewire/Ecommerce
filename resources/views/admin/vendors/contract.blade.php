
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
            {{ Form::model($vendor, ['route' => ['vendors.contract', $vendor->id], 'method' => 'post']) }}
            <div class="row">
                <div class="col-md-12 p-2">
                    <h5>{{$title}}</h5>
                    <hr>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('payment_type', 'Choose Contract Type') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('payment_type',$payment_type,null, ['class' => 'form-control']) }}
                    </div>
                </div>
                
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('payment_value', 'Contract Value') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('payment_value', null, ['class' => 'form-control']) }}
                    </div>
                </div> -->

            </div>

            <button type="submit" class="btn btn-light-primary">Submit</button>
            <a href="{{route('vendors.step2',$vendor->id)}}" class="btn btn-warning">Previous</a>
            <a href="{{route('vendors.location.index',$vendor->id)}}" class="btn btn-primary">Next</a>
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
