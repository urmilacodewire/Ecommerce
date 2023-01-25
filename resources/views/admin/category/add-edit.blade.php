
@extends('admin.template.layout')

@section('title', $title)
@section('description', 'Category')
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
            @if (isset($category))
                {{ Form::model($category, ['route' => ['category.update', $category->id], 'method' => 'put','files' => true]) }}
            @else
                {{ Form::open(['route' => 'category.store', 'method' => 'post','files' => true]) }}
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control']) }}</div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('status', 'Status') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('status',[''=>'Select','1'=>'Active','0'=>'Inactive'],null, ['class' => 'form-control']) }}
                    </div>
                    @isset($category)
                    <img src="{{$category->image}}" width="100px">
                    @endisset
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
@endsection
