@extends('front.layouts.front_master')
@section('content')

<?php
$l_name = '';
$address1 = '';
$address2 = '';
$phone = '';
$country = '';
$dist_rict = '';
$city = '';
$zip = '';
$name = '';
$email = '';

if (Auth::check()):
    $name = auth()->user()->name;
    $email = auth()->user()->email;
endif;
foreach ($user_info as $in) {
    if ($in->meta_key == 'address_one'):
        $address1 = $in->meta_value;
    endif;
    if ($in->meta_key == 'last_name'):
        $l_name = $in->meta_value;
    endif;
    if ($in->meta_key == 'address_two'):
        $address2 = $in->meta_value;
    endif;
    if ($in->meta_key == 'phone'):
        $phone = $in->meta_value;
    endif;
    if ($in->meta_key == 'country'):
        $country = $in->meta_value;
    endif;
    if ($in->meta_key == 'district'):
        $dist_rict = $in->meta_value;
    endif;
    if ($in->meta_key == 'city'):
        $city = $in->meta_value;
    endif;
    if ($in->meta_key == 'zip'):
        $zip = $in->meta_value;
    endif;
}

if(session('gust_user_id')):
   $guest=DB::table('users')
   ->where('id',session('gust_user_id'))
   ->first(); 

   $address=DB::table('usermeta')
   ->where('user_id',session('gust_user_id'))
   ->where('meta_key','address1')
   ->first();  

   $phones=DB::table('usermeta')
   ->where('user_id',session('gust_user_id'))
   ->where('meta_key','phone')
   ->first();

    $districts=DB::table('usermeta')
   ->where('user_id',session('gust_user_id'))
   ->where('meta_key','district')
   ->first();  

   $citys=DB::table('usermeta')
   ->where('user_id',session('gust_user_id'))
   ->where('meta_key','city')
   ->first(); 

   $zips=DB::table('usermeta')
   ->where('user_id',session('gust_user_id'))
   ->where('meta_key','zip')
   ->first(); 

   $thana = DB::table('term_taxonomy')->where(['taxonomy' => 'city', 'parent' => $districts->meta_value])
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->select('terms.name as city_name', 'terms.term_id')
        ->get();     

   $address1=$address->meta_value;
   $dist_rict=$districts->meta_value;
   $city=$citys->meta_value;
   $zip=$zips->meta_value;

   $phone=$phones->meta_value;
   $l_name =$guest->last_name;
   $name =$guest->name;
   $email =$guest->email;

