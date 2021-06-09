@extends('front.layouts.front_master')

@section('content')


<!-- Page Content  -->
<div id="content" class="p-4 p-md-5">
    <div class="row">
      <div class="col-md-10 ">
       <div class="container-fluid">

          <section style="margin-left: 120px" class="">

           

              <ul class="wrapper cf mt-3">
                @php
                $rprice=0;
                $sprice=0;
                $image='';
                @endphp
                @foreach($products as $item)
                   @foreach($item->productMeta as $meta)
                      @if($meta['meta_key']=='regular_price')
                        @php                            
                        $rprice=$meta['meta_value'];
                        @endphp
                      @endif

                      @if($meta['meta_key']=='sale_price')
                        @php                            
                        $sprice=$meta['meta_value'];
                        @endphp
                      @endif

                       @if($meta['meta_key']=='attached_file')
                        @php                            
                        $image=$meta['meta_value'];
                        @endphp
                       @endif
                      @endforeach
              
                  <li class="product fl-l">
                    <a href="{{route('product-page',$item->ID)}}">
                      <div class="container-prod">
                        <div class="image" style="background-image:url({{asset('backend/products/'.$image)}});"></div>
                        <div class="container-information">
                          <div class="title">
                            <p> {{$item->post_title}}
                            <span class="text-dark ml-1">৳{{$sprice}}</span></p>
                                              
                          </div>
                      </div>

                      <div class="buttons cf">
                        <!-- <span style="margin-left: 3px;font-size: 12px;">
                          <span class="add ml-2">20,000+ bought this</span>
                      </span> -->

                  </div>
              </div>
                    </a>
          </li>
@endforeach
         
</ul>

</section>

</div>
</div>
<div class="col-md-2 col-sm-12" style="background-color: #fff;position: fixed;
right: 10px;top:96px;">
<div class="img-box mt-3">
    <img src="{{asset('assets/front/images/offer.png')}}" height="200" width="210">
</div>          
<p class="text-justify mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

<!-- <form>
  <div class="form-group">
      <div class="input-group"> <input type="text" class="form-control coupon" name="" value="xyz3gd"> <span class="input-group-append"> <button class="btn btn-light btn-apply coupon">Copy</button> </span> </div>
  </div>
</form> -->

</div>
</div>
</div>
</div>

@endsection