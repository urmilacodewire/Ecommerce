@extends('admin.template.layout')

@section('title', 'District List')
@section('description', 'District')

@section('style')
<link href="{{ url('assets/plugins/custom/datatables/datatables.bundle.css?v=7.2.5') }}" rel="stylesheet"type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="card card-custom card-custom gutter-t">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">District List</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('district.create') }}" class="btn btn-success btn-sm">Add District</a>
            </div>
        </div>
        <div class="card-body">
             <table class="table table-separate table-head-custom table-checkable" id="district_table">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>District</th>
                            <th>State</th>
                            <th>STatus</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($districts as $district)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$district->name}}</td>
                            <td>{{$district->state->name ?? ''}}</td>
                            <td>
                                <label class="switch s-icons s-outline s-outline-primary mr-2">
                                    <input type="checkbox" class="my_checkbox" @if($district->status) checked @endif data-id="{{$district->id}}">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('district.edit',$district->id) }}" class="delete btn btn-success btn-sm mr-3">Edit</a>
                                <form style="display: inline-block" action="{{ route('district.destroy',$district->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="delete btn btn-danger btn-sm mr-3" onclick="return confirm('Are You Sure')">Delete</button>
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
            $.ajax({
                method: 'POST',
                url: `{{route('district.status')}}`,
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
            type: "POST", 
            dataType: "json", 
            url: "{{ route('category.sortable') }}",
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
