@extends('front.layouts.front_master')
@section('content')

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
                <div class="btn btn-outline-info mr-2 btn-block mt-0 disabled ">Shipping</div> 
                <div class="btn btn-outline-dark mr-2 btn-block mt-0 disabled">Review</div>
                <div class="btn btn-primary btn-block mt-0  ">Payment</div>
            </div>

            <form  action="{{route('saveOrder')}}" method="POST">
               @csrf
               <h5 style="background: #e7e7e7;padding:10px 4px;" class="mt-2"><b>CHOSE PAYMENT OPTION</b>
               </h5>
               <span id="payment_msg" style="color: red;"></span>
               <div class="form-group">


                <div id="payment_option">
                    <input id="FullPayment" type="radio" name="paymentMethod" value="FullPayment">
                    @php
                    if(session('dicount_amount')){
                        $discount=session('dicount_amount');
                    }else{
                        $discount=0;
                    }

                    @endphp

                    <label for="FullPayment">Full Payment </label> ( {{number_format(Cart::getTotal()-$discount+$dc)}} ) tk <br>

                    <input id="DeliveryChargeOnly" type="radio" name="paymentMethod" value="DeliveryChargeOnly">
                    <label for="DeliveryChargeOnly">Delivery Charge Only</label> ( {{$dc}} ) tk<br>

                    <input id="CashOnDelivery" type="radio" name="paymentMethod" name="payment_mode"
                    value="CashOnDelivery">
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


            <div class="d-flex justify-content-between">
                <a href="{{route('review')}}" class="btn btn-warning float-right mt-2" id="first_next"><i class="fas fa-arrow-left"></i> Review </a>                      

                <button type="submit" class="btn btn-info float-right mt-2" id="first_next">Place Order <i class="fas fa-arrow-right"></i></button>                 
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
                    <div>@if(Auth::check()) {{number_format($item->actual_price*$item->quantity)}} tk  @else {{number_format($item->price*$item->quantity)}} @endif tk</div>

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
    $('input:radio').on('click', function(e) {
        var value =e.currentTarget.value;
        if (value == 'FullPayment' || value=='DeliveryChargeOnly') {
            $("#payment_div").show();
        } else if (value == 'DeliveryChargeOnly') {

        } else {
            $("#payment_div").hide();
        }
    });
    
</script>
@endsection