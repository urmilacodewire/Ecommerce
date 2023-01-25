@extends('layouts.app1') 
@section('meta-title', 'E-Commerce')
@section('meta-description', '')

@section('content')
@inject('carbon', 'Carbon\Carbon')

<div class="container">
    <div class="card card-custom card-custom gutter-t">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">Item List</h3>
            </div>
           
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="dt">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>In Stock</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tablecontents">

                    @foreach ($items as $item)
                        <tr class="row1" data-id="{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->prod_name }}</td>
                            <td>
                                <img src="{{URL::to(Config::get('app.base_url').'/images/'.$item->prod_image ?? null)}}" class="" alt="" width="40px" height="10%" />
                            </td>
                            <td>{{$item->product_qunty}}</td>
                            <td>
                                 <form enctype="multipart/form-data" action="{{URL::to('cart',$item->product_id)}}" method="get" class="mx-4">
                                    <input type="hidden" name="product_qunty" value="1">    
                            <input type="hidden" name="prod_name" value="{{$item->prod_name}}">
                            <input type="hidden" name="prod_image" value="{{$item->prod_image}}">
                            <input type="hidden" name="prod_price" value="{{$item->price}}">
                             <button class="btn btn-secondary text-white" type="submit">Add To Cart</button>
                          <!--
                           @if($msg = Session::get('success'))
                              <span class="bg-danger text-white p-2">{{$msg}} </span>
                           @endif -->
                    </form>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
      <!-- </div>
   </div>
</div> -->
<!-- </div> -->

@endsection