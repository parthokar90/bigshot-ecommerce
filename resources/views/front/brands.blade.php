@extends('front.layouts.front_master')

@section('content')



<!-- Page Content  -->
<div id="content" class="p-4 p-md-5">
  <div class="row">
    <div class="col-md-10 ">
      <div class="container-fluid">
        <section style="margin-left: 120px" class="">
          <img src="{{asset('assets/front/images/add.png')}}" width="1267" class="img-fluid" alt="Responsive image">
          <ul class="wrapper cf mt-3">
            @foreach($brands as $item)
            <li class="product fl-l">
              <a href="#">
                  @if($item->image)
                  <img src="{{asset('assets/admin/brand/'.$item->image)}}"  class="img-fluid" alt="Responsive image">
                  @endif
              <div class="title">
                      <p> {{$item->name}}</p>
             </div>
              </a>
            </li>
            @endforeach
          </ul>
          {{$brands->links()}}
        </section>

      </div>
    </div>
    <div class="col-md-2 col-sm-12" style="background-color: #fff;position: fixed;
right: 10px;top:96px;">
      <div class="img-box mt-3">
        <img src="{{asset('assets/front/images/offer.png')}}" height="200" width="210">
      </div>
      <p class="text-justify mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
      <!-- <form><div class="form-group"><div class="input-group"><input type="text" class="form-control coupon" name="" value="xyz3gd"><span class="input-group-append"><button class="btn btn-light btn-apply coupon">Copy</button></span></div></div></form> -->
    </div>
  </div>
</div>
</div>

@endsection