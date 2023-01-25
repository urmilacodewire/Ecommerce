  @extends('layouts.app1')
@section('style')
  <style>
     .rate {
         float: left;
         height: 46px;
         padding: 0 10px;
         }
         .rate:not(:checked) > input {
         position:absolute;
         display: none;
         }
         .rate:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ccc;
         }
         .rated:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ccc;
         }
         .rate:not(:checked) > label:before {
         content: '★ ';
         }
         .rate > input:checked ~ label {
         color: #ffc700;
         }
         .rate:not(:checked) > label:hover,
         .rate:not(:checked) > label:hover ~ label {
         color: #deb217;
         }
         .rate > input:checked + label:hover,
         .rate > input:checked + label:hover ~ label,
         .rate > input:checked ~ label:hover,
         .rate > input:checked ~ label:hover ~ label,
         .rate > label:hover ~ input:checked ~ label {
         color: #c59b08;
         }
         .star-rating-complete{
            color: #c59b08;
         }
         .rating-container .form-control:hover, .rating-container .form-control:focus{
         background: #fff;
         border: 1px solid #ced4da;
         }
         .rating-container textarea:focus, .rating-container input:focus {
         color: #000;
         }
         .rated {
         float: left;
         height: 46px;
         padding: 0 10px;
         }
         .rated:not(:checked) > input {
         position:absolute;
         display: none;
         }
         .rated:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ffc700;
         }
         .rated:not(:checked) > label:before {
         content: '★ ';
         }
         .rated > input:checked ~ label {
         color: #ffc700;
         }
         .rated:not(:checked) > label:hover,
         .rated:not(:checked) > label:hover ~ label {
         color: #deb217;
         }
         .rated > input:checked + label:hover,
         .rated > input:checked + label:hover ~ label,
         .rated > input:checked ~ label:hover,
         .rated > input:checked ~ label:hover ~ label,
         .rated > label:hover ~ input:checked ~ label {
         color: #c59b08;
         }
</style>  
@endsection
@section('content')
@inject('carbon', 'Carbon\Carbon')
      <div class="container">
         <div class="row ">
            <div class="col-md-4">
               <img src="{{URL::to(Config::get('app.base_url').'/images/'.$products->image)}}" class="img-responsive" title="" id="showimg">
            </div>

            @php
                  $images = DB::table('product_images')->where('product_id',$products->id)->limit(5)->get();
            @endphp
            
            <div class="col-md-2">
              <ul>
                @if(isset($images))
                @foreach($images as $img)
                <li type="none"><img src="{{URL::to(Config::get('app.base_url').'/images/'.$img->imagename)}}" class="img-responsive" title=""  id="imgpath" onclick="changeImage(this)" height="50px">
                </li><br><hr width="50px">
                 @endforeach
                 @endif
                 <li type="none">
                   <img src="{{URL::to(Config::get('app.base_url').'/images/'.$products->image)}}" class="img-responsive" title="" onclick="changeImage(this)" height="50px">
                 </li>
              </ul>
               
            </div>
           
            <div class="col-md-6">
               <div class="card  border border-dark  text-left" style="max-width: 100%;">
                 <div class="card-header">{{$products->name ?? ''}}</div>
                 <div class="card-body">
                   <span class="card-title"><b>Brand :</b></span> <span>{{$products->brand}}</span><br>
                   <span class="card-title"><b>MRP :</b></span>  <span>Rs {{$products->mrp}}</span><br>
                   <span class="card-title"><b>Price :</b></span> <span>Rs {{$products->price}}</span>
                   <p class="card-text">{!!$products->description!!}</p>
                   <span><strong>Available Colors : </strong></span>
                   @php
                      $colors =DB::table('colors')->where(['product_id'=>$products->id,'status'=>1])->get();
                      $sizes =DB::table('sizes')->where(['product_id'=>$products->id,'status'=>1])->get();
                   
                   @endphp
                   <span style="background-color: {{$products->color}};color:{{$products->color}}">color</span>
                   @foreach($colors as $cols)
                   <span style="background-color: {{$cols->color}};color:{{$cols->color}}">color</span>
                   @endforeach
                   <br>
                   <span><strong>Available Sizes : </strong></span>
                   <span style="border:1px solid black; width: 100px; padding: 2px">{{$products->size}}</span>
                   @foreach($sizes as $size)
                   <span style="border:1px solid black; width: 100px; padding: 2px">{{$size->size}}</span>
                   @endforeach
                   <br><br>
                   @if($products->quantity >0)
                      <span  class="badge bg-success p-2">{{$products->quantity}} in stock </span>
                   @else
                      <span  class="badge bg-danger p-2">Not in stock</span>
                   @endif
                 </div>
                  <div class=" text-center d-flex ">
                    <form enctype="multipart/form-data" action="{{URL::to('cart',$products->id)}}" method="get" class="mx-4">
                        <input type="hidden" name="prod_name" value="{{$products->name}}">
                        <input type="hidden" name="prod_image" value="{{$products->image}}">
                        <input type="hidden" name="prod_price" value="{{$products->price}}">
                         <button class="btn btn-secondary text-white" type="submit">Add To Cart</button><br>
                         <br>
                          <!--
                           @if($msg = Session::get('success'))
                              <span class="bg-danger text-white p-2">{{$msg}} </span>
                           @endif -->
                    </form>
                    <form enctype="multipart/form-data" action="{{URL::to('wishlist',$products->id)}}" method="get" >
                        <input type="hidden" name="prod_name" value="{{$products->name}}">
                        <input type="hidden" name="prod_image" value="{{$products->image}}">
                        <input type="hidden" name="prod_price" value="{{$products->price}}">
                         <button class="btn btn-secondary text-white" type="submit">Add To Wishlist</button><br>
                         <br><br>
                          <!--  @if($msg = Session::get('success'))
                              <span class="bg-danger text-white p-2">{{$msg}} </span>
                           @endif -->
                    </form>
              <!-- Button trigger modal -->
              <form>
                <button type="button" class="btn btn-primary text-white ml-4" data-toggle="modal" data-target="#exampleModal">
                  Give rating this products
                </button>
              </form>
           </div>
               </div>
            </div>
         </div>  
      </div>
       
       <hr class="bg-success" style="height: 1px" >
 <!-- Show Reviews -->
    <div class="">
      <h4><u>Reviews of customers</u></h4>
      @foreach($reviews as $review)
      <span class="badge badge-info">{{$review->name}}</span><br />
       @for($i=1; $i<=$review->rating; $i++)
        <i class="fa fa-star text-success"></i>
      @endfor
      <p>{{$review->review}}</p>
      <hr>
      @endforeach
    </div>

 <!-- end Reviews -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rate this product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="py-2 px-4" action="{{route('rating-reviews.store')}}" style="box-shadow: 0 0 10px 0 #ddd;" method="POST" autocomplete="off">
               @csrf
               <p class="font-weight-bold ">Review</p>
               <div class="form-group row">
                  <input type="hidden" name="product_id" value="{{$products->slug}}">
                  <input type="hidden" name="user_id" value="{{Auth::user() ->id}}">
                  <div class="col">
                     <div class="rate">
                        <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" checked id="star4" class="rate" name="rating" value="4"/>
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" class="rate" name="rating" value="2">
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                        <label for="star1" title="text">1 star</label>
                     </div>
                  </div>
               </div>
               <div class="form-group row mt-4">  
                  <div class="col">
                     <textarea class="form-control" name="review" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                  </div>
               </div>
               <div class="mt-3 text-right">
                  <button class="btn btn-sm py-2 px-3 btn-info">Submit
                  </button>
               </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

       <!-- end modal -->
     
   @endsection

   @section('script')
    <script type="text/javascript">
     function changeImage(id){
        $('#showimg').attr('src',id.src) ;
     }
     
    </script>
   @endsection