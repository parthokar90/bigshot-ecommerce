@extends('front.layouts.front_master')
@section('content')
<style>
    li {
        list-style: none;
    }
    .nav-tabs {
        border-bottom: 0px solid #dee2e6; 
    }
    * {
        margin: 0;
        padding: 0;
    }

    .loader {
        display: none; 
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
    }

    .loading {
        border: 2px solid #ccc;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border-top-color: #1ecd97;
        border-left-color: #1ecd97;
        animation: spin 1s infinite ease-in;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    .overlay {
        background-color:#EFEFEF;
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 1000;
        top: 0px;
        left: 0px;
        opacity: .5; /* in FireFox */ 
        filter: alpha(opacity=50); /* in IE */
    }

    @media (max-width: 767px) {

        .poductDiv{
            padding: 0px !important;     
        }
    }
    .nav a{
        font-size: 14px;    
        padding: 10px 0px;
        text-align: center;
    }
</style>
@php $l_name='';
$address1='';
$address2='';
$phone='';
$country='';
$dist_rict='';
$city='';
$zip='';
$name='';
$email='';
@endphp 
@if(Auth::check()) 
@php $name=auth()->user()->name;
$email=auth()->user()->email;
@endphp @endif @foreach($user_info as $in) @if($in->meta_key=='address_one') @php $address1=$in->meta_value;
@endphp @endif @if($in->meta_key=='last_name') @php $l_name=$in->meta_value;
@endphp @endif @if($in->meta_key=='address_two') @php $address2=$in->meta_value;
@endphp @endif @if($in->meta_key=='phone') @php $phone=$in->meta_value;
@endphp @endif @if($in->meta_key=='country') @php $country=$in->meta_value;
@endphp @endif @if($in->meta_key=='district') @php $dist_rict=$in->meta_value;
@endphp @endif @if($in->meta_key=='city') @php $city=$in->meta_value;
@endphp @endif @if($in->meta_key=='zip') @php $zip=$in->meta_value;
@endphp @endif @endforeach
<div id="" class="container p-0">
           @if ($errors->any())
       <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
       </div>
       @endif
    @if(Auth::check())
    @php
    $cart_user_count=DB::table('user_cart')
    ->where('user_id',auth()->user()->id)
    ->sum('quantity'); 
    @endphp 
    @else 
    @php $cart_user_count=Cart::getTotalquantity(); @endphp
    @endif
    @if($cart_user_count>0)
    <div class="d-flex flex-row mt-2 flex-wrap  mb-3">
        <div class="col-md-8 col-12 p-0 mb-3 poductDiv">
            <nav id="myTab" class="nav nav-tabs nav-justified">
                <a class="nav-item nav-link btn btn-success active mr-2 " data-toggle="tab" href="#menu2">View Bag</a>
                <a class="nav-item nav-link btn btn-info mr-2 "
                   data-toggle="tab" href="#home">Shipping</a> 

                <a class="nav-item nav-link btn btn-info mr-2 "
                   data-toggle="tab" href="#view">Review</a>

                <a class="nav-item nav-link btn btn-primary " data-toggle="tab" href="#menu1">Payment</a>

            </nav>
            <form id="check_out_form" role="form" action="{{route('checkout')}}" method="POST">
                @csrf
                <div class="tab-content">
                    <div id="home" class="tab-pane fade">
                     
                        <h5 style="padding: 5px 5px;"><b>SHIP TO</b></h5>
                        <span id="message" style="color: red;"></span>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name<span
                                        class="requiredField">*</span></label>
                              
                                       @if(Auth::check()) 
                                         @if($name=='') @php @endphp @php $name='Guest'; @endphp @endif
                                <input type="text" class="form-control" id="firstName" value="{{$name}}"
                                       name="first_name" placeholder="First Name" readonly>
                                       @else
                                        
                                <input type="text" class="form-control" id="firstName" 
                                       name="first_name" placeholder="First Name" >
                                       @endif
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name<span
                                        class="requiredField">*</span></label>

                                          @if(Auth::check()) 

                                            @if($l_name=='') @php @endphp @php $l_name='Guest'; @endphp @endif
                                <input type="text" class="form-control" id="lastName"
                                       value="{{$l_name}}" name="last_name" placeholder="Last Name" readonly>

                                          @else 

                                           
                                <input type="text" class="form-control" id="lastName"
                                       name="last_name" placeholder="Last Name" >
                                          @endif
                              
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="address">Address<span class="requiredField">*</span></label>

                                @if(Auth::check()) 
                                  @php 
                                    $address1=$address2; 
                                  @endphp  
                                  
                                @endif
                                @if($address1=='') @php @endphp @php $address1='Uttara,Dhaka'; @endphp
                                @endif

                                <textarea class="form-control" id="address"
                                     name="address_one" placeholder="Address">{{$address1}}</textarea>


                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                @if($phone=='')@php @endphp @php  $phone=''; @endphp @endif
                                <label for="phone">Mobile Number<span
                                        class="requiredField">*</span></label>
                                <input type="text" class="form-control" value="{{$phone}}" name="phone"
                                       id="phone" placeholder="Mobile Number" required>
                            </div>



                            <div class="col-md-6 mb-3">
                                  @if(Auth::check()) 
                                     @if($email=='') @php @endphp @php $email='guest@email.com'; @endphp
                                @endif
                                <label for="phone">Email<span class="requiredField">*</span></label>
                                <input type="text" class="form-control" value="{{$email}}" name="email"
                                       id="email" placeholder="Email" readonly>
                                   @else 
                                    
                                <label for="phone">Email<span class="requiredField">*</span></label>
                                <input type="text" class="form-control"  name="email"
                                       id="email" placeholder="Email" >
                                  @endif 
                             
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="country">Country<span class="requiredField">*</span></label>
                                <input type="text" class="form-control" value="Bangladesh"
                                       name="country" placeholder="Country" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">District <span class="requiredField">*</span></label>
                                <select class="form-control" name="state" id="state">
                                    <option value="">Select District</option>
                                    @foreach($district as $dist)
                                    <option value="{{$dist->term_id}}">{{ $dist->district }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="city">City/Thana<span class="requiredField">*</span></label>
                                <select class="form-control" id="city" name="city">
                                    <option value="">Select District First</option>
                                </select>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip">Postcode</label>
                                <input type="text" class="form-control" value="" name="zip" id="zip"
                                       placeholder="Postcode" readonly>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success float-left" id="back_btn"><i class="fas fa-arrow-left"></i> Back </button>
                        <button type="button" class="btn btn-success float-right" id="first_view_btn">Next <i class="fas fa-arrow-right"></i></button>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h5 style="background: #e7e7e7;padding:10px 4px;" class="mt-2"><b>CHOSE PAYMENT OPTION</b>
                        </h5>
                        <span id="payment_msg" style="color: red;"></span>
                        <div class="form-group">
                            <div id="payment_option">
                                <input id="FullPayment" type="radio" name="paymentMethod" value="FullPayment">
                                <label for="FullPayment">Full Payment </label> ( <span id="cart_get_payment_sidebar1"></span> ) tk <br>
                                <input id="DeliveryChargeOnly" type="radio" name="paymentMethod" value="DeliveryChargeOnly">
                                <label for="DeliveryChargeOnly">Delivery Charge Only</label> ( <span id="de_charge_only"></span> ) tk<br>
                                <input id="CashOnDelivery" type="radio" name="paymentMethod" name="payment_mode"
                                       value="Cash On Delivery">
                                <label for="CashOnDelivery">Cash On Delivery</label>
                            </div>
                        </div>
                        <div id="payment_div" style="display: none;">
                            <h5 style="background: #e7e7e7;padding:10px 4px;"><b>PAYMENT METHOD</b></h5>
                            <div class="form-group">
                                <select id="payment_mode" class="form-control">
                                    <option value="bkash">Bkash</option>
                                    <option value="visa">Visa</option>
                                    <option value="master">Master</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="coupon_taka" name="coupon_taka" value="">
                        <button type="submit" id="order_submit" class="btn btn-primary btn-block btn-lg">Place
                            Order</button>
                        </form>
                    </div>
                 <!-- item list div -->
                    <div id="menu2" class="tab-pane active">
                     <p style="margin-top: 10px;"> Items In Bag</p>  
                        @php $total_qtyyy=0; @endphp
                        @foreach ($info as $item)
                             @php 
                               $image=DB::table('posts')
                               ->where('ID',$item->id) 
                               ->where('meta_key','attached_file') 
                               ->join('postmeta','postmeta.post_id','=','posts.post_parent')
                               ->select('meta_value')
                               ->first();
                                $d_image=DB::table('postmeta')
                                ->where('post_id',$item->id) 
                                ->where('meta_key','attached_file') 
                                ->select('meta_value')
                                ->first();
                            @endphp
                            @if(isset($image)) 
                            @php $img=$image->meta_value; @endphp
                            @endif
                            @if(isset($d_image)) 
                            @php $img=$d_image->meta_value; @endphp
                            @endif
                            <div class="d-flex flex-wrap mt-3 mb-4">
                                <div class="col-md-2 col-2" style="padding: 0px;">
                                  <img src="{{asset('backend/products/'.$img)}}"
                                    width="45px" height="45px" alt="Responsive image" />
                                </div>
                                <div class="col-md-2 col-2" style="padding: 0px;">
                                  {{$item->name}}
                                   @php 
							        $att_name=DB::table('postmeta')
                                    ->where('post_id',$item->id)
                                    ->where('meta_key','attribute')
                                    ->select('meta_value')
                                    ->first();
                                    @endphp
                                    @if(isset($att_name)) 
                                    @php $j_decode=json_decode($att_name->meta_value);  @endphp
                                    @foreach($j_decode as $j_value) 
                                    <span style="font-size:13px"> {{$j_value->term}}</span> 
                                    @endforeach 
                                    @endif
                                </div>
                                <div class="col-md-2 col-2">
                                 @if(Auth::check())
                                    {{number_format($total=$item->actual_price)}} tk 
                                    @else 
                                    {{number_format($total=$item->price)}} tk  
                                  @endif
                                </div>
                                <div class="col-md-4 col-4">
                                  <form id="cart_up" class="up" method="POST"
                                      action="{{route('cart.update')}}" name="Updatequantity">
                                    @csrf
                                 <input type="hidden" name="product_id[]" value="{{$item->id}}">  
                                    @for($i=1;$i<$item->quantity;$i++) @endfor
                                    <input type="number" id="cart_qty_data"
                                                   class="input-text quantity_text form-control " step="1"
                                                   min="1" max="" name="quantity[]"
                                                   value="{{$i}}" title="quantity" style="min-width: 60px" size="4"
                                                   inputmode="numeric" autocomplete="off"> 
                                </div>
                                <div class="col-md-1 col-1">
                                  @if(Auth::check())
                                    {{number_format($total=$item->actual_price*$item->quantity)}} tk
                                     @else 
                                    {{number_format($total=$item->price*$item->quantity)}} tk
                                   @endif
                                </div>
                                <div class="col-md-1 col-1"><a onclick="return confirm('are you sure??')"
                                               href="{{url('/remove/'.$item->id)}}"><i style="color:red" class="fa fa-times"></i></a></div>
                            </div> 
                         @php $total_qtyyy+=$item->quantity; @endphp
                         @endforeach 
                             <button style="background: #6FA8DC;" type="submit" class="btn btn-success btn-sm float-right">Update Bag</button>
                        </form> 

                    <button style="width:100%;background:#3C78D8;" type="button" class="btn btn-info mt-2" id="first_next">Proceed To Checkout</button>               
                    </div>
                    <!-- item list div end -->
                    
                    <!--start view menu-->
                    
                      <div id="view" class="tab-pane">
                        <div class="btn-lg btn-block">
                            Items In Bag
                          
                        </div>
                        @php $total_qtyyy=0; @endphp
                        @foreach ($info as $item)
                        @php 
                        $image=DB::table('posts')
                        ->where('ID',$item->id) 
                        ->where('meta_key','attached_file') 
                        ->join('postmeta','postmeta.post_id','=','posts.post_parent')
                        ->select('meta_value')
                        ->first();
                        $d_image=DB::table('postmeta')
                        ->where('post_id',$item->id) 
                        ->where('meta_key','attached_file') 
                        ->select('meta_value')
                        ->first();
                        @endphp
                        @if(isset($image)) 
                        @php $img=$image->meta_value; @endphp
                        @endif
                        @if(isset($d_image)) 
                        @php $img=$d_image->meta_value; @endphp
                        @endif
                        <div class="row">
                            <div class="col-md-2 col-2">
                                <img 
                                    src="{{asset('backend/products/'.$img)}}"
                                    class="img-thumbnail" alt="Responsive image" />
                            </div>
                            <div class="col-md-4 col-4">
                                <h6 class="product-name"><strong>{{$item->name}} </strong></h6><small>
                                    @php $att_name=DB::table('postmeta')
                                    ->where('post_id',$item->id)
                                    ->where('meta_key','attribute')
                                    ->select('meta_value')
                                    ->first();
                                    @endphp
                                    @if(isset($att_name)) 
                                    @php $j_decode=json_decode($att_name->meta_value);  @endphp
                                    @foreach($j_decode as $j_value) 
                                    {{$j_value->taxonomy}} - {{$j_value->term}} 
                                    @endforeach 
                                    @endif
                                </small>
                            </div>

                            <div class="col-md-6 col-6">
                                <div class="col-md-12 d-flex">
                                    @if(Auth::check())

                                    <strong>{{number_format($total=$item->actual_price*$item->quantity)}} <span class="text-muted">tk</span></strong>
                                    @else 
                                    <strong>{{number_format($total=$item->price*$item->quantity)}} <span class="text-muted">tk</span></strong>
                                    @endif
                                </div>
                                <form id="cart_up" class="up" method="POST"
                                      action="{{route('cart.update')}}" name="Updatequantity">
                                    @csrf
                                    <input type="hidden" name="product_id[]" value="{{$item->id}}">
                                    <div class="col-md-12 col-12 d-flex">

                                        <div class="d-flex">   
                                           @if(Auth::check())                                
                                            @for($i=1;$i<$item->quantity;$i++) @endfor                                            
                                            {{$i}} x {{number_format($item->actual_price)}}
                                            @else 
                                              @for($i=1;$i<$item->quantity;$i++) @endfor                                            
                                            {{$i}} x {{number_format($item->price)}}
                                            @endif 
                                        </div>    
                                    
                                    </div>
                            </div>


                        </div>
           
                        @php $total_qtyyy+=$item->quantity; @endphp
                        @endforeach
                        
                        </form>
                      
          
                        <div class="d-flex justify-content-center font-weight-bold mb-2">
                            Order Summary
                        </div>
                         
            


                          <ul class="list-group mb-3">
                             <li class="list-group-item d-flex justify-content-between lh-condensed">
                                 <div class="float-left">
                                     <input autocomplete="off" id="promo_code" type="text"  name="promo_code" class="form-control" placeholder="Enter Promo Code">  
                                 </div>
                                <button id="apply_promo_code" type="button" class="btn btn-primary">Apply</button>
                             </li>

                             <input type="hidden" id="d_c" value="">
                             
                               <li class="list-group-item d-flex justify-content-between lh-condensed">
                                   <p class="float-left">Item Total:</p>
                                   <p class="float-right">{{$total_qtyyy}} pcs tk   <spn id="dis_div_another"></span></p>
                               </li> 
                               
                              <li class="list-group-item d-flex justify-content-between lh-condensed">
                                   <p class="float-left">Delivery Charge:</p>
                                   <p class="float-right">tk <span id="delivery_charge_div"></span></p>
                                   <input type="hidden" name="" id="delivery_charge">
                               </li> 

                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                   <p class="float-left">Discount:</p>
                                   <p class="float-right">tk <span id="dis_div"></span>(-) </p>
                               </li>  

                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                   <p class="float-left">Order Total:</p>
                                   <p class="float-right"> tk <span id="dis_div_another_one"></span></p>
                               </li>  


                       
                               </ul> 
                               <button type="button" class="btn btn-info btn-block" id="second_btn_checkout">Next</button> 
                           </div>
                    <!--End view Menu-->
                    
                    
                    
                    
                    
                    
                    <div class="loader">
                        <div class="loading">
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-4 d-flex flex-column col-12 poductDiv">

            <div class="text-center bg-info btn text-white font-weight-bold"> Item list </div>
            </br></br>
            <div class="">
                @php $order=0;  @endphp
                @foreach ($info as $item)
                @php
                $order++;
                @endphp
                @php 
                $image=DB::table('posts')
                ->where('ID',$item->id) 
                ->where('meta_key','attached_file') 
                ->join('postmeta','postmeta.post_id','=','posts.post_parent')
                ->select('meta_value')
                ->first();
                $d_image=DB::table('postmeta')
                ->where('post_id',$item->id) 
                ->where('meta_key','attached_file') 
                ->select('meta_value')
                ->first();
                @endphp
                @if(isset($image)) 
                @php $imgg=$image->meta_value; @endphp
                @endif
                @if(isset($d_image)) 
                @php $imgg=$d_image->meta_value;
                @endphp
                @endif
                <div class="col-md-12 p-0 col-12">
                    <div class="d-flex justify-content-between item-align-center mt-2">
                        <div class="d-flex flex-column text-center">
                            <div>
                                <img src="{{asset('backend/products/'.$imgg)}}"
                                     class="img-thumbnail" alt="image" style="width: 100px;height: 100px" />
                            </div>
                            <div> {{$item->name}}</div>  
                        </div>
                        <div>@if(Auth::check()) {{number_format($total=$item->actual_price)}} tk @else {{number_format($total=$item->price)}} @endif</div>
                        <div> x </div>
                        <div>{{$item->quantity}} </div>
                        <div> = </div>
                        <div>@if(Auth::check()) {{number_format($total=$item->actual_price*$item->quantity)}} tk  @else {{number_format($total=$item->price*$item->quantity)}} @endif</div>

                    </div>
                </div>

                @endforeach
                <input type="hidden" id="total_value_discount" value="">
            </div>
            <div class="bg-success btn d-flex justify-content-between pl-2 pr-2 text-white font-weight-bold">
                <div>Total Order: </div>
                <div><span id="cart_get_payment_sidebar"></span> tk</div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-center">Opp's You have no product in your shopping cart</h4>
    <div class="text-center"><a href="{{url('/')}}"><span style="color:#00B0F0;font-size:14px;">SHOP NOW</span></a>
    </div>
</div>
@endif
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
                    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
 </script>
    @include('error_message.message')
<script>
  $(document).ready(function() {
      var nf = new Intl.NumberFormat();
      var total=<?php if(Auth::check()){ echo $totak_price=DB::table('user_cart')->where('user_id',auth()->user()->id)->sum('price');   }  else{  echo Cart::getTotal();  } ?> 
      var item_total=nf.format(total);
      document.getElementById('cart_get_payment_sidebar').innerHTML=item_total
      document.getElementById('dis_div_another').innerHTML=item_total
      document.getElementById('dis_div_another_one').innerHTML=item_total
  });
  function spinner() {
        document.getElementsByClassName("loader")[0].style.display = "block";
  }
//cart update form submit
$("#first_btn").click(function(){
    var dist=$("#state").val();
    var ci=$("#city").val();
    var zi=$("#zip").val();
     if(dist=='' || ci=='' || zi==''){
        var msg="Please Select District,Thana & Postcode"; 
        document.getElementById("message").innerHTML=msg;
        $('#myTab a[href="#home"]').tab('show');
        return false;
     }else{
       $('#myTab a[href="#menu1"]').tab('show');
     } 
});

$("#first_view_btn").click(function(){
    var dist=$("#state").val();
    var ci=$("#city").val();
    var zi=$("#zip").val();
     if(dist=='' || ci=='' || zi==''){
        var msg="Please Select District,Thana & Postcode"; 
        document.getElementById("message").innerHTML=msg;
        $('#myTab a[href="#home"]').tab('show');
        return false;
     }else{
        $('#myTab a[href="#view"]').tab('show');
     } 
});



$("#first_next").click(function(){
  $('#myTab a[href="#home"]').tab('show');
});


$("#second_btn_checkout").click(function(){
  $('#myTab a[href="#menu1"]').tab('show');
});






$("#back_btn").click(function(){
       $('#myTab a[href="#menu2"]').tab('show');
});

$(".two").click(function(){
    var dist=$("#state").val();
    var ci=$("#city").val();
    var zi=$("#zip").val();
     if(dist=='' || ci=='' || zi==''){
        var msg="Please Select District,Thana & Postcode"; 
        document.getElementById("message").innerHTML=msg;
        $('#myTab a[href="#home"]').tab('show');
        return false;
     }else{
       $('#myTab a[href="#menu2"]').tab('show');
     } 
});

$("#first_btn_back").click(function(){
  $('#myTab a[href="#home"]').tab('show');
});
$("#second_btn").click(function(){
  $('#myTab a[href="#home"]').tab('show');
});
//check order submit to some validation
$("#order_submit").click(function(e){
  e.preventDefault();
     var dist=$("#state").val();
    var ci=$("#city").val();
    var zi=$("#zip").val();
    var payment_one=$("#FullPayment").val();
    var payment_two=$("#DeliveryChargeOnly").val();
    var payment_three=$("#CashOnDelivery").val();
     if(dist=='' || ci=='' || zi==''){
         var msg="Please Select District,Thana & Postcode"; 
        document.getElementById("message").innerHTML=msg;
        $('#myTab a[href="#home"]').tab('show');
        return false;
     }
     
     if( $('#FullPayment').is(':checked') ||  $('#DeliveryChargeOnly').is(':checked') || $('#CashOnDelivery').is(':checked') ) {
         $('.loader').show(); 
        $('#check_out_form').delay(200).submit();
         var div= document.createElement("div");
    div.className += "overlay";
    document.body.appendChild(div);
     }else{
          var msg="Please Select Payment Option"; 
          document.getElementById("payment_msg").innerHTML=msg;
     }
});
//radio button click wise div show hide 
$('input:radio').on('click', function(e) {
    var value =e.currentTarget.value;
    if (value == 'FullPayment') {
        $("#payment_div").hide();
    } else if (value == 'DeliveryChargeOnly') {
         $("#payment_div").show();
    } else {
        $("#payment_div").hide();
    }
});
 
$("#city").change(function() {
    var city_id = $("#city").val();
    $.ajax({
        url: "{{url('/district/city/postcode/')}}" + '/' + city_id,
        type: "GET",
        success: function(response) {
            var items = "";
            $.each(response, function(i, item) {
                items += item.zip;
            });
            document.getElementById('zip').value = items;
        },
        error: function(response) {
            console.log(response);
        },
    });
});


//promo code input keyup change ajax call  
$("#apply_promo_code").click(function() { 
    var nfff = new Intl.NumberFormat();
    var tot_amount=$("#d_c").val();
    var codes = $("#promo_code").val(); 
    var delivery_carge=$('#delivery_charge').val();
     var ac_amount=parseInt(tot_amount)+parseInt(delivery_carge);
    if(codes==''){
        document.getElementById('total_value_discount').value=tot_amount;
        document.getElementById('cart_get_payment_sidebar').innerHTML=nfff.format(ac_amount);
        document.getElementById('cart_get_payment_sidebar1').innerHTML=nfff.format(ac_amount);
        return false;
    }else{
   $.ajax({
        url: "{{url('/apply/promocode/ajax/')}}" + '/' + codes,
        type: "GET",
        success: function(response) {
            if(response==0){
               alert('coupon code not exists'); 
               document.getElementById('total_value_discount').value=ac_amount;
               document.getElementById('cart_get_payment_sidebar').innerHTML=nfff.format(ac_amount);
               document.getElementById('cart_get_payment_sidebar1').innerHTML=nfff.format(ac_amount);
               document.getElementById('dis_div_another_one').innerHTML=nfff.format(ac_amount);
               return false;
            }
              var items = ''; 
              $.each(response, function(i, item) {
                var coupon_amount=item.coupon_amount;
                if(item.coupon_type==2){                     
                 coupon_amount=((tot_amount)*(item.coupon_amount))/100;
                }
                document.getElementById('total_value_discount').value=tot_amount-coupon_amount;
                document.getElementById('coupon_taka').value=coupon_amount;
                document.getElementById('dis_div').innerHTML=nfff.format(coupon_amount);
                var acc=parseInt(tot_amount)+ parseInt(delivery_carge)-parseInt(coupon_amount);
                var accs=nfff.format(acc);
                document.getElementById('dis_div_another_one').innerHTML=accs;
                document.getElementById('cart_get_payment_sidebar').innerHTML=accs;
                document.getElementById('cart_get_payment_sidebar1').innerHTML=accs;
            });     
        },
        error: function(response) {
            console.log(response);
        },
    });
    }
});
//end promo code


//state dropdown change ajax call 
$("#state").change(function() {
   var nff = new Intl.NumberFormat();
    var tot_amount=<?php if(Auth::check()){ echo $totak_price=DB::table('user_cart')->where('user_id',auth()->user()->id)->sum('price'); }else{echo Cart::getTotal(); } ?>;
    var item_total=tot_amount;
    var district_id = $("#state").val();
    if(tot_amount==''){

    }
    $.ajax({
        url: "{{url('/district/city/')}}" + '/' + district_id,
        type: "GET",
        success: function(response) {
    
            var items = ""; 
            items += "<option value=''>Select City</option>";
            $.each(response.data, function(i, item) {
                items += "<option value='" + item.term_id + "'>" + (item
                        .city_name) +
                    "</option>";
            });
            $("#city").html(items);

             $.each(response.charge, function(i, item) {
                 if(tot_amount>=response.amount){
                    var result=0;
                 }else{
                   var result=parseInt(item.description) || 0;
                 }
                
                 var tota_amount=parseInt(tot_amount)+parseInt(result);
                 document.getElementById('delivery_charge').value=result;
                 document.getElementById('d_c').value=item_total;
                 document.getElementById('cart_get_payment_sidebar').innerHTML=nff.format(tota_amount);
                 document.getElementById('cart_get_payment_sidebar1').innerHTML=nff.format(tota_amount);
                 document.getElementById('delivery_charge_div').innerHTML=result;
                 document.getElementById('dis_div_another').innerHTML=nff.format(item_total);
                 document.getElementById('dis_div_another_one').innerHTML=nff.format(tota_amount);
                 document.getElementById('de_charge_only').innerHTML=result;

            });
           },
           error: function(response) {
            console.log(response);
           },
        });
   });
//city dropdown change ajax call 
</script>
@endsection