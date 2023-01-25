<nav class="navbar navbar-expand-lg" style="background-color: #fff !important;">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('customers.show', $customer->id)}}"> Customer Details |</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('customers.edit', $customer->id)}}"> Edit Customer Details |</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('customers.wishlist', $customer->id)}}"> Wishlist |</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('customers.cart', $customer->id)}}">Cart |</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('customers.orders', $customer->id)}}">Orders |</a>
      </li>
      
    </ul>
    <a class="nav-link" href="{{route('customers.index')}}">List</a>
  </div>
</nav>
