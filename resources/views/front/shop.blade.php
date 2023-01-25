@include('layouts.head')
@include('layouts.menus')
@section('meta-title', 'E-Commerce')
@section('meta-description', '')
@section('style')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"  media="screen">	
	<style type="text/css">
	.shopbody {
		width: 100vw;
	}

	#body-row {
    margin-left:0;
    margin-right:0;
}

#sidebar-container {
    min-height: 100vh;   
    background-color: #333 !important;
    padding: 0;
}
	
/* Sidebar sizes when expanded and expanded */
.sidebar-expanded {
    width: 230px;
}
.sidebar-collapsed {
    width: 60px;
}

/* Menu item*/
#sidebar-container .list-group a {
    height: 50px;
    color: white !important;
}

/* Submenu item*/
#sidebar-container .list-group .sidebar-submenu a {
    height: 45px;
    padding-left: 30px;
}
.sidebar-submenu {
    font-size: 0.9rem;
}

/* Separators */
.sidebar-separator-title {
    background-color: #333;
    height: 35px;
}
.sidebar-separator {
    background-color: #333;
    height: 25px;
}
.logo-separator {
    background-color: #333;    
    height: 60px;
}

/* Closed submenu icon */
#sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
  content: " \f0d7";
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 10px;
}
/* Opened submenu icon */
#sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
  content: " \f0da";
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 10px;
}
	</style>
@endsection

@inject('carbon', 'Carbon\Carbon')
<div class="container shopbody">
	<div class="row " id="body-row">
		<div class="col-md-3 " >
			<!-- Sidebar -->
	    	<div id="sidebar-container" class="sidebar-expanded d-none d-md-block" style="height: 100vh;background-color: black">
	          	<ul class="list-group ">
	            <!-- Menu with submenu -->
	            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                <div class="d-flex w-100 justify-content-start align-items-center">
	                    <span class="menu-collapsed text-info">Filter By Price</span>
	                    
	                </div>
	            </a>
	            <!-- Submenu content -->
	            <div id='' class="sidebar-submenu pl-3 pt-2">
	                  <form method="post" action="{{route('autosearch')}}">
	                  	@csrf
				      <div data-role="rangeslider">	
				        <input type="range" class="mb-2" name="rangeMin" step="100" min="100" max="1000" value="" onchange="rangePrimary.innerHTML=value">
						<span class="text-white" id="rangePrimary"></span>
						<input type="range" class="mb-2" name="rangeMax" step="500" min="1000" max="10000" value="" onchange="rangeSecondary.innerHTML=value">
						<span class="text-white" id="rangeSecondary">	</span>
				      </div>
				        <input type="submit" class="btn btn-sm btn-info ml-5 mb-2" data-inline="true" value="Submit">
				      </form>
                     
	        	</div>
	        	<!-- Menu with submenu -->
	            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                <div class="d-flex w-100 justify-content-start align-items-center">
	                   <span class="menu-collapsed text-info">Filter By Color</span>
	                 </div>
	            </a>
	            <!-- Submenu content -->
	            <div id='' class=" sidebar-submenu px-3 py-4">
	                  <form action="{{route('autosearch')}}" method="post">
	                  	@csrf
                        <div class="input-group">
                           <input type="text" class="form-control " id="searchNews" name="color" placeholder="Color Name" />
                           <div class="input-group-append">
                              <button class="input-group-text">Filter</button>
                           </div>
                        </div>
                     </form>
                     <div id="searchNewsResult"></div>
	                
	        	</div>
	        	<!-- Menu with submenu -->
	            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                <div class="d-flex w-100 justify-content-start align-items-center">
	                   <span class="menu-collapsed text-info	">Filter By Brand</span>
	                </div>
	            </a>
	            <!-- Submenu content -->
	            <div id='' class=" sidebar-submenu px-3 py-4">
	               <form action="{{route('autosearch')}}" method="post">
	               	@csrf
                        <div class="input-group">
                           <input type="text" class="form-control " id="searchNews" name="brand" placeholder="Brand Name" />
                           <div class="input-group-append">
                              <button class="input-group-text">Filter</button>
                           </div>
                        </div>
                     </form>
                     <div id="searchNewsResult"></div>
	        	</div>
	        	</ul><!-- List Group END-->
	    	</div><!-- sidebar-container END -->
		</div>
    
    <!-- MAIN -->
    <div class="col-md-9 p-4">
    	<div class="row">
 		@foreach($popular as $populars)
      <div class="col-md-3 py-2">
         <div class="card_sec">
            <div class="image_news">
               <a href="{{route('product-detail',$populars->slug ?? 0)}}">
                  <img src="{{URL::to(Config::get('app.base_url').'/images/'.$populars->image)}}" class="card-img-top img-responsive" alt="" width="100px" height="100px"/>
               </a>
            </div>
            <div class="content_news">
               <h4 class="text-center">
                  <a href="{{route('product-detail',$populars->slug ?? 0)}}">
                  {{ Str::limit($populars->price,30)}}														</a>
                   <p class="m-0 pt-2">{!! Str::limit($populars->description,60)!!}</p>
               </h4>
            </div>
         </div>
      </div>
      @endforeach
      </div>
    </div><!-- Main Col END -->
</div><!-- body-row END -->
</div>

@include('layouts.script')
@section('script')
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

	<script type="text/javascript">
		// Hide submenus
$('#body-row .collapse').collapse('hide'); 

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left'); 

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    
    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}
	</script>
@endsection