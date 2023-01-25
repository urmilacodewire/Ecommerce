{{-- Extend partner layout --}}
@extends('admin.template.layout')
{{-- page content --}}
@section('content')
@section('title','Dashboard')
@section('description', 'Dashboard')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Entry-->
   <div class="d-flex flex-column-fluid pt-4">
      <!--begin::Container-->
      <div class="container">
         <!--begin::Dashboard-->
         <div class="row">
            <div class="d-flex flex-column-fluid pt-4">
               <!--begin::Container-->
               <div class="container">
                  <!--begin::Dashboard-->

                  <div class="row">
                  <div class="col-xl-3">
                        <a href="{{URL::to('admin/banner')}}">
                           <div class="card card-custom bg_gradient card-stretch gutter-b">
                              <div class="card-body">
                                 <span class="font-weight-bold text-white font-size-sm">Total Banners</span>
                                 <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$banners}}</span>
                                 
                              </div>
                           </div>
                        </a>
                     </div>
                     <div class="col-xl-3">
                        <a href="{{URL::to('admin/posts')}}">
                           <div class="card card-custom bg_gradient card-stretch gutter-b">
                              <div class="card-body">
                                 <span class="font-weight-bold text-white font-size-sm">Total Products</span>
                                 <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$products}}</span>
                                 
                              </div>
                           </div>
                        </a>
                     </div>
                     <div class="col-xl-3">
                        <a href="{{URL::to('admin/e-paper')}}">
                           <div class="card card-custom bg_gradient card-stretch gutter-b">
                              <div class="card-body">
                                 <span class="font-weight-bold text-white font-size-sm">Total Customers</span>
                                 <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$customers}}</span>
                                 
                              </div>
                           </div>
                        </a>
                     </div>
                     <div class="col-xl-3">
                        <a href="{{URL::to('admin/video')}}">
                           <div class="card card-custom bg_gradient card-stretch gutter-b">
                              <div class="card-body">
                                 <span class="font-weight-bold text-white font-size-sm">Total Coupons</span>
                                 <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$coupons}}</span>
                                
                              </div>
                           </div>
                        </a>
                     </div>
                      <div class="col-xl-3">
                        <a href="{{URL::to('admin/video')}}">
                           <div class="card card-custom bg_gradient card-stretch gutter-b">
                              <div class="card-body">
                                 <span class="font-weight-bold text-white font-size-sm">Total Orders</span>
                                 <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$orders}}</span>
                                
                              </div>
                           </div>
                        </a>
                     </div>

                  </div>
               </div>
               <!--end::Container-->
            </div>
         </div>
         <!--end::Dashboard-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Entry-->
</div>
<!--end::Content-->
@endsection
{{-- Page Styles --}}
@section('style')
<!-- code -->
@endsection
{{-- Page scripts --}}
@section('script')
<!--begin::Page Scripts(used by this page)-->
<script src="{{URL('assets/js/pages/widgets.js')}}"></script>
<!--end::Page Scripts-->
@endsection