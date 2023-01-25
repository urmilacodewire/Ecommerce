@extends('admin.template.layout')

@section('title', 'Coupon List')
@section('description', 'Coupon')

@section('style')
<link href="{{ url('assets/plugins/custom/datatables/datatables.bundle.css?v=7.2.5') }}" rel="stylesheet"type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="card card-custom card-custom gutter-t">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">Coupon List</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('coupons.create') }}" class="btn btn-success btn-sm">Add Coupon</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="dt">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Title</th>
                        <th>Code</th>
                         <th>Value</th>
                         <th>Type</th>
                         <th>Min Amount</th>
                         <th>Is One Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tablecontents">
                    @foreach ($coupons as $coupon)
                        <tr class="row1" data-id="{{ $coupon->id }}">
                            <td>{{ $loop->iteration }} </td>
                            <td>{{ $coupon->title }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->value }}</td>
                            <td>{{ $coupon->type }}</td>
                            <td>{{ $coupon->min_ord_amt }}</td>
                            <td>
                            	@if($coupon->is_one_time ==0)
                            		No
                            	@else
                            		Yes
                            	@endif
                            </td>
                            <td>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" class="my_checkbox" @if ($coupon->status) checked @endif data-id="{{ $coupon->id }}">
                                     <span></span>
                                    </label>
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('coupons.edit', $coupon->id) }}" class="delete btn btn-primary btn-sm">Edit</a>
                                <form style="display: inline-block" action="{{ route('coupons.destroy', $coupon->id) }}" method="post">
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
                url: `{{route('coupons.status')}}`,
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