endif;
?>
<div id="" class="container p-0">
    @if(Auth::check())
    @php
    $cart_user_count=DB::table('user_cart')
    ->where('user_id',auth()->user()->id)
    ->sum('quantity'); 
    @endphp 
    @else 
    @php $cart_user_count=Cart::getTotalquantity();
    @endphp
    @endif
    @if($cart_user_count>0)
    <div class="d-flex flex-row mt-2 flex-wrap  mb-3">
        <div class="col-md-8 col-12 p-0 mb-3 poductDiv">
            @include('admin.includes.messages')
            @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ session('status') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif


            <div class="d-flex justify-content-around">                
                <div class="btn btn-outline-success mr-2 btn-block mt-0 disabled">View Bag</div> 
                <div class="btn btn-info mr-2 btn-block mt-0  ">Shipping</div> 
                <div class="btn btn-outline-dark mr-2 btn-block mt-0 disabled ">Review</div>
                <div class="btn btn-outline-primary btn-block mt-0 disabled ">Payment</div>
            </div>

            <h5 style="padding: 5px 5px;"><b>SHIP TO</b></h5>
            <span id="message" style="color: red;"></span>
            <form id="check_out_form" role="form" action="{{route('shippingInfo')}}" method="POST">
                @csrf
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
                            name="first_name" placeholder="First Name" value="{{$name}}" required>
                            @endif
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name<span
                                class="requiredField">*</span></label>

                                @if(Auth::check()) 

                                @if($l_name=='')@php $l_name='Guest'; @endphp @endif
                                <input type="text" class="form-control" id="lastName"
                                value="{{$l_name}}" name="last_name"  placeholder="Last Name" readonly>

                                @else 


                                <input type="text" class="form-control" id="lastName"
                                name="last_name" value="{{$l_name}}" placeholder="Last Name" required>
                                @endif

                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="address">Address<span class="requiredField">*</span></label>
                                @if($address1=='')  @php $address1=''; @endphp
                                @endif
                                <input type="text" class="form-control" id="address"
                                value="{{$address1}}" name="address_one" placeholder="Address">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                @if($phone=='') @php  $phone=''; @endphp @endif
                                <label for="phone">Mobile Number<span
                                    class="requiredField">*</span></label>
                                    <input type="text" class="form-control" value="{{$phone}}" name="phone"
                                    id="phone" placeholder="Mobile Number" required>
                                </div>



                                <div class="col-md-6 mb-3">
                                    @if(Auth::check()) 
                                    @if($email=='') 
                                    @php $email='guest@email.com';
                                    @endphp
                                    @endif
                                    <label for="phone">Email<span class="requiredField">*</span></label>
                                    <input type="text" class="form-control" value="{{$email}}" name="email"
                                    id="email" placeholder="Email" readonly>
                                    @else 

                                    <label for="phone">Email<span class="requiredField">*</span></label>
                                    <input type="text" class="form-control"  name="email"
                                    id="email"  value="{{$email}}" placeholder="Email" required>
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
                                        <option {{isset($dist_rict) && $dist_rict==$dist->term_id?'selected':''}} value="{{$dist->term_id}}">{{ $dist->district }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="city">City/Thana<span class="requiredField">*</span></label>
                                    <select class="form-control" id="city" name="city">
                                        @if(isset($thana))
                                            @foreach($thana as $value)
                                            <option {{isset($city) && $city==$value->term_id?'selected':''}} value="{{$value->term_id}}">{{$value->city_name}}</option>
                                            @endforeach
                                        @else
                                        <option value="">Select District First</option>
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip">Postcode</label>
                                    <input type="text" class="form-control" value="{{$zip}}" name="zip" id="zip"
                                    placeholder="Postcode" readonly>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-between">
                                <a href="{{route('cart')}}" class="btn btn-warning mt-2 font-weight-bold" id="first_next"><i class="fas fa-arrow-left"></i> View Bag </a>                      

                                <button type="submit" class="btn btn-success mt-2 font-weight-bold" id="first_next">Review <i class="fas fa-arrow-right"></i></button>                      

                            </div>
                        </form>
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
                                <div>@if(Auth::check()) {{$total=$item->actual_price}} tk @else {{$total=$item->price}} @endif</div>
                                <div> x </div>
                                <div>{{$item->quantity}} </div>
                                <div> = </div>
                                <div>@if(Auth::check()) {{number_format($item->actual_price*$item->quantity)}} tk  @else {{number_format($item->price*$item->quantity)}} tk @endif</div>

                            </div>
                        </div>

                        @endforeach
                        <input type="hidden" id="total_value_discount" value="">
                    </div>
                    <div class="bg-success btn d-flex justify-content-between pl-2 pr-2 text-white font-weight-bold">
                        <div>Item Total: </div>
                        <div> {{number_format(Cart::getTotal())}} tk</div>
                    </div>
                </div>
            </div>
            @else
            <h4 class="text-center">Opp's You have no product in your shopping cart</h4>
            <div class="text-center"><a href="{{url('/')}}"><span style="color:orange;fornt-size:14px;">SHOP NOW</span></a>
            </div>
        </div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
</script>
<script>


//state dropdown change ajax call 
$("#state").change(function () {

    var district_id = $("#state").val();

    $.ajax({
        url: "{{url('/district/city/')}}" + '/' + district_id,
        type: "GET",
        success: function (response) {

            var items = "";
            items += "<option value=''>Select City</option>";
            $.each(response.data, function (i, item) {
                items += "<option value='" + item.term_id + "'>" + (item
                    .city_name) +
                "</option>";
            });
            $("#city").html(items);
        },
        error: function (response) {
            console.log(response);
        },
    });
});

$("#city").change(function () {
    var city_id = $("#city").val();
    $.ajax({
        url: "{{url('/district/city/postcode/')}}" + '/' + city_id,
        type: "GET",
        success: function (response) {
            var items = "";
            $.each(response, function (i, item) {
                items += item.zip;
            });
            document.getElementById('zip').value = items;
        },
        error: function (response) {
            console.log(response);
        },
    });
});


</script>
@endsection