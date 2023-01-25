@extends('admin.template.layout')

@section('title', 'Customer orders')
@section('description', 'Customers')

@section('content')
@inject('carbon', 'Carbon\Carbon')

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
                    <div class="card-title d-flex">
                        <h3 class="card-label">Customer Details</h3>
                    </div>
                     <div class="card-title d-flex">
                         <a class="btn bg-primary text-white float-end" href="{{URL::to('admin/orders')}}">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table ">
                          <thead>
                            </thead>
                          <tbody>
                            <tr>
                              <th >Delivery Address</th>
                              <td><b>:</b></td>
                              <td colspan="3">{{$item->delivery_addr }}</td>
                              <td></td><td></td><td></td>
                            </tr>
                          
                            <tr>
                              <th >City</th>
                              <td><b>:</b></td>
                              <td colspan="3">{{$item->city }}</td>
                              <td></td><td></td><td></td>
                            </tr>
                            <tr>
                              <th >State</th>
                              <td><b>:</b></td>
                              <td colspan="3">{{$item->state }}</td>
                              <td></td><td></td><td></td>
                            </tr>
                            <tr>
                              <th >Pincode</th>
                              <td><b>:</b></td>
                              <td colspan="3">{{$item->pincode }}</td>
                              <td></td><td></td><td></td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
                {{ Form::model($item,['route' => ['orders.update',$item->order_id], 'method' => 'put','files' => true]) }}
               <div class="row mt-4 ">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label class="ml-4"><strong>Order Status</strong></label>
                            {{ Form::select('order_status',['Pending'=>'Pending','Completed'=>'Completed','Cancelled'=>'Cancelled','Processing'=>'Processing'],null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group float-right">
                        <button type="submit" class="btn btn-primary ">Update Status</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection