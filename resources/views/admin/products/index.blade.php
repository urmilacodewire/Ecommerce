@extends('admin.template.layout')

@section('title', 'Products List')
@section('description', 'Products')

@section('style')
<link href="{{ url('assets/plugins/custom/datatables/datatables.bundle.css?v=7.2.5') }}" rel="stylesheet"type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="card card-custom card-custom gutter-t">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">Products List</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">Add Product</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="dt">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Name</th>
                        <th>Category</th>
                         <th>Price</th>
                         <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tablecontents">
                    @foreach ($products as $product)
                        <tr class="row1" data-id="{{ $product->id }}">
                            <td>{{ $loop->iteration }} </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->catname }}</td>
                            <td>{{ $product->price }}</td>
                            <td><img src="{{URL::to(Config::get('app.base_url').'/images/'.$product->image ?? null)}}" class="card-img-top img-responsive" alt="" width="50px" height="50px" /></td>
                            <td>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" class="my_checkbox" @if ($product->status) checked @endif data-id="{{ $product->id }}">
                                     <span></span>
                                    </label>
                                </span>
                            </td>
                            <td>
                              <a href="{{ route('products.show', $product->id) }}" class="delete btn btn-warning btn-sm">Upload Images</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="delete btn btn-primary btn-sm">Edit</a>
                                <form style="display: inline-block" action="{{ route('products.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="delete btn btn-danger btn-sm mr-3"
                                        onclick="return confirm('Are You Sure')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

     ///// Reordering

      $(function () {
        $("#table").DataTable();

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = '{{csrf_token()}}';

          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });


          $.ajax({
            type: "product", 
            dataType: "json", 
            url: "{{ route('products.sortable') }}",
                data: {
              order: order,
              _token: token
            },
            success: function(response) {
                 toastr.success(response.message);
            }
          });
        }
      });
</script>
@endsection
