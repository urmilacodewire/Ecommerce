@extends('layouts.app1') 
@section('meta-title', 'E-Commerce')
@section('meta-description', '')

@section('content')
@inject('carbon', 'Carbon\Carbon')
  
<div class="banner_small_here clearfix pt-4">
  <!-- popular products -->
  <!--  -->
  @if(isset($populars))
  <div class="banner_small_here clearfix pt-3">
      <h3 class="font-weight-bold">Trending Products</h3>
      <hr>
       <div class="owl-carousel featured-carousel owl-theme">
        
         @foreach($populars as $popular)
          <div class="item"><h4>
            <a href="{{route('product-detail',$popular->slug)}}">
              <img src="{{URL::to(Config::get('app.base_url').'/images/'.$popular->image)}}" class="card-img-top img-responsive" alt="" width="50px" height="200px" />
            </a>  </h4>
            <span class="ml-3">Rs {{$popular->price}}</span>
            <span class="float-end mr-3">MRP :<del> Rs {{$popular->mrp}}</del></span>
            <div class="text-center mt-2">
              <!-- <span class="bg-info px-4 py-2 "><a class="text-white" href="">Add To Cart</a></span>
              <span class="bg-primary px-4 py-2"><a class="text-white" href="">View Details</a></span> -->
             <form enctype="multipart/form-data" action="{{URL::to('cart',$popular->id)}}" method="get" class="">
                        <input type="hidden" name="prod_name" value="{{$popular->name}}">
                        <input type="hidden" name="prod_image" value="{{$popular->image}}">
                        <input type="hidden" name="prod_price" value="{{$popular->price}}">
                         <button class="btn btn-sm btn-info px-4 ml-2 text-white float-left" type="submit">Add To Cart</button>@if($msg = Session::get('success'))
                              <span class="bg-danger text-white p-2">{{$msg}} </span>
                           @endif 
                    </form>
            <form enctype="multipart/form-data" action="{{URL::to('wishlist',$popular->id)}}" method="get" >
                        <input type="hidden" name="prod_name" value="{{$popular->name}}">
                        <input type="hidden" name="prod_image" value="{{$popular->image}}">
                        <input type="hidden" name="prod_price" value="{{$popular->price}}">
                         <button class="btn btn-sm btn-primary px-3 mr-2 text-white float-right" type="submit">Add To Wishlist</button>
                         <!--  @if($msg = Session::get('success'))
                              <span class="bg-danger text-white p-2">{{$msg}} </span>
                           @endif -->
                    </form>
            </div>
          </div>
          
         @endforeach
         
      </div>
   </div>
   @endif
  <!-- end popular products -->
   <div class="banner_small_here clearfix pt-3">
      <h3 class="font-weight-bold">Latest Products</h3>
      <hr>
      <div class="row ">
         @foreach($products as $product)
         
         <div class="card ml-3 mb-2" style="width: 16.6rem;">
            <a href="{{route('product-detail',$product->slug)}}">
                  <img src="{{URL::to(Config::get('app.base_url').'/images/'.$product->image)}}" class="card-img-top img-responsive" alt="" width="50px" height="200px" />
                  </a>
           <div class="card-body">
             <h5 class="card-title">{{Str::limit($product->name, 50)}}</h5>
            <span class="ml-3">Rs {{$product->price}}</span>
            <span class="float-end mr-3"><del> Rs {{$product->mrp}}</del></span>
            <div class="text-center mt-2">
              <form enctype="multipart/form-data" action="{{URL::to('cart',$popular->id)}}" method="get" class="">
                        <input type="hidden" name="prod_name" value="{{$popular->name}}">
                        <input type="hidden" name="prod_image" value="{{$popular->image}}">
                        <input type="hidden" name="prod_price" value="{{$popular->price}}">
                         <button class="btn btn-sm btn-info px-3 text-white float-left" type="submit">Add To Cart</button>@if($msg = Session::get('success'))
                              <span class="bg-danger text-white p-2">{{$msg}} </span>
                           @endif 
                    </form>
            <form enctype="multipart/form-data" action="{{URL::to('wishlist',$popular->id)}}" method="get" >
                        <input type="hidden" name="prod_name" value="{{$popular->name}}">
                        <input type="hidden" name="prod_image" value="{{$popular->image}}">
                        <input type="hidden" name="prod_price" value="{{$popular->price}}">
                         <button class="btn btn-sm btn-primary px-1 text-white float-right" type="submit">Add To Wishlist</button>
                         <!--  @if($msg = Session::get('success'))
                              <span class="bg-danger text-white p-2">{{$msg}} </span>
                           @endif -->
                    </form>
            </div>
           </div>
         </div>
         @endforeach
      </div>
   </div>
</div>
<!-- </div> -->

@endsection

@section('script')
   <script type="text/javascript">
     $('.featured-carousel').owlCarousel({
    loop:true,
    margin:10,
    dots:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:4,
            nav:true,
            loop:true
        }
    }
})
   </script>
@endsection