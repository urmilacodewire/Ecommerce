
@extends('admin.template.layout')

@section('title', $title)
@section('description', 'Products')

{{-- page content --}}
@section('content')
<div class="container-fluid">
	@isset($vendor)
    @include('admin.vendor.nav')
    @endisset
    <div class="card card-custom card-custom gutter-t" id="estimator">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">{{ $title }}</h3>
            </div>
        </div>
        <div class="card-body">
            {{ Form::model($vendor, ['route' => ['vendor.step3', $vendor->id], 'files' => true]) }}
            <div class="row">
                <div class="col-md-12 p-2">
                    <h5>{{ $title }}</h5>
                    <hr>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('account_holder_name', 'Account Holder Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('account_holder_name', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('bank_name', 'Bank Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('bank_name', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('account_number', 'Account Number') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('account_number', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('ifsc_code', 'IFSC Code') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('ifsc_code', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('passbook_photo', 'Passbook Photo') }}
                        <span class="text-danger">*</span>
                        {{ Form::file('passbook_photo', ['class' => 'form-control']) }}

                        @if($vendor->gst_certificate)
                        <img width="100px" src="{{ $vendor->gst_certificate }}">
                        @endif
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
