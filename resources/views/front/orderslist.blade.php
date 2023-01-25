@extends('layouts.app1') 
@section('meta-title', 'E-Commerce')
@section('meta-description', '')

@section('content')
@inject('carbon', 'Carbon\Carbon')

<div class="container">
    <div class="card card-custom card-custom gutter-t">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label">Orders List</h3>
            </div>
           
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="dt">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>ID</th>
                        <th>Amount</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tablecontents">
                	
                    @foreach ($orderslist as $item)
                        <tr class="row1" data-id="{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $item->total_amt}}</td>
                            <td>{{ $item->delivery_addr}}</td>
                            <td>{{ $item->o_date}}</td>
                            <td>{{ $item->o_time}}</td>
                            <td>
                            	<a type="submit" href="{{URL::to('order-details',$item->order_id)}}" class="btn btn-primary my-2 ">View</a>
                            </td>
                        </tr>
                     @endforeach
                </tbody>
            </table>

        <!-- </div>

    </div>

</div> -->

      </div>

   </div>
</div>

@endsection