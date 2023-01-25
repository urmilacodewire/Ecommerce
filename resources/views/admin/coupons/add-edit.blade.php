
@extends('admin.template.layout')

@section('title', $title)
@section('description', 'Products')

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
            @if (isset($coupons))
                {{ Form::model($coupons, ['route' => ['coupons.update', $coupons->id], 'method' => 'put','files' => true]) }}
            
            @else
                {{ Form::open(['route' => 'coupons.store', 'method' => 'post','files' => true]) }}
            @endif
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('title', 'TItle') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('title', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('code', 'Code') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('code', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('type', 'Type') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('type',['Value'=>'Value','Percent'=>'Percent'],null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('value', 'Value') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('value', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mimordAmt', 'Minimum Order Amount') }}
                        <span class="text-danger">*</span>
                        {{ Form::number('min_ord_amt', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('onetime', 'One Time') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('is_one_time',['0'=>'Permanent','1'=>'One Time'],null,	 ['class' => 'form-control']) }}
                    </div>
                </div>
                
                <div class="col-md-6">  
                    <div class="form-group">
                        {{ Form::label('status', 'Status') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('status',[''=>'Select','0'=>'Inactive','1'=>'Active'],null,['class' => 'form-control']) }}
                    </div>
                </div>
               
            </div>
            <button type="submit" class="btn btn-light-primary">Submit</button>
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
