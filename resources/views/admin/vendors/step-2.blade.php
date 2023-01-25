
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
            {{ Form::model($vendor, ['route' => ['vendors.step2', $vendor->id], 'files' => true]) }}
            <div class="row">
                <div class="col-md-12 p-2">
                    <h5>{{$title}}</h5>
                    <hr>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('industry', 'Industry') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('industry',$industry,null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('company_name', 'Company Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('company_name', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('company_type', 'Company Type') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('company_type',['individual' => 'Individual','firm' => 'Firm'],null, ['class' => 'form-control','v-model' => 'type','placeholder' => 'Select']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('authorized_person_name', 'Authorized Person Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('authorized_person_name', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('authorized_person_phone', 'Authorized Person Phone') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('authorized_person_phone', null, ['class' => 'form-control']) }}
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('headquarters', 'Headquarters') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('headquarters', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Company Size</label>
                        <span class="text-danger">*</span>
                        {{ Form::number('company_size', null, ['class' => 'form-control','placeholder'=>'Enter Company Size']) }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Website</label>
                        <span class="text-danger">*</span>
                        {{ Form::text('website', null, ['class' => 'form-control','placeholder'=>'Enter Website']) }}
                    </div>
                </div>

                 <div class="col-md-4">
                    <div class="form-group">
                        <label>Specialties</label>
                        <span class="text-danger">*</span>
                        {{ Form::text('specialties', null, ['class' => 'form-control','placeholder'=>'Enter specialties']) }}
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <label>About us</label>
                        <span class="text-danger">*</span>
                        {{ Form::textarea('aboutus', null, ['class' => 'form-control']) }}
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('vendors.edit',$vendor->id)}}" class="btn btn-warning">Previous</a>
            <a href="{{route('vendors.contract.index',$vendor->id)}}" class="btn btn-primary">Next</a>
            </form>
        </div>
    </div>
</div>
@endsection


@section('style')
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script>
var app = new Vue({
    el: "#app",
    data: {
        type:'@isset($vendor){{$vendor->company_type}}@endisset',
    },
    computed: {
        pan_label: function(){
            if(this.type == 'individual') return "Pancard"
            if(this.type == 'firm') return "Company Pancard"
            return "Pancard"
        },
    }
});
</script>
@endsection
