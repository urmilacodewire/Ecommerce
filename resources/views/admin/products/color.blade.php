
@extends('admin.template.layout')

@section('title', 'Product Color')
@section('description', 'colors')

{{-- page content --}}
@section('content')
<div class="container-fluid">
    @isset($product)
    @include('admin.products.nav')
    @endisset 
    <div class="card card-custom card-custom gutter-t" id="estimator">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">Product Color</h3>
            </div>
        </div>
        <div class="card-body">
            @if (isset($product))
                {{ Form::open(['route' => ['products.colorstore', $product->id], 'method' => 'post','files' => true]) }}
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('color', 'Color') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('color', null, ['class' => 'form-control']) }}</div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('status', 'Status') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('status',[''=>'Select','1'=>'Active','0'=>'Inactive'],null, ['class' => 'form-control']) }}
                    </div>
                </div>  
            </div>
            <button type="submit" class="btn btn-light-primary">Submit</button>
            </form>
            </div>
             </div>
            
            <div class="card card-custom card-custom gutter-t" id="estimator">
             <div class="card-body">
            @if(isset($colors))
            <table class="table table-separate table-head-custom table-checkable" id="dt">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Color</th>  
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tablecontents">
                    @foreach ($colors as $color)
                        <tr class="row1" data-id="{{ $color->id }}">
                            <td>{{ $loop->iteration }} </td>
                            <td>
                                {{ $color->color }}
                            </td>
                           <!--  <td>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" class="my_checkbox" @if ($color->status) checked @endif data-id="{{ $color->id }}">
                                     <span></span>
                                    </label>
                                </span>
                            </td> -->
                            <td>
                                <form style="display: inline-block" action="{{ route('products.colordelete',  $color->id) }}" method="post">
                                    @csrf
                                    
                                    <button type="submit" class="delete btn btn-danger btn-sm mr-3"
                                        onclick="return confirm('Are You Sure')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             @endif
        </div>
    </div>
   
</div>
@endsection


@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

<script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js?v=7.2.5') }}"></script>
<script src="{{ url('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.2.5') }}"></script>
<script>
    $(document).ready(function() {
        $('#dt').DataTable()
    })
</script>
<script>
    c = $('.my_checkbox').on('change',function(e) {
            id = $(e.target).data('id')
           // alert(id);
            $.ajax({
                method: 'post',
                url: `{{route('products.status')}}`,
                data: {
                    '_token' : '{{csrf_token()}}',
                    'id' : id,
                    'status': e.target.checked?1:0
                },
                dataType: 'json',
                success: function(data){
                    toastr.success(data.message);
                }
            });
        }
    )
    </script>
@endsection
