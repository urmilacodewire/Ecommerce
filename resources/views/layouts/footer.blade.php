 @php
$category  = DB::table('categories')->Where('status',1)
                                    ->get();
@endphp     

<div class="bottom">
   <div class="row p-0 m-0 text-center">
      @foreach($category as $urls)
    @if(request()->is('blogs/'.$urls->name) )
        @php
           $banners = DB::table('banner')
                ->where('position','Bottom')
                ->first();  
          @endphp

      <div class="col-md-12">
         <a href="{{$banners->link ?? ''}}">  
            <img src="{{ asset('images/'.$banners->bannerfile ?? '') }}" alt="Tunin Header Ad1" height="100" width="100%">
         </a>
      </div>
   </div>
 </div>
 </div>
    @endif
@endforeach   
<footer>
   <ul id="menu-extra-pages" class="menu">
      <li><a href="{{url('/about')}}">About</a></li>
      <li><a href="#">Disclaimer</a></li>
      <li><a href="{{url('/advertising')}}">Advertising With Us</a></li>
      <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
      <li><a href="{{url('/term-condition')}}">Terms & Condition</a></li>
   </ul>
   <div class="footer-coypright clearfix">
      <p class="text-center">{{date('Y')}} © E-Commerce, All Rights Reserved.</p>
   </div>
   <div class="top_up">
      <a href="#on_top">
         <div id="back-top" class="">
            <i class="fas fa-chevron-up"></i>
         </div>
      </a>
   </div>
</footer>
