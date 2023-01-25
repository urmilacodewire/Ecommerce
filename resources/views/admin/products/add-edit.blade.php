
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
            @if (isset($products))
                {{ Form::model($products, ['route' => ['products.update', $products->id], 'method' => 'put','files' => true]) }}
            
            @else
                {{ Form::open(['route' => 'products.store', 'method' => 'post','files' => true]) }}
            @endif
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('vendor', 'Choose Vendor') }}
                        <span class="text-danger">*</span>
                         {{ Form::select('vendor_id',$vendor, null, ['class' => 'form-control','placeholder' => 'Select']) }}
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('Category', 'Choose Category') }}
                        <span class="text-danger">*</span>
                         {{ Form::select('category_id',$categories, null, ['class' => 'form-control','placeholder' => 'Select']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('brand', 'Brand') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('brand',$brand, null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('model', 'Model') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('model', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('color', 'Color') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('color',$color,null,['class'=>'form-control ']) }}
                    </div>
                </div>

                   
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('size', 'Size') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('size',$size, null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('warranty', 'Warranty') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('warranty', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mrp', 'MRP') }}
                        <span class="text-danger">*</span>
                        {{ Form::number('mrp', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('price', 'Price') }}
                        <span class="text-danger">*</span>
                        {{ Form::number('price', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('quantity', 'Quantity') }}
                        <span class="text-danger">*</span>
                        {{ Form::number('quantity', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">  
                    <div class="form-group">
                        {{ Form::label('image', 'Image') }}
                        <span class="text-danger">*</span>
                        {{ Form::file('image',['class' => 'form-control']) }}
                    </div>
                    @isset($post)
                    <img src="{{$post->image}}" width="100px">
                    @endisset
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('title', 'SEO Title') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('meta_title', null, ['class' => 'form-control','maxlength'=>60]) }}
                    </div>
                </div>
                <div class="col-md-6">  
                    <div class="form-group">
                        {{ Form::label('metakeywords', 'SEO Keywords') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('meta_keyword',null,['class' => 'form-control','maxlength'=>100]) }}
                    </div>
                </div>
               
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('metadesc', 'SEO Description') }}
                        <span class="text-danger">*</span>
                        {{ Form::textarea('meta_desc', null, ['class' => 'form-control','rows'=>'1','maxlength'=>160]) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('popular', 'Popular') }}
                        {{ Form::select('popular',['0'=>'Not Popular','1'=>'Popular'],[],['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('description', 'Description') }}
                        <span class="text-danger">*</span>
                        {{ Form::textarea('description', null, ['class' => 'form-control','rows'=>2]) }}
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">    
                        {{ Form::hidden('type','', null, ['class' => 'form-control']) }}
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
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')

<script src="{{url('assets/js/pages/crud/forms/widgets/select2.js?v=7.2.8')}}"></script>
<script>
    $(document).ready(function() {
        $('.basic-multiple').select2();
    });
</script>

<script>
CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('products.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
})
</script>


@endsection
