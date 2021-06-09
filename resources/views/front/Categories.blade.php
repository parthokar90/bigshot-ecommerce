@extends('front.layouts.front_master')
@section('content')
<!-- Page Content  -->
<div id="content" class="p-4 p-md-5">
	<div class="row">
		<div class="col-md-10 ">
			<div class="container-fluid">
				<section style="margin-left: 120px" class="mt-5">
          @if($data->count()>0)
						<ul class="wrapper cf mt-3">
                @php
                $rprice=0;
                $img='';
                @endphp
                @foreach($data as $item)
                @php $product_info=DB::table('postmeta')->where('post_id',$item->ID)->get(); @endphp  
                @foreach($product_info as $info) 
                   @if($info->meta_key=='regular_price') @php $rprice=$info->meta_value @endphp @endif 
                   @if($info->meta_key=='attached_file') @php $img=$info->meta_value @endphp @endif 
                @endforeach
                    <li class="product fl-l">
                      <a href="">
                        <div class="container-prod">
                          <div class="image" style="background-image:url({{asset('backend/products/'.$img)}})"></div>
                          <div class="container-information">
                            <div class="title">
                               {{$item->post_title}} <span class="text-dark ml-5">৳{{$rprice}}</span></p>
                              <a href="#" class="more close">
                                <i class="fa fa-times"></i>
                              </a>
                            </div>
                          </div>
                          <div class="buttons cf">
                          </div>
                        </div>
                      </a>
                    </li>
              @endforeach
            </ul>
            {{$data->links()}}
              @else 
              <h1 class="text-center"><span style="color:red">No Product Found</span></h1>
            @endif 
					</section>
				</div>
			</div>
			<div class="col-md-2 col-sm-12" style="background-color: #fff;position: fixed;
right: 10px;top:96px;">
				<div class="img-box mt-3">
					<img src="{{asset('assets/front/images/offer.png')}}" height="200" width="210">
					</div>
					<p class="text-justify mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					<!-- <form><div class="form-group"><div class="input-group"><input type="text" class="form-control coupon" name="" value="xyz3gd"><span class="input-group-append"><button class="btn btn-light btn-apply coupon">Copy</button></span></div></div></form> -->
				</div>
			</div>
		</div>
	</div>

@endsection