  <!-- header part start -->
  <style>
    .dropbtn {
      color: #000000;
      border: none;
    }

    .dropdown {
      position: relative;
      display: inline-block;
        cursor: pointer;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;

      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      cursor: pointer;
    }
    .dropdown-content a:hover {background-color: #ddd;}
    .dropdown:hover .dropdown-content {display: block;}

    .main {
      width: 50%;
      margin: 50px auto;
    }

    /* Bootstrap 4 text input with search icon */

    .has-search .form-control {
      padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
      position: absolute;
      z-index: 2;
      display: block;
      width: 2.375rem;
      height: 2.375rem;
      line-height: 2.375rem;
      text-align: center;
      pointer-events: none;
      color: #aaa;
    }
    .homeSearchInput{
      border-radius: 5px 0 0 5px;
    }
    .homeSearchButton
    {
      border-radius: 0 5px 5px 0;
    }
    .homeSearchInput::placeholder{
      font-size: 12px;
    }
    .sm-menus div{
     height: auto !important; 
   }

   .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    /*min-width: 0rem !important; */
    padding: 0;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    
    border-radius: .25rem;
  }
  .dropdown-large{
   min-width: 0rem !important; 
 }
 .dropdown-item {

  padding: .25rem 0.5rem;
  border-top: 1px solid;
  /*width: 125px;*/
}
.dropdown-item:focus, .dropdown-item:hover {
  color: white;
  font-weight: bold;
  text-decoration: none;
  background-color: #00B0F0;
}
/*********************/

.dropdown-submenu {
  position: relative;
}

.dropdown-submenu a::after {
  transform: rotate(-90deg);
  position: absolute;
  right: 6px;
  top: .8em;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-left: .1rem;
  margin-right: .1rem;
}
.dropdown-toggle::after{
  color:#000000;
}

.all_menu{
  line-height: 40px;
}
.all_menu i{
 font-size: 20px;
 color:#000000;
}
.all_menu img{
 width: 20px;
 height: 20px;
}

.all_menu .payment img{
   width: 35px;
 height: 26px;
}

.all_menu span{
 margin-left: 5px;
}

.card-text:last-child {
    margin-bottom: 18px;
}
select option:hover {
   background: #00B0F0;
}

.navbar-light .navbar-toggler {
    color: rgba(0,0,0,.5);
    border-color: transparent;
}

.homeSearchButton{
  background: #00B0F0;
  border: 1px solid #00B0F0;
}
.btn-secondary{
    background: #00B0F0;
  border: 1px solid #00B0F0;
}
.btn-secondary:hover{
    background: #00B0F0;
    border: 1px solid #00B0F0;
}
.btn-primary{
    background: #00B0F0;
    border: 1px solid #00B0F0;
}
.btn-primary:hover{
    background: #00B0F0;
    border: 1px solid #00B0F0;
}
.btn-success{
    background: #00B0F0;
    border: 1px solid #00B0F0;
}
.btn-success:hover{
    background: #00B0F0;
    border: 1px solid #00B0F0;
}


    /* desktop device */
    .span{ 
    height: 13px !important;
    width: 15px !important;
    color: red !important;
    font-size: 11px !important;
    line-height: 13px !important;
    text-align: center !important;
    font-weight: bold !important;
    display: inline-block !important;
    border-radius: 50% !important;
    position: absolute !important;
    top: 39px !important;
    right: 143px;
    }

    .mobile_span{
    height: 13px !important;
    width: 15px !important;
    color: red !important;
    font-size: 9px !important;
    line-height: 13px !important;
    text-align: center !important;
    font-weight: bold !important;
    display: inline-block !important;
    border-radius: 50% !important;
    position: absolute !important;
    top: 27px !important;
    right: 55px;
    }

      .span_heart{ 
    height: 13px !important;
    width: 15px !important;
    color: red !important;
    font-size: 11px !important;
    line-height: 13px !important;
    text-align: center !important;
    font-weight: bold !important;
    display: inline-block !important;
    border-radius: 50% !important;
    position: absolute !important;
    top: 39px !important;
    right: 144px;
    }

       .span1 {
    height: 13px !important;
    width: 15px !important;
    color: red !important;
    font-size: 10px !important;
    line-height: 13px !important;
    text-align: center !important;
    font-weight: 700 !important;
    display: inline-block !important;
    border-radius: 50% !important;
    position: absolute !important;
    top: 42px !important;
    right: 185px;
    } 

    .fixed-top {
    position: relative !important;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;
}



