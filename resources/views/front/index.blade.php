@extends('layouts.app1') 
@section('meta-title', 'E-Commerce')
@section('meta-description', '')

@section('content')
@inject('carbon', 'Carbon\Carbon')
<div class="cutom_sidebar_menu_icon"><span class="click_show"><i class="fa fa-times"></i></span><span class="click_hide"><i class="fa fa-bars"></i></span></div>

@foreach($latest as $key)
<div class="banner_inner bg-white">
   <div class="row">
      <div class="col-md-8">
         <div class="img-size"> 
            <img src="{{URL::to(Config::get('app.base_url').'/images/'.$key->image ?? null)}}" class="img-fluid" alt="" width="100%" height="100%" />
         </div>
         
      </div>
      <div class="col-md-4">
         <div class="content_here">
            <h2><a href="{{route('product-detail',$key->slug ?? '')}}" class="text-dark">{{$key->title ?? ''}}</a></h2>
            <h6><a href="{{route('product-detail',$key->slug ?? '')}}" class="category_name">General </a> {{ $carbon::parse($key->created_at ?? '')->format('d/m/Y h:i A')  }}  </h6>
            <div id="content_here">{!! Str::limit($key->description ?? '',250)!!}
            </div>
            <div class="read_more">
               <a href="{{route('product-detail',$key->slug ?? '')}}">Read more</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endforeach


<div class="banner_small_here clearfix pt-4">
   <!--  <h3 class="font-weight-bold">लेटेस्ट न्यूज़</h3>
      <hr> -->
   <div class="row top_new">
      @foreach($popular as $populars)
      <div class="col-md-2 py-2">
         <div class="card_sec">
            <div class="image_news">
               <a href="{{route('product-detail',$populars->slug ?? 0)}}">
                  <img src="{{URL::to(Config::get('app.base_url').'/images/'.$populars->image ?? null)}}" class="img-fluid" alt="" width="100%" height="100%"/>
               </a>
            </div>
            <div class="content_news">
               <h4 class="text-center">
                  <a href="{{route('product-detail',$populars->slug ?? 0)}}">
                  {{ Str::limit($populars->title,30)}}														</a>
                   <p class="m-0 pt-2">{!! Str::limit($populars->description,60)!!}</p>
               </h4>
            </div>
         </div>
      </div>
      @endforeach
   </div>
   <div class="banner_small_here clearfix pt-3">
      <h3 class="font-weight-bold">Latest Products</h3>
      <hr>
      <div class="row ">
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
   </div>
</div>
<!-- </div> -->

@endsection