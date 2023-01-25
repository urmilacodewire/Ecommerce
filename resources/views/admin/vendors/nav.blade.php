<nav class="navbar navbar-expand-lg" style="background-color: #fff !important;">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('vendors.edit',$vendor->id)}}">Basic Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('vendors.step2',$vendor->id)}}">Company Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{URL::to('admin/vendors/contract',$vendor->id)}}">Contract</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{URL::to('admin/vendors/location',$vendor->id)}}">Location</a>
      </li>
      
    </ul>
    <a class="nav-link" href="{{route('vendors.index')}}">List</a>
  </div>
</nav>
