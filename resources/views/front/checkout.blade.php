@extends('layouts.app1') 
@section('meta-title', 'E-Commerce')
@section('meta-description', '')

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
                            @foreach ($items as $item)
                                <tr class="row1" data-id="{{ $item->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->prod_name }}</td>
                                    <td>
                                        <img src="{{URL::to(Config::get('app.base_url').'/images/'.$item->prod_image ?? null)}}" class="" alt="" width="40px" height="10%" />
                                    </td>
                                    <td>{{ $item->product_qunty }}</td>
                                    <td>{{ $item->prod_price}}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <input type="hidden" name="" value="{{ $item->prod_name }}">
                                </tr>
                            @endforeach
                            @php 
                                $total = DB::table('carts')->where(['is_ordered'=>'no','user_slug'=>Auth::user()->slug])->sum(DB::raw('carts.total_price'));
                                //$t_price = $total[0]->total_price->sum();
                                
                            @endphp
                            <tr>
                                <th colspan="5" class="text-left">Total</th>
                                <th >
                                   Rs {{$total }}
                                </th>
                               
                             </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card card-custom card-custom gutter-t mt-3">
                <div class="card-header py-3">
                    <div class="card-title">
                        <h3 class="card-label">Billing</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="dt">
                        <thead>
                           
                        </thead>
                        <tbody id="tablecontents">
                            <tr>
                                <th>Subtotal</th>
                                <td> Rs {{$total }}</td>
                            </tr>
                            <tr>
                                <th>Shipping</th>
                                <td> Rs 50</td>
                            </tr>
                            <tr>
                                <th>GST</th>
                                <td> Rs {{5*$total/100 }}</td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td> Rs {{$gtotal = $total+50+5*$total/100}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2">
           <div class="card card-custom card-custom gutter-t">
                <div class="card-header py-3">
                    <div class="card-title">
                        <h3 class="card-label">Customer Details</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('order.store')}}" method="post" enctype="multipart/form-data">
                         @csrf
                         @foreach($items as $item)
                         <input type="hidden" name="product_ids[]" value="{{$item->product_id}}">
                         <input type="hidden" name="product_qunty[]" value="{{$item->product_qunty}}">
                         <input type="hidden" name="per_prod_price[]" value="{{$item->prod_price}}      ">
                         @endforeach
                         <input type="hidden" name="total_amt" value="{{$total}}">
                        <input type="hidden" name="user_slug" value="{{Auth::user()->slug}}">
                        <div class="row">
                        <div class="col-md-6">
                        <input type="text" name="name" value="{{Auth::user()->fname}} {{Auth::user()->lname}}" class="form-control my-2">
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="mobile" value="{{Auth::user()->mobile}}" class="form-control my-2">
                        </div>
                        <div class="col-md-12">
                            <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control my-2">
                        </div>
                        </div>
                        <hr>
                        <h5>Delivery Address</h5>
                        <textarea name="delivery_addr" placeholder="Address" class="form-control my-2" rows="2" required></textarea>
                        <div class="row">
                            <div class="col-md-6">
                        <input type="text" name="city" class="form-control  my-2" placeholder="City" required>
                         </div>
                        <div class="col-md-6">
                        <input type="text" name="state"  class="form-control my-2" placeholder="State"required>
                         </div>
                        <div class="col-md-6">
                        <input type="number" name="pincode" class="form-control my-2" placeholder="Pincode" required>
                        
                         </div>
                        <div class="col-md-6">
                         <select name="payment_type" id="payment_type" class="form-control my-2" required>
                            <option value="">Select Payment Type</option>
                            <option value="Cash On Delivery">Cash On Delivery</option>
                            <option value="Online Payment">Online Payment</option>
                        </select>
                         </div>
                        </div>
                         <hr>
                         @if(isset($codes))
                         <h5>Coupon Code</h5>
                        <input type="text" name="couponcode" class="form-control my-2" id="couponcode" value="{{$codes->code }}">
                        <input type="hidden" name="couponvalue" class="form-control my-2" id="couponcvalue" value="{{$codes->value}}">
                        <input type="hidden" name="coupontype" class="form-control my-2" id="coupontype" value="{{$codes->type}}">
                        
                         
                        <div class="text-center">   
                        <input  class="btn btn-info text-white" onclick="Couponcode()" value="Apply Code" id="couponapplied">
                        @endif
                        <input type="hidden" name="amt_after_coupon" class="form-control my-2" id="totalamt" value="{{$total}}">
                        <div class="text-center">  
                         <button type="submit" class="btn  btn-primary my-2 px-5">Place Order</button>
                        </div>
                        </form>
                        <form>
                        <div class="mt-3 mb-2 text-white" id="msg_div"></div>  
                        </form>
                        <div class="text-center">  
                        <div class="flex-center position-ref full-height">
                        <div class="content">
                            <a class="btn btn-success w-100" href="{{ route('processTransaction') }}">Pay Rs {{$gtotal}}</a>
                            <div>
                            @if(\Session::has('error'))
                                <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                                {{ \Session::forget('error') }}
                            @endif
                            @if(\Session::has('success'))
                                <div class="alert alert-success">{{ \Session::get('success') }}</div>
                                {{ \Session::forget('success') }}
                            @endif
                             </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js?v=7.2.5') }}"></script>
<script src="{{ url('assets/js/pages/crud/datatables/extensions/buttons.js?v=7.2.5') }}"></script>
<!-- <script src="https://www.paypal.com/sdk/js?client-id=AevLH4XckjXZJ3xJpTAMG7GKwG2bC12dtdp4o5li6jGcb_Kcp5gRekNGftZkel2kfsommWJWZmGDK2SI&currency=IND"></script> -->

<script src="https://www.paypal.com/sdk/js?client-id=AdyJDJDZLIRMLzWktiOkgSCPJtIvb15XT76zccSF5csyb5mAZ39BOZzYdSKt7HAyAVN73skU8dvxeLwE&currency=IND&intent=capture&enable-funding=venmo" data-sdk-integration-source="integrationbuilder"></script>
       
    <script type="text/javascript">

        function Couponcode(){
            
            $('#msg_div').html();
            var code = $('#couponcode').val();
            var totalamt = $('#totalamt').val();  
            if(code !=''){
            $.ajax({
                url : "{{url('couponcode')}}",
                method :"post",
                data : {
                    '_token' : '{{csrf_token()}}',
                    'code'   : code,
                    'totalamt' : totalamt
                },
                dataType: 'json',
                success:function(data){
                  //toastr.success(data.msg);  
                   $('#msg_div').html('<span class="bg-success p-2">'+data.msg+'</span>');
                   $('#payment').html("Pay Rs "+data.totalprice+" from Paypal");
                   $('#totalamt').val(data.totalprice); 
                   $('#couponapplied').hide();
                   $('#msg_div').fadeOut(3000);
                },
                error: function() {
                   
                }
            });
            }else{

                $('#msg_div').html('<span class="bg-danger p-2 msgbox">Please enter coupon code</span>');
                $('#msg_div').fadeOut(3000)
            }
        }
        /////////////////////////
       function payment(){
        alert('Apply');
           
        }
       
    </script>
@endsection