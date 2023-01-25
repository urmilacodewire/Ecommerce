
@extends('admin.template.layout')

@section('title', 'Product Images')
@section('description', 'Images')

{{-- page content --}}
@section('content')

    
<div class="container-fluid">
    @isset($product)
    @include('admin.products.nav')
    @endisset 
    <div class="card card-custom card-custom gutter-t" id="estimator">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">Product Images</h3>
            </div>
        </div>
        <div class="card-body">
            @if (isset($product))
                {{ Form::open(['route' => ['products.images', $product->id], 'method' => 'post','files' => true]) }}
            @endif
            <div class="row">
                <div class="col-md-12">  
                    <div class="form-group">
                        {{ Form::label('image', 'Image') }}
                        <span class="text-danger">*</span>
                        {{ Form::file('imagename',['class' => 'form-control']) }}
                    </div>
                    @isset($post)
                    <img src="{{$post->image}}" width="100px">
                    @endisset
                </div>
               
            </div>
            <button type="submit" class="btn btn-light-primary">Submit</button>
            </form>
            </div>
             </div>
            
            <div class="card card-custom card-custom gutter-t" id="estimator">
             <div class="card-body">
            @if(isset($images))
            <table class="table table-separate table-head-custom table-checkable" id="dt">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Image</th>  
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tablecontents">
                    @foreach ($images as $image)
                        <tr class="row1" data-id="{{ $image->id }}">
                            <td>{{ $loop->iteration }} </td>
                            <td><img src="{{URL::to(Config::get('app.base_url').'/images/'.$image->imagename)}}" class="card-img-top img-responsive" alt="" width="50px" height="50px" />
                            </td>
                           <!--  <td>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" class="my_checkbox" @if ($image->status) checked @endif data-id="{{ $image->id }}">
                                     <span></span>
                                    </label>
                                </span>
                            </td> -->
                            <td>
                                <form style="display: inline-block" action="{{ route('images.destroy',  $image->id) }}" method="post">
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
