@extends('front.layouts.front_master')
@section('content')

<div class="container p-0">
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
                <div class="btn btn-success mr-2 btn-block mt-0 ">View Bag</div> 
                <div class="btn btn-outline-info mr-2 btn-block mt-0 disabled ">Shipping</div> 
                <div class="btn btn-outline-dark mr-2 btn-block mt-0 disabled ">Review</div>
                <div class="btn btn-outline-primary btn-block mt-0 disabled ">Payment</div>
            </div>

      
            <div class="btn-lg btn-block">
                Items In Bag
                <hr>
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
                <div class="col-md-3 col-3">
                    <h6 class="product-name"><strong>{{$item->name}} </strong></h6><small>
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
                        {{$j_value->taxonomy}} - {{$j_value->term}} 
                        @endforeach 
                        @endif
                    </small>
                </div>
                <div class="col-md-2 col-2">
                   @if(Auth::check())
                   <strong>{{number_format($total=$item->actual_price)}} <span class="text-muted">tk</span></strong>
                   @else 
                   <strong>{{number_format($total=$item->price)}} <span class="text-muted">tk</span></strong>
                   @endif
               </div>
               <div class="col-md-4 col-7">

                <form id="cart_up" class="up" method="POST"
                action="{{route('cart.update')}}" name="Updatequantity">
                @csrf
                <input type="hidden" name="product_id[]" value="{{$item->id}}">
                <div class="col-md-12 col-12 d-flex">

                    <div class=" col-md-5 p-0">                                          
                        @for($i=1;$i<$item->quantity;$i++) @endfor
                        <input type="number" 
                        class="input-text quantity_text form-control "
                        min="1" max="" name="quantity[]"
                        value="{{$i}}" onblur="jsSubmit()" title="quantity" style="min-width: 60px" size="4">
                    </div>   

                    <div class="col-md-5" style="font-size: 14px">
                        @if(Auth::check())

                        <strong>{{number_format($total=$item->actual_price*$item->quantity)}} <span class="text-muted">tk</span>
                        </strong>
                        @else 
                        <strong>{{number_format($total=$item->price*$item->quantity)}} <span class="text-muted">tk</span></strong>
                        @endif
                    </div>

                    <div class="col-md-3">
                        <a onclick="return confirm('are you sure??')"
                        href="{{url('/remove/'.$item->id)}}">
                        <div class="btn btn-outline-danger btn-xs" style="margin-top:1px !important">
                            <i class="far fa-times-circle"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <hr>
    @php $total_qtyyy+=$item->quantity; @endphp
    @endforeach
    
</form>
<a href="{{route('shipping')}}" class="btn btn-info float-right mt-2" id="first_next">Shipping <i class="fas fa-arrow-right"></i></a>                      


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
    <div>Total Order: </div>
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
    function jsSubmit(){
        $('#cart_up').submit();
    }
</script>
@endsection