</style>
<div class="mt-0 mb-2 bg-light sticky-top" id="nav">
  <nav class="navbar navbar-expand-lg navbar-light bg-light d-block d-sm-none">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a href="{{url('/')}}" class="ml-3 mt-2"><img src="{{asset('assets/common/images/logo.png')}}" class="img-fluid" alt="logo" style="height: 30px;width: 80px"></a>  
    @guest
    <a href="{{ route('login') }}" class="float-right mt-2">  <img width="20px" height="20px" src="{{asset('backend/user.png')}}"></a> 
    @else 
    <a href="{{url('profile')}}" class="float-right mt-2">  <img width="20px" height="20px" src="{{asset('backend/user.png')}}"></a> 
    @endguest 

    <!-- check cart margin -->
       @if(Auth::check())
      @php 
      $cart_count=DB::table('user_cart')
      ->where('user_id',auth()->user()->id)
      ->sum('quantity');
      @endphp 
      @else 
      @php $cart_count=\Cart::getTotalQuantity(); @endphp
      @endif
    <!-- end check cart margin -->

      <a href="{{url('cart')}}" class="float-right mt-2  mr-3"> <img width="20px" height="23px" src="{{asset('backend/bag.png')}}"> 
      @if(Auth::check())
      @php 
      $cart_count=DB::table('user_cart')
      ->where('user_id',auth()->user()->id)
      ->sum('quantity');
      @endphp 
      @else 
      @php $cart_count=\Cart::getTotalQuantity(); @endphp
      @endif
     <div class="mobile_span">
        @if($cart_count>0)
           {{ $cart_count}} 
        @endif  
     </div>
   </a>  
   <!-- <a class="float-right  mt-2" href="{{url('wishlist')}}"><i style="color:#000000"  class="demo fa fa-heart" aria-hidden="true"></i> -->




  </a>
  <a class="float-right mr-3 mt-2" data-toggle="modal" data-target="#exampleModalCenter" class="float-right" href=""><i style="color:#000000;margin-top:8px;"  class="fa fa-search" aria-hidden="true"></i></a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="d-flex flex-column sm-menus">
     <nav class="navbar navbar-expand-lg p-0">      
    <div class="navbar-nav mr-auto mt-2 mt-lg-0">     
     @php 
     $tags = DB::table('term_taxonomy')
     ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
     ->where('term_taxonomy.taxonomy', 'product_cat')
     ->where('terms.term_group','0')
     ->where('terms.status',1)
     ->select('term_taxonomy.*', 'terms.name', 'terms.status')
     ->get();
     @endphp
     @foreach($tags as $tag)
     <div class="nav-item dropdown">
      <a class="nav-link dropdown-toggle pt-0" data-toggle="dropdown" style="color: black">
       {{strtoupper($tag->name)}}
     </a>
     @php 
     $child1 = DB::table('term_taxonomy')
     ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
     ->where('term_taxonomy.taxonomy', 'product_cat')
     ->where('terms.term_group',$tag->term_id)
     ->where('terms.status',1)
     ->select('term_taxonomy.*', 'terms.name', 'terms.status')
     ->get();
     @endphp
     <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      @foreach($child1 as $child)                    
      <div class="dropdown-submenu">
        <a class="dropdown-item dropdown-toggle" href="#">{{$child->name}}</a>
        @php 
        $child2 = DB::table('term_taxonomy')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->where('term_taxonomy.taxonomy', 'product_cat')
        ->where('terms.term_group',$child->term_id)
        ->where('terms.status',1)
        ->select('term_taxonomy.*', 'terms.name', 'terms.status')
        ->get();
        @endphp
        <div class="dropdown-menu">
         @foreach($child2 as $child3)   
         <div><a class="dropdown-item" href="{{route('category.product',$child3->term_id)}}">{{$child3->name}}</a></div>
         @endforeach           
       </div>
     </div>
     @endforeach
   </div>
 </div>
 @endforeach
</div>      
</nav>
    @guest 
   <div class="all_menu"> 
    <div class="d-flex align-items-center mb-1">
     <a href="{{url('wishlist')}}" class="text-decoration-none text-dark"> <img width="20px" height="20px" src="{{asset('backend/heart1.png')}}"><span> Wish list </span></a>
   </div>

   <div class="d-flex align-items-center mb-1">
    <a href="{{url('cart')}}" class="text-decoration-none text-dark" style="margin-left: -3px;"> <img width="23px" height="23px" src="{{asset('backend/bag.png')}}"><span> Shopping Bag </span></a> 
  </div>

  <div class="d-flex align-items-center mb-1"> 
   <a href="{{url('faq')}}" class="text-decoration-none text-dark"> <i class="fa fa-question-circle"></i><span> FAQ </span> </a>
 </div>

 <div class="d-flex align-items-center mb-1">
   <a href="{{url('customer-support')}}" class="text-decoration-none text-dark"> <i class="demo fa fa-users" aria-hidden="true"></i><span> Customer Support </span></a>
 </div>

 <div class="d-flex align-items-center mb-1">
  <a href="{{url('privacy')}}" class="text-decoration-none text-dark"><i class="fas fa-user-secret"></i><span> Privacy Policy </span></a> 
</div>
 <div class="d-flex align-items-center mb-1">
  <a href="{{route('terms.conditions')}}" class="text-decoration-none text-dark"><i class="fab fa-teamspeak"></i><span> Terms & Conditions </span></a> 
</div>
 <div class="d-flex align-items-center mb-1">
  <a href="{{route('return.policy')}}" class="text-decoration-none text-dark"><i class="fas fa-undo"></i><span> Return Policy </span></a> 
</div>

<div class="d-flex align-items-center mb-1 payment"> 
  <i style="font-size: 30px;" class="far fa-money-bill-alt ml-1 mr-1"></i>
  <img src="{{asset('assets/front/payment/bkash.jpg')}}" style="vertical-align: top;" width="35px" height="25px">
  <i style="font-size: 30px;" class="fab fa-cc-visa ml-1"></i>
  <i style="font-size: 30px;" class="fab fa-cc-mastercard mr-2 ml-1"></i>
</div>

<div class="d-flex align-items-center mb-1">
 Follow us on: <a target="_blank" href="https://www.facebook.com/bigshotstyle/"><i class="fab fa-facebook-f ml-1"></i></a>
</div>
</div>

@else 

 <a href="{{url('profile')}}">
  <div style="background: red; color:#000000">
   <div class="float-left mb-2">
     @php 
     $img=DB::table('usermeta')
     ->where('user_id',auth()->user()->id)
     ->where('meta_key','user_image')
     ->first(); 
     @endphp
     @if(isset($img))
     <!-- <img  src="{{asset('assets/front/user/'.$img->meta_value)}}" style="border-radius: 30%;height: 19px;"> -->
     <img width="35px" height="35px" src="{{asset('backend/user.png')}}" class="mr-1">
     @else
     <!-- <img src="{{asset('assets/front/user/user.png')}}" style="border-radius: 50%;height: 27px;"> -->
      <img width="35px" height="35px" src="{{asset('backend/user.png')}}" class="mr-1">
     @endif
     {{auth()->user()->name}}
   </div>
   <div  class="float-right mb-2 mr-2">
    View Profile    
    <i class="fas fa-chevron-right"></i>
  </div>
</div>
</a>


<div class="all_menu">
<div class="d-flex align-items-center mb-1">
 <a href="{{url('wishlist')}}" class="text-decoration-none text-dark"> <img width="20px" height="20px" src="{{asset('backend/heart1.png')}}"><span> Wish list</span></a>
</div>

<div class="d-flex align-items-center mb-1">
  <a href="{{url('cart')}}" class="text-decoration-none text-dark" style="margin-left: -3px;"> <img  width="23px" height="23px" src="{{asset('backend/bag.png')}}"><span> Shopping Bag </span></a> 
</div>

<div class="d-flex align-items-center mb-1">
 <a href="{{url('order-list')}}" class="text-decoration-none text-dark"> <i style="color:#000000" class="fa fa-sticky-note"></i> <span> Order list</span> </a>
</div>

<div class="d-flex align-items-center mb-1"> 
 <a href="{{url('faq')}}" class="text-decoration-none text-dark"> <i class="fa fa-question-circle"></i><span> FAQ </span> </a>
</div>

<div class="d-flex align-items-center mb-1">
 <a href="{{url('customer-support')}}" class="text-decoration-none text-dark"> <i class="demo fa fa-users" aria-hidden="true"></i><span> Customer Support </span></a>
</div>


 <div class="d-flex align-items-center pt-1 pb-2">
  <a href="{{url('privacy')}}" class="text-decoration-none text-dark"><i class="fas fa-user-secret"></i><span> Privacy Policy </span></a> 
</div>
 <div class="d-flex align-items-center pt-1 pb-2">
  <a href="{{route('terms.conditions')}}" class="text-decoration-none text-dark"><i class="fab fa-teamspeak"></i><span> Terms & Conditions </span></a> 
</div>
 <div class="d-flex align-items-center pt-1 pb-2">
  <a href="{{route('return.policy')}}" class="text-decoration-none text-dark"><i class="fas fa-undo"></i><span> Return Policy </span></a> 
</div>

<div class="d-flex align-items-center mb-1 payment"> 
  <i style="font-size: 30px;" class="far fa-money-bill-alt ml-1 mr-1"></i>
  <img class="ml-1" src="{{asset('assets/front/payment/bkash.jpg')}}">
  <i style="font-size: 30px;" class="fab fa-cc-visa ml-1"></i>
  <i style="font-size: 30px;" class="fab fa-cc-mastercard ml-1"></i>
</div>

<div class="d-flex align-items-center mb-1">
  Follow us on:<a target="_blank" href="https://www.facebook.com/bigshotstyle/"><i class="fab fa-facebook-f ml-1"></i></a>
</div>

<div class="d-flex align-items-center mb-1">
  <a style="color: #000000;" href="{{ route('logout') }}" onclick="event.preventDefault();
  document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form> 
</div>
</div>
@endguest
</div>
</div>
</nav>
<!-------- display on large ----------->
<div class="d-none d-sm-block">
  <div class="d-flex flex-column ">
    <div class="d-flex justify-content-between ml-5 mr-5 mt-3">
      <div>
        <a href="{{url('/')}}"><img src="{{asset('assets/common/images/logo.png')}}" class="img-fluid mt-2" alt="logo" style="height: 30px;width: 115px"></a>
      </div>
      <div class="d-flex flex-row">
        <div class="d-flex flex-row mt-1" style="margin-right:10px;">
          <form method="get" action="{{url('/search/item')}}">
            <div class=" has-search mt-2">
              <span class="fa fa-search form-control-feedback"></span>
              <input type="text" name="search" class="form-control homeSearchInput" style="width: 75%;float: left" placeholder="What do you want to find?">
              <button style="background:#00B0F0;border:1px solid #00B0F0" class="btn btn-primary homeSearchButton" type="submit">
                Search
              </button>
            </div>
          </form>
        </div>
          @if(Auth::check())
          @php 
          $cart_count=DB::table('user_cart')
          ->where('user_id',auth()->user()->id)
          ->sum('quantity');
          @endphp 
          @else 
          @php $cart_count=\Cart::getTotalQuantity(); @endphp
          @endif
          <div class="d-flex align-items-center"><a href="{{url('cart')}}"> <img  width="25px" height="30px" src="{{asset('backend/bag.png')}}">  
          @if(Auth::check())
            @if($cart_count>0)
             <div class="span1">
              {{ $cart_count}} 
            </div> 
            @endif 
          @else 
            @if($cart_count>0)
             <div class="span">
              {{ $cart_count}} 
             </div> 
            @endif 
          @endif 
        </a> 
      </div>
      <div class="d-flex align-items-center ml-3"><a href="{{url('wishlist')}}"> <img width="25px" height="25px" src="{{asset('backend/heart1.png')}}">
       @if(Auth::check()) 
       @php $wish=DB::table('wishlist')->where('user_id',auth()->user()->id)->count(); @endphp 
       @if($wish>0)
       <span class="span_heart"> {{$wish}} </span> 
       @endif 
       @endif 
     </a>
   </div>
   <div class="d-flex align-items-center">
    @guest
    <a class="ml-4" href="{{ route('login') }}"> <img width="25px" height="25px" src="{{asset('backend/user.png')}}"></a> 
    @else 
    <nav class="navbar navbar-expand-lg fixed-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
              @php
              $img=DB::table('usermeta')
              ->where('user_id',auth()->user()->id)
              ->where('meta_key','user_image')
              ->first();
              @endphp
              @if(isset($img->meta_value)) 
              <!-- <img src="{{asset('assets/front/user/'.$img->meta_value)}}" style="border-radius: 50%; width:20px; height: 20px;"> -->
              <img width="25px" height="25px" src="{{asset('backend/user.png')}}">
              @else 
               <img width="25px" height="25px" src="{{asset('backend/user.png')}}">
              @endif
            </a>

            <div class="dropdown-menu dropdown-large">
              <a class="shadow dropdown-item " style="width: 125px; " href="{{url('profile')}}"><i class="demo fa fa-user ml-1" aria-hidden="true"></i> Profile</a>
              <!-- <a class="shadow-lg dropdown-item" style="width: 125px; " href="{{url('wishlist')}}"><i style="color:#000000"  class="demo fa fa-heart ml-1" aria-hidden="true"></i> Wishlist</a>
              <a class="shadow dropdown-item" style="width: 125px; " href="{{url('cart')}}"><i style="color:#000000" class="fas fa-shopping-bag ml-1"></i>  Cart</a> -->
              <a class="shadow dropdown-item" style="width: 125px; " href="{{url('order-list')}}"><i class="demo fa fa-sticky-note ml-1" aria-hidden="true"></i> Order</a>
              <a class="shadow dropdown-item" style="width: 125px; " href="{{url('customer-support')}}"><i class="demo fa fa-users" aria-hidden="true"></i> Support</a>
              <!-- <a class="shadow dropdown-item" style="width: 125px; " href="{{url('faq')}}"><i class="fa fa-question-circle"></i> FAQ</a> -->
              <a class="shadow dropdown-item" style="width: 125px; " href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    @endguest
  </div>
