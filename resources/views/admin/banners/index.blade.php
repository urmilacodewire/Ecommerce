@extends('admin.template.layout')

@section('title', 'Banners List')
@section('description', 'Banners List')

@section('style')
<link href="{{ url('assets/plugins/custom/datatables/datatables.bundle.css?v=7.2.5') }}" rel="stylesheet"type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="card card-custom card-custom gutter-t">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">Banners List</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('banner.create') }}" class="btn btn-success btn-sm">Add Banner</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="dt">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Title</th>
                        <!-- <th>Description</th> -->
                        <th>Banner</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banners)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $banners->title }}</td>
                            <td><img src="{{URL::to(Config::get('app.base_url').'/images/'.$banners->bannerfile)}}" width="50px"></td>
                            <td>
                                <a href="{{ route('banner.edit', $banners->id) }}" class="delete btn btn-primary btn-sm">Edit</a>
                                <form style="display: inline-block" action="{{ route('banner.destroy', $banners->id) }}" method="POST">
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
<script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js?v=7.2.5') }}"></script>
<script src="{{ url('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.2.5') }}"></script>
<script>
    $(document).ready(function() {
        $('#dt').DataTable()
    })
</script>
<script>
   
</script>

@endsection
