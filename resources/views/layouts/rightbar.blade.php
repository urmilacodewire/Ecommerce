

<div class="col-md-3 main_cols pull_right">
   
   
      
    </div>  
      
        @php
       $banner = DB::table('banner')
               // ->where('position','Right Side')      
               // ->orderBy('id','desc')->limit(3)->get();
               // dd($banner);
         @endphp
        @foreach($banner as $banners) 
        <div class="small_cols ">
<!--             <div class="image_news">   -->  
               <!--  <a href="">
                <img src="" class="img-responsive" alt="" width="100%" height="300px" />
                </a> -->
          
        </div>
        @endforeach
   
     </div>
</div>
