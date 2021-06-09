@extends('front.layouts.front_master')
@section('title') Bigshot | Home @endsection 
@section('content')

<style>
    @media (max-width: 767px) {
      .poductDiv div:nth-child(even){
       padding-right: 0px !important;
       padding-left: 5px !important;
   }
   .poductDiv > div:nth-child(odd){
       padding-right: 5px !important;     
   }
}

</style>
<div class="container p-0 mb-2">
 <div class="d-flex flex-column">
 @include('front.includes.banner')
<div class="d-flex flex-wrap mt-3 poductDiv">
    @if($product->count()>0)
    @php
    $rprice=0;
    $sprice=0;
    $img='';
    @endphp
    @foreach($product as $item)
    @php $product_info=DB::table('postmeta')->where('post_id',$item->ID)->get(); @endphp
    @foreach($product_info as $info)
    @if($info->meta_key=='regular_price') @php $rprice=$info->meta_value @endphp @endif
    @if($info->meta_key=='sale_price') @php $sprice=$info->meta_value @endphp @endif
    @if($info->meta_key=='attached_file') @php $img=$info->meta_value @endphp @endif
    @endforeach
    <div class="col-6 col-md-3 mt-2 ml-0 pl-0">
        <a style=" text-decoration: none;" href="{{url('product/'.$item->ID.'/'.urlencode($item->post_title))}}">
            <div class="card">
                <img src="{{asset('backend/products/'.$img)}}"  class="img-fluid rounded"  alt="...">
                <div class="text-center">
                    <div>{{$item->post_title}}</div>
                    <div>@if($rprice) <del style="color:red">৳{{$rprice}}</del>@endif <span style="color:#000000"> ৳{{$sprice}}</span></div>
                </div>
            </div>
        </a>
    </div>  
    @endforeach
    @else
    <div class="text-center w-100 h3">
        <span style="color:red">No Product Found</span>
    </div>
    @endif
</div>
</div>
</div>
@endsection 