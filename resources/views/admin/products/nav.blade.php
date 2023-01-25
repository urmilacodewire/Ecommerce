<nav class="navbar navbar-expand-lg" style="background-color: #fff !important;">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('products.show', $product->id)}}"> Images |</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('products.color', $product->id)}}">Color |</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('products.size', $product->id)}}">Size |</a>
      </li>
      
    </ul>
    <a class="nav-link" href="{{route('products.index')}}">List</a>
  </div>
</nav>
