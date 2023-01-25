@extends('admin.template.layout')

@section('title', 'Category List')
@section('description', 'Category')

@section('style')
<link href="{{ url('assets/plugins/custom/datatables/datatables.bundle.css?v=7.2.5') }}" rel="stylesheet"type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="card card-custom card-custom gutter-t">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">Category List</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('category.create') }}" class="btn btn-success btn-sm">Add Category</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="dt">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tablecontents">
                    @foreach ($categories as $category)
                        <tr class="row1" data-id="{{ $category->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" class="my_checkbox" @if ($category->status) checked @endif data-id="{{ $category->id }}">
                                     <span></span>
                                    </label>
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="delete btn btn-primary btn-sm">Edit</a>
                                <form style="display: inline-block" action="{{ route('category.destroy', $category->id) }}" method="POST">
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
            $.ajax({
                method: 'POST',
                url: `{{route('category.status')}}`,
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
        $( "#tablecontents" ).sortable({
            stop:function(){
                var allkey = new Array();
                $('tr.row1').each(function() {
                    allkey.push($(this).attr('data-id'));
                });
                sendOrderToServer(allkey);
            }
        });
        function sendOrderToServer(keys) {
          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ route('category.sortable') }}",
                data: {
                order: keys,
              _token: '{{csrf_token()}}'
            },
            success: function(response) {
                 toastr.success(response.message);
                 toastr.success(response.id);
            }
          });
        }
      });
</script>

@endsection
