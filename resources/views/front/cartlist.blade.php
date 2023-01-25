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
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        
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
                            <td>
                            	<a href="{{ route('cart.increase', $item->product_id) }}" class="delete btn btn-primary btn-sm">+</a>
                            	<span class=" bg-secondary p-2">{{ $item->product_qunty }}</span>
                            	<a href="{{ route('cart.decrease', $item->product_id) }}" class="delete btn btn-danger btn-sm">-</a>
                            </td>
                            <td>{{ $item->prod_price}}</td>
                            <td>{{ $item->total_price }}</td>
                            
                            <td>
                                
                                <form style="display: inline-block" action="{{ route('cartlist.destroy', $item->product_id) }}" method="POST">
                                    @csrf
                                    @method('delete')   
                                    <button type="submit" class="delete btn btn-danger btn-sm mr-3"
                                        onclick="return confirm('Are You Sure')">Remove</button>
                                </form>
                            </td>
                        </tr>
                     @endforeach

                    @php 
                  		$total = DB::table('carts')->where(['is_ordered'=>'no','user_slug'=>Auth::user()->slug])->sum(DB::raw('carts.total_price'));
                  		//$t_price = $total[0]->total_price->sum();
                  		
                  	@endphp
                    <tr>
                    	<th colspan="5" class="text-right">Total</th>
                    	<th >
                    		{{$total }}
                    	</th>
                    	<th ></th>
                     </tr>
                </tbody>
            </table>
        </div>
   </div>
</div>
<div class="text-center">
	@if(isset($item->user_slug))
    <a type="submit" href="{{route('checkout',$item->user_slug)}}" class="btn btn-lg btn-primary px-5 my-2 ">Checkout</a>
    @endif
</div>
@endsection