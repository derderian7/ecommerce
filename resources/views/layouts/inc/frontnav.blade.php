<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">E-shop</a>
      <div class="searcha">
        <form action="{{url('searchproduct')}}" method="POST">
          @csrf
      <div class="input-group">
        <input type="search" id="search_product" name="product_name" class="form-control" placeholder="Search Product">
        <button class="input-group-text" type="submit"><i class="bi bi-search"></i></button>
      </div>
    </form>
    </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="{{url('category')}}">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{url('cart')}}">Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{url('wishlist')}}">Wishlist</a>
          </li>
          @guest
              
          @if (Route::has('login'))
              <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">{{__('Login')}}</a>
              </li>
          @endif
          @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">{{__('Register')}}</a>
              </li>
              @endif
              @else 
              <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
              </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              <li class="nav-item">
                <a href="{{url('my_orders')}}" class="nav-link active" >My Orders</a>
              </li>
          @endguest

        </ul>
      </div>
    </div>
  </nav>