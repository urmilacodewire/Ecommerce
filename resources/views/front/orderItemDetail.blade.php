@extends('layouts.app1') 
@section('meta-title', 'E-Commerce')
@section('meta-description', '')

@section('content')
@inject('carbon', 'Carbon\Carbon')

 <a class="btn btn-lg bg-primary mb-3 ml-3 text-white" href="{{URL::to('user-orders',Auth::user()->id)}}">Back</a>

<div class="container">
    <div class="row">

        <div class="col-md-6">
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
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="tablecontents">
                            @foreach ($orderItem as $item)
                            <tr class="row1" data-id="{{ $item->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <img src="{{URL::to(Config::get('app.base_url').'/images/'.$item->image ?? null)}}" class="" alt="" width="40px" height="10%" />
                                </td>
                                <td>
                                    <span class=" bg-secondary p-2">{{ $item->product_qunty }}</span>
                                </td>
                                <td>{{ $item->price}}</td>
                                <td>{{$item->product_qunty* $item->price }}</td>
                            </tr>
                            @endforeach
                            @php 
                                $total = DB::table('orders')->where(['order_id'=>$item->order_id,'user_id'=>Auth::user()->id])->sum(DB::raw('orders.total_amt'));
                                //$t_price = $total[0]->total_price->sum();
                                
                            @endphp
                            <tr>
                                <th colspan="5" class="">Grand Total</th>
                                <th class="float-end">
                                    {{$total }}
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="col-md-6">
            <div class="card card-custom card-custom gutter-t">
                <div class="card-header py-3">
                    <div class="card-title">
                        <h3 class="card-label">Details</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <span class="mr-4" ><b>Delivery Address</b></span><br>
                            <span class="mr-4" ><b>City</b></span><br>
                            <span class="mr-4" ><b>State</b></span><br>
                            <span class="mr-4" ><b>Pincode</b></span>
                        </div>
                        <div class="col-md-2">
                            <span>:</span><br>
                            <span>:</span><br>
                            <span>:</span><br>
                            <span>:</span>
                        </div>
                        <div class="col-md-5">
                            <span>{{$item->delivery_addr }}</span><br>
                            <span>{{$item->city}}</span><br>
                            <span>{{$item->state}}</span><br>
                            <span>{{$item->pincode}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection