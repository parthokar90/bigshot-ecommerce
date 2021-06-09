<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
</head>
<body style="  font-family: 'Poiret One', cursive;
  background: #3494E6;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #EC6EAD, #3494E6);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #EC6EAD, #3494E6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">
    <div id="app">
        <div class="col-md-12 header-menu">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <h1><a href="/" class="logo">
              <img src="{{asset('assets/common/images/logo.png')}}" alt="" style="height: 50px;width: 70px">
            </a></h1>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                  <div class="form-group has-search">
                  <span class="fa fa-search form-control-feedback"></span>
                  <form class="searchform cf">
                    
                    <input type="text" placeholder="What do you want to find?">
                    <button type="submit">Search</button>
                  </form>
                </div>
                </li>
                <li class="nav-item active">
                    <div class="dropdown">
                     @guest
                            <li class="nav-item active">
                                   <div class="icons">
                                <a href="{{ route('login') }}">
                                  <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                                </a>
                                  </div>
                            </li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                      <img src="{{asset('assets/front/images/icons/register-icon.png')}}" width="40" height="45">
                                    </a>
                                </li>
                            @endif -->
                            @else
                        <img src="{{asset('assets/front/images/icons/fetch.jpg')}}" style="border-radius: 50%;height: 33px;">
                      
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/profile">
                          <div class="hov" style="width: 100%;height: 100px;">
                          <div style="float: left; width: 30%;">
                            <img src="{{asset('assets/front/images/icons/fetch.jpg')}}" style="border-radius: 50%;height: 50px;">
                          </div>
                          <div class="mt-1" style="float: right; width: 70%;">   
                            
                        {{ Auth::user()->name }}  <br>View Profile</div>
                        </div>
                        </a>
                        <a class="dropdown-item" href="#"><i class="demo fa fa-gift" aria-hidden="true"></i>Earn</a>
                        <a class="dropdown-item" href="/wishlist"><i class="demo fa fa-heart" aria-hidden="true"></i>Wishlist</a>
                        <a class="dropdown-item" href="/cart"><i class="demo fa fa-shopping-cart" aria-hidden="true"></i>Shopping Cart</a>
                        <a class="dropdown-item" href="/order-history"><i class="demo fa fa-sticky-note" aria-hidden="true"></i>Order History</a>
                        <a class="dropdown-item" href="/order-list"><i class="demo fa fa-sticky-note" aria-hidden="true"></i>Order List</a>
                        <a class="dropdown-item" href="/daily-login-bonus"><i class="demo fa fa-calendar" aria-hidden="true"></i>Daily Login Bonus</a>
                        <a class="dropdown-item" href="cash"><i class="demo fa fa-credit-card" aria-hidden="true"></i>Wish Cash</a>
                        <a class="dropdown-item" href="/rewards"><i class="demo fa fa-trophy" aria-hidden="true"></i>Rewards</a>
                        <a class="dropdown-item" href="#"><i class="demo fa fa-users" aria-hidden="true"></i>Customer Support</a>
                        <a class="dropdown-item" href="#">FAQ</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-item" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                  </div>
                       
                      </div>
                    </div>

                </li>
                @endguest
                <li class="nav-item active">
                  <div class="icons">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                  </div>
                </li>
                <li class="nav-item active">
                  <div class="icons">
                    <a href="/cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                  </div>
                </li>
                <li class="nav-item active">
                  <div class="icons">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                  </div>
                </li>

              </ul>
            </div>
          </div>
        </nav>
    </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
