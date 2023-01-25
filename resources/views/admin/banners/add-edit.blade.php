
@extends('admin.template.layout')

@section('title', $title)
@section('description', 'Banners')

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
            @if (isset($banners))
                {{ Form::model($banners, ['route' => ['banner.update', $banners->id], 'method' => 'put','files' => true]) }}
            @else
                {{ Form::open(['route' => 'banner.store', 'method' => 'post','files' => true]) }}
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('title', 'Title') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('title', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('image', 'Image') }}
                        <span class="text-danger">*</span>
                        {{ Form::file('bannerfile',['class' => 'form-control']) }}
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('position', 'Position') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('position',[''=>'Select','Header'=>'Header','Right Side'=>'Right Side','Bottom'=>'Bottom','Left Side'=>'Left Side'],null,['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('link', 'Link') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('link',null,['class' => 'form-control']) }}
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

</script>
@endsection
