@php 
    
//$banner = DB::table('banner')->where('position','Header')->limit(1)->orderby('id','DESC')->first();
@endphp

<div class="top_bar" id="on_top">
    <div class="container">
        <div class="adds pull_right">
            <a href="#">  
            <img src="{{url('assets/logo/elogo.png')}}"/>
            </a>
        </div>
        
        <div class="logo pull_left">
            <!-- Brand -->
            <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{url('assets/logo/elogo.png')}}"/>
            </a>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>