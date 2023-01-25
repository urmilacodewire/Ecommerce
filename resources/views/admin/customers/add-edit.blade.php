
@extends('admin.template.layout')

@section('title', 'Edit Cudstomer Details')
@section('description', 'Edit Cudstomer Details')

{{-- page content --}}
@section('content')
<div class="container-fluid">
	@isset($customer)
    @include('admin.customers.nav')
    @endisset 
    <div class="card card-custom card-custom gutter-t" id="estimator">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">Edit Cudstomer Details</h3>
            </div>
        </div>
        <div class="card-body">
            @if (isset($customer))
                {{ Form::model($customer, ['route' => ['customers.update', $customer->id], 'method' => 'put','files' => true]) }}
            
            @else
                {{ Form::open(['route' => 'customer.store', 'method' => 'post','files' => true]) }}
            @endif
            <div class="row">

                
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('fname', 'First Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('fname', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('lname', 'Last Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('lname', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        <span class="text-danger">*</span>
                        {{ Form::email('email', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mobile', 'Mobile') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('mobile', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                
                <div class="col-md-12">  
                    <div class="form-group">
                        {{ Form::label('image', 'Image') }}
                        <span class="text-danger">*</span>
                        {{ Form::file('image',['class' => 'form-control']) }}
                    </div>
                    @isset($post)
                    <img src="{{$post->image}}" width="100px">
                    @endisset
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('address', 'Address') }}
                        <span class="text-danger">*</span>
                        {{ Form::textarea('address', null, ['class' => 'form-control','rows'=>2]) }}
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

</script>


@endsection