</div>
</div>
<div class="d-flex flex-row justify-content-between ml-5 mr-5 mt-3 mb-2">
  <div class="d-none">
   @php 
   $tags = DB::table('term_taxonomy')
   ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
   ->where('term_taxonomy.taxonomy', 'product_tag')
   ->where('terms.status',1)
   ->select('term_taxonomy.*', 'terms.name', 'terms.status')
   ->get();
   @endphp
   @foreach($tags as $tag)
   <div class="mr-4"> <a href="{{route('tag.product.show',$tag->term_id)}}" class="text-decoration-none text-dark">{{strtoupper($tag->name)}}</a></div>
   @endforeach
 </div>
 {{-- test drop down --}}
 <div class="d-flex ">
  <nav class="navbar navbar-expand-lg p-0">      
    <div class="navbar-nav mr-auto mt-2 mt-lg-0">     
     @php 
     $tags = DB::table('term_taxonomy')
     ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
     ->where('term_taxonomy.taxonomy', 'product_cat')
     ->where('terms.term_group','0')
     ->where('terms.status',1)
     ->select('term_taxonomy.*', 'terms.name', 'terms.status')
     ->get();
     @endphp
     @foreach($tags as $tag)
     <div class="nav-item dropdown">
      <a class="nav-link dropdown-toggle pt-0" data-toggle="dropdown" >
       {{strtoupper($tag->name)}}
     </a>
     @php 
     $child1 = DB::table('term_taxonomy')
     ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
     ->where('term_taxonomy.taxonomy', 'product_cat')
     ->where('terms.term_group',$tag->term_id)
     ->where('terms.status',1)
     ->select('term_taxonomy.*', 'terms.name', 'terms.status')
     ->get();
     @endphp
     <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      @foreach($child1 as $child)                    
      <div class="dropdown-submenu">
        <a class="dropdown-item dropdown-toggle" href="#">{{$child->name}}</a>
        @php 
        $child2 = DB::table('term_taxonomy')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->where('term_taxonomy.taxonomy', 'product_cat')
        ->where('terms.term_group',$child->term_id)
        ->where('terms.status',1)
        ->select('term_taxonomy.*', 'terms.name', 'terms.status')
        ->get();
        @endphp
        <div class="dropdown-menu">
         @foreach($child2 as $child3)   
         <div><a class="dropdown-item" href="{{route('category.product',$child3->term_id)}}">{{$child3->name}}</a></div>
         @endforeach           
       </div>
     </div>
     @endforeach
   </div>
 </div>
 @endforeach
</div>      
</nav>
</div>

{{-- test drop down --}}
<div class="d-flex col-md-5 justify-content-end p-0">					
  <div> <a href="{{url('faq')}}" class="text-decoration-none text-dark"> FAQ</a></div>
  <div class="ml-2"> <a href="{{url('customer-support')}}" class="text-decoration-none text-dark"> Customer Support</a></div>
  <div class="ml-2"> <a href="{{url('about')}}" class="text-decoration-none text-dark"> About Us</a></div>
</div>
</div>
</div>
</div>
<div class="">
  <div class="" style="height: 1px;background: #C7C7C7"></div>
</div>
</div>
<!-- header part end -->
      