<body>
  <div class="col-md-12 header-menu">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed;
    width: 100%; box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
      <div class="container-fluid">
        <h1><a href="{{url('/')}}" class="logo">
            <img src="{{asset('assets/common/images/logo.png')}}" alt="" style="height: 46px;width: 70px">
          </a></h1>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->
        <div class="" id="navbarSupportedContent">
          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-none d-lg-block">
              <div class="form-group has-search">
                <span class="fa fa-search form-control-feedback"></span>
                
                  <input type="text" name="q" placeholder="What do you want to find?">
                  <button type="submit">Search</button>
                </form>
              </div>
            </li>
            <li class="nav-item d-inline">
              <div class="dropdown">
                @guest
            <li class="nav-item ">
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
            @php
            $profile_image=DB::table('usermeta')->where(['user_id'=>auth()->user()->id,'meta_key'=>'user_image'])->first();
            @endphp
            @if(isset($profile_image->meta_value))
            <img src="{{asset('assets/front/user/'.$profile_image->meta_value)}}" style="border-radius: 50%;height: 33px;">
            @else
            <img src="{{asset('assets/front/images/icons/fetch.jpg')}}" style="border-radius: 50%;height: 33px;">
            @endif
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{url('profile')}}">
                <div class="hov ">
                  <div class="ml-2">
                    @if(isset($profile_image->meta_value))
                    <img src="{{asset('assets/front/user/'.$profile_image->meta_value)}}" style="border-radius: 50%;height: 33px;">
                    @else
                    <img src="{{asset('assets/front/images/icons/fetch.jpg')}}" style="border-radius: 50%;height: 33px;">
                    @endif
                  </div>
                  <p class="ml-4">
                    {{ Auth::user()->name }} <br><span class="ml-2" style="color: black;">View Profile</span>
                  </p>
                </div>
              </a>
              <!-- <a class="dropdown-item" href="#"><i class="demo fa fa-gift" aria-hidden="true"></i>Earn</a> -->
              <a class="dropdown-item" href="{{url('wishlist')}}"><i class="demo fa fa-heart ml-1" aria-hidden="true"></i>Wishlist</a>
              <a class="dropdown-item" href="{{url('cart')}}"><i class="demo fa fa-shopping-cart" aria-hidden="true"></i>Shopping Cart</a>
              <!-- <a class="dropdown-item" href="{{url('order-history')}}"><i class="demo fa fa-sticky-note" aria-hidden="true"></i>Order History</a> -->
              <a class="dropdown-item" href="{{url('order-list')}}"><i class="demo fa fa-sticky-note ml-1" aria-hidden="true"></i>Order History</a>
              <!-- <a class="dropdown-item" href="/daily-login-bonus"><i class="demo fa fa-calendar" aria-hidden="true"></i>Daily Login Bonus</a> -->
              <!-- <a class="dropdown-item" href="cash"><i class="demo fa fa-credit-card" aria-hidden="true"></i>Wish Cash</a> -->
              <!-- <a class="dropdown-item" href="/rewards"><i class="demo fa fa-trophy" aria-hidden="true"></i>Rewards</a> -->
              <a class="dropdown-item ml-1" href="{{url('customer-support')}}"><i class="demo fa fa-users" aria-hidden="true" style="font-size: 22px;"></i>Customer Support</a>
              <a class="dropdown-item" href="{{url('faq')}}"><i class="fa fa-question-circle ml-1 mr-3"></i>FAQ</a>
              <!-- <a class="dropdown-item" href="{{url('settings')}}">Settings</a> -->
              <div class="dropdown-item" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>

            </div>
        </div>
        </li>
        @endguest
        <li class="nav-item ">
          <div class="icons">
            <a href="{{url('/cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true">
                @if(\Cart::getTotalQuantity()==0)
                @else
                <span class="badge-view">
                  {{ \Cart::getTotalQuantity()}}
                </span>
                @endif

              </i></a>
          </div>
        </li>
        <li class="nav-item ">
          <div class="icons">
            <a href="{{url('wishlist')}}">
              <i class="fa fa-heart" aria-hidden="true"></i>
            </a>
          </div>
        </li>

        </ul>
      </div>




      
  </div>
  </nav>
  </div>

  <div class="col-md-12 main-menu ">
    <div class="container-fluid">
      <div class="memu-list" style="background-color: rgba(245, 246, 247, 1) !important;">

        <div class="memu-item" id="">
          <ul class="" style="width: 80%">
            @foreach($tags as $tag)
            <li class=" ">
              <a class="" href="{{route('tag.product.show',$tag->term_id)}}">{{$tag->name}}</span></a>
            </li>
            @endforeach
          </ul>

          <ul class="">
            <li class=" ">
              <a class="" href="{{route('faq')}}">FAQ</a>
            </li>
            @guest
            @else
            <li class="">
              <a class="" href="#">Customer Support</a>
            </li>
            @endguest
            <li class="">
              <a class="" href="{{route('about')}}">About Us</a>
            </li>
          </ul>

        </div>
      </div>

    </div>
  </div>

