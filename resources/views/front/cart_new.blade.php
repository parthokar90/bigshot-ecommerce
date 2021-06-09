@extends('front.layouts.front_master')
@section('content')
<style>
li {
    list-style: none;
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
@endphp @if(Auth::check()) @php $name=auth()->user()->name;
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
<div id="content" class="p-4 p-md-5">
    @if(Cart::getTotalquantity()>0)
    <div class="row">
        <div class="col-md-12 ">
            <div class="container-fluid mt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            @include('admin.includes.messages')
                            <nav id="myTab" class="nav nav-tabs nav-justified"><a class="nav-item nav-link active"
                                    data-toggle="tab" href="#home">SHIP TO</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#menu2">REVIEW ORDER</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#menu1">PAYMENT</a>
                                <a class="nav-item nav-link disabled" data-toggle="tab" href="#menu3"></a>
                            </nav>
                            <form role="form" action="{{route('checkout')}}" method="POST">
                                @csrf
                                <div class="tab-content">
                                    <div id="home" class="tab-pane active">
                                        <h5 style="padding: 5px 5px;"><b>SHIP TO</b></h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="firstName">First name<span
                                                        class="requiredField">*</span></label>
                                                @if($name=='') @php @endphp @php $name='Guest'; @endphp @endif
                                                <input type="text" class="form-control" id="firstName" value="{{$name}}"
                                                    name="first_name" placeholder="First Name">
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="lastName">Last name<span
                                                        class="requiredField">*</span></label>
                                                @if($l_name=='') @php @endphp @php $l_name='Guest'; @endphp @endif
                                                <input type="text" class="form-control" id="lastName"
                                                    value="{{$l_name}}" name="last_name" placeholder="Last Name">
                                                <div class="invalid-feedback">
                                                    Valid last name is required.
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="address">Address<span class="requiredField">*</span></label>
                                                @if($address1=='') @php @endphp @php $address1='Uttara,Dhaka'; @endphp
                                                @endif
                                                <input type="text" class="form-control" id="address"
                                                    value="{{$address1}}" name="address_one" placeholder="Address">
                                                <div class="invalid-feedback">
                                                    Please enter your shipping address.
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @if($phone=='') @php @endphp @php $phone='0000000001'; @endphp @endif
                                                <label for="phone">Mobile Number<span
                                                        class="requiredField">*</span></label>
                                                <input type="text" class="form-control" value="{{$phone}}" name="phone"
                                                    id="phone" placeholder="Mobile Number">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @if($email=='') @php @endphp @php $email='guest@email.com'; @endphp
                                                @endif
                                                <label for="phone">Email<span class="requiredField">*</span></label>
                                                <input type="text" class="form-control" value="{{$email}}" name="email"
                                                    id="email" placeholder="Email">
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
                                                    <option value="{{$dist->term_id}}" @if($dist->term_id == $dist_rict)
                                                        selected='selected' @endif>{{ $dist->district }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Zip code required.
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="city">City/Thana<span class="requiredField">*</span></label>
                                                @if($city=='')
                                                <select class="form-control" id="city" name="city">
                                                    <option value="">Select District First</option>
                                                </select>
                                                @else
                                                @php
                                                $data=DB::table('term_taxonomy')->where(['taxonomy'=>'city','parent'=>$dist_rict])
                                                ->join('terms','terms.term_id','=','term_taxonomy.term_id')
                                                ->select('terms.name as city_name','terms.term_id')
                                                ->first();
                                                @endphp
                                                <select class="form-control" id="city" name="city">
                                                    <option value="{{$data->term_id}}">{{$data->city_name}}</option>
                                                </select>
                                                @endif
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="zip">Postcode</label>
                                                @if($city=='')
                                                <input type="text" class="form-control" value="" name="zip" id="zip"
                                                    placeholder="Postcode">
                                                @else
                                                @php
                                                $posts_codes = DB::table('term_taxonomy')->where(['taxonomy' =>
                                                'postcode','parent'=>$city])
                                                ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
                                                ->select('terms.name as zip')
                                                ->first();
                                                @endphp
                                                <input type="text" class="form-control" value="{{$posts_codes->zip}}"
                                                    name="zip" id="zip" placeholder="Postcode">
                                                @endif
                                                <div class="invalid-feedback">
                                                    Zip code required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="menu1" class="tab-pane fade">
                                        <h5 style="background: #e7e7e7;padding:10px 4px;"><b>CHOSE PAYMENT OPTION</b>
                                        </h5>
                                        <div class="form-group">
                                            <select name="paymentMethod" id="payment_option" class="form-control">
                                                <option value="">Chose Option</option>
                                                <option value="FullPayment">Full Payment {{Cart::getTotal()}}</option>
                                                <option value="DeliveryChargeOnly">Delivery Charge Only</option>
                                                <option value="CashOnDelivery">Cash On Delivery</option>
                                            </select>
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
                                        <button type="submit" class="btn btn-primary btn-block btn-lg">Place
                                            Order</button>
                            </form>
                        </div>



                        <div id="menu2" class="tab-pane fade">
                            <div class="btn btn-primary btn-lg btn-block">
                                Items In Cart
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $order=0; @endphp
                                        @foreach ($info as $item)
                                        @php
                                        $order++;
                                        $image='no-image.png';
                                        $images=DB::table('postmeta')
                                        ->where('post_id',$item->id)
                                        ->where('meta_key','attachment')
                                        ->first();
                                        if($images>0):
                                        $image= $images->meta_value;
                                        endif;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{$order}}</th>
                                            <td>
                                                @php
                                                $image=DB::table('postmeta')->where(['post_id'=>$item->id,'meta_key'=>'attached_file'])->select('meta_value')->first();
                                                @endphp
                                                <img width="100px" height="100px"
                                                    src="{{asset('backend/products/'.$image->meta_value)}}"
                                                    class="img-thumbnail" alt="Responsive image" />
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$total=$item->price}}</td>
                                            <td>
                                                <form class="up" method="POST" action="{{route('cart.update')}}"
                                                    name="Updatequantity">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$item->id}}">
                                                    <div class="quantity buttons_added" style="padding: 0;">
                                                        <!--  <input type="button" value="-" class="minus"> -->
                                                        <input type="number" id=""
                                                            class="input-text quantity_text form-control" step="1"
                                                            min="1" max="" name="quantity" onkeyup="submitForm()"
                                                            value="{{$item->quantity}}" title="quantity" size="4"
                                                            inputmode="numeric">
                                                        <!-- <input type="button" value="+" class="plus"> -->
                                                        <!-- <input type="submit" value="" class="plus"> -->

                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('are you sure??')"
                                                    href="{{url('/remove/'.$item->id)}}">
                                                    <div class="buttons" style="margin-top:1px !important">
                                                        <span class="btn btn-danger delete-btn"></span>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <small class="text-muted">Quantity Total</small>
                                        </div>
                                        <span class="text-muted"> {{ Cart::getTotalquantity()}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <small class="text-muted">Order Total</small>
                                        </div>
                                        <span class="text-muted">{{Cart::getTotal()}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                        <div class="text-success">
                                            <small>*Approx</small>
                                        </div>
                                        <span class="text-muted">৳ {{Cart::getTotal()}} BDT</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex flex-column">
                    <h5 style="background: #e7e7e7;padding:10px 4px;"><b>TOTAL: ৳{{Cart::getTotal()}} BDT</b></h5>
                    </br></br>
                    <div class="row">
                        @php $order=0; @endphp
                        @foreach ($info as $item)
                        @php
                        $order++;
                        $image='no-image.png';
                        $images=DB::table('postmeta')
                        ->where('post_id',$item->id)
                        ->where('meta_key','attachment')
                        ->first();
                        if($images>0):
                        $image= $images->meta_value;
                        endif;
                        @endphp
                        <div class="col-md-3">
                            @php
                            $image=DB::table('postmeta')->where(['post_id'=>$item->id,'meta_key'=>'attached_file'])->select('meta_value')->first();
                            @endphp
                            <img width="100%" height="100px" src="{{asset('backend/products/'.$image->meta_value)}}"
                                class="img-thumbnail" alt="image" />
                        </div>
                        <div class="col-md-9">
                            <ul>
                                <li>Item:{{$item->name}}</li>
                                <li>Price:৳{{$total=$item->price}}</li>
                                <li>Quantity:{{$item->quantity}}</li>
                                <li>Total:৳{{$total=$item->price*$item->quantity}}</li>
                            </ul>
                            <hr>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <h1 class="text-center">Opp's You have no product in your shopping cart</h1>
    <div class="text-center"><a href="{{url('/')}}"><span style="color:orange;fornt-size:14px;">SHOP NOW</span></a>
    </div>
    @endif

</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
</script>

<script>
$("#payment_option").change(function() {
    var value = $("#payment_option").val();
    if (value == 'FullPayment') {
        $("#payment_div").show();
    } else if (value == 'DeliveryChargeOnly') {

    } else {
        $("#payment_div").hide();
    }
});
$("#state").change(function() {
    var district_id = $("#state").val();
    $.ajax({
        url: "{{url('/district/city/')}}" + '/' + district_id,
        type: "GET",
        success: function(response) {
            var items = "";
            items += "<option value=''>Select City</option>";
            $.each(response, function(i, item) {

                items += "<option value='" + item.term_id + "'>" + (item
                        .city_name) +
                    "</option>";
            });
            $("#city").html(items);
        },
        error: function(response) {
            console.log(response);
        },
    });
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

$(document).ready(function() {
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>
@endsection