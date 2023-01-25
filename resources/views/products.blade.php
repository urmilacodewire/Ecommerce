@extends('layouts.app1')

@section('content')
@inject('carbon', 'Carbon\Carbon')
         <div class=" row ">
            @foreach($products as $product)      
         <div class="card ml-3 mb-2" style="width: 17.6rem;">
            <a href="{{route('product-detail',$product->slug ?? 0)}}">
                  <img src="{{URL::to(Config::get('app.base_url').'/images/'.$product->image ?? null)}}" class="card-img-top img-responsive" alt="" width="50px" height="200px" />
                  </a>
           <div class="card-body">
             <h5 class="card-title">{{Str::limit($product->name, 50)}}</h5>
             <p class="card-text">{!! Str::words($product->description,10)!!}</p>
           </div>
         </div>
          @endforeach  
       </div>                 
@endsection 