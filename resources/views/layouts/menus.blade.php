<style type="text/css">
  .navbar-expand-md .navbar-nav .nav-link{
    color: black !important;
  }
</style>
<nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse d-flex" id="collapsibleNavbar">
               <ul class="navbar-nav d-flex ">
                <li class="nav-item">
				           <a class="navbar-brand" href="{{URL::to('/home')}}">
                  <img src="{{url('assets/logo/elogo.png')}}" width="40px" height="30px" />
                  </a>
                </li> 
                  <li class="nav-item mr-5">
                     <a class="nav-link" href="{{URL::to('/')}}">
                     <i class="fa fa-home"></i> <span class="mob_show">Home</span>
                     </a>
                  </li>
                </ul>
                <ul class="navbar-nav d-flex float-end">
               <li class="nav-item ml-5">
                     <form action="{{route('autosearch')}}" method="post">
                      @csrf
                        <div class="input-group">
                           <input type="text" class="form-control " id="searchNews" name="searchNews" placeholder="Search" />
                           <div class="input-group-append">
                              <button class="input-group-text"><i class="fas fa-search"></i></button>
                           </div>
                        </div>
                     </form>
                     <div id="searchNewsResult"></div>
               </li>
                @if(!isset(Auth::user()->id))
                <li ><a class="nav-link" style="color:black;" href="javascript::void;" id="navbardrop" ><span>Cart[0]</span></a></li>
               <li ><a class="nav-link " href="javascript::void;" id="navbardrop" ><span>Wishlist[0]</span></a></li>
               @endif
               @if(isset(Auth::user()->id))
               @php
                $cartitem = DB::table('carts')->where(['is_ordered'=>'no','user_slug'=>Auth::user()->slug])->count();
                $Wishitem = DB::table('wishlists')->where(['user_slug'=>Auth::user()->slug])->count();

                $orders = DB::table('orders')->where(['user_slug'=>Auth::user()->slug])->count();
               @endphp

              <li ><a class="nav-link " href="{{URL::to('cartlist',Auth::user()->id)}}" id="navbardrop" ><span>Cart[{{$cartitem}}]</span></a></li>
             <li ><a class="" href="{{URL::to('cart')}}" id="navbardrop" ><span>
             <!--  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3" viewBox="0 0 16 16">
              <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/>
            </svg> -->
          </span></a></li>

            <li ><a class="nav-link " href="{{URL::to('wishlist-items',Auth::user()->id)}}" id="navbardrop" ><span>Wishlist[{{$Wishitem}}]</span></a></li>
             <li ><a class="nav-link " href="{{URL::to('user-orders',Auth::user()->id)}}" id="navbardrop" ><span>My Orders[{{$orders}}]</span></a></li>
             @endif
                        @guest
                            @if (Route::has('login'))

                            <li><a class="nav-link pull-right" href="{{ route('login') }}" id="navbardrop">Login</a></li>
                                 
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('myaccount',Auth::user()->slug) }}">
                                        {{ __('My Account') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
            </ul>
         </div>
    </nav>
    
<nav class="navbar navbar-expand-lg navbar-light bg-dark ">
  <div class="container-fluid w-100 ">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarText">
        <ul class="navbar-nav mr-auto d-flex text-center">
           <li class="nav-item ">     
            <a class="nav-link" href="{{URL::to('shop')}}">Shop</a>
         </li>
         @php
            $category  = DB::table('categories')->Where('status',1)->get();
         @endphp
            @foreach($category as $menu)
         <li class="nav-item ">     
            <a class="nav-link" href="{{URL::to('products',str_replace(' ', '_',$menu->name))}}">
            {{$menu->name}}
            </a>
         </li>
            @endforeach 
        </ul>   
        <span class="navbar-text">
         
        </span>
      </div>
      </div>
</nav>

