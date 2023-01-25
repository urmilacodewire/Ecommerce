<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')
<body>
    @include('layouts.menus')
        <div class="main_padding">
             <div class="highlighted_banner">
                 <div class="container"> 
                     <div class="row main_row"> 
                        <div class="col-md-12 clearfix">
                          @php
                          
                           $banners = DB::table('banner')
                          ->orderBy('id','desc')
                          ->limit(3)
                          ->get();


                            //$category  = DB::table('categories')->Where('status',1)->get();
                        
                          @endphp 
             
@if(request()->is('/'))
 
<!-- slider -->
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="height:300px">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    </ol>
    <div class="carousel-inner">
        @foreach($banners as $key => $slider)
        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
            <img src="{{url('images', $slider->bannerfile)}}" class="d-block w-100"  alt="..." style="height:300px"> 
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- end slider -->

<hr>
@endif

 
                            @yield('content')
                         </div>  
                     </div>  
                 </div>  
             </div>        
        </div>   
    @include('layouts.footer')
    @include('layouts.script')
        
</body>
</html>
