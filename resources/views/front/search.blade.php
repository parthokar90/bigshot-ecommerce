@extends('front.layouts.front_master')
@section('title') Bigshot | Home @endsection 
@section('content')
<style>
    .dropbtn {
        color: #000000;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }
    .dropdown-content a:hover {background-color: #ddd;}
    .dropdown:hover .dropdown-content {display: block;}

    .badge { 
        position: relative;
        top: -7px;
        left: -8px;
        border: 1px solid red;
        border-radius: 20%;
        background: red;
        color: #ffffff;
    } 

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
       height: 33px
   }
   .product-title{
    /*font-size: calc(0.5vw + 0.7vh);*/
}

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
<div class="container-fluid p-0">
     @if($products->isEmpty()) <h4 class="text-center" style="color:red">No Product Found</h4> @endif 
 <!-- body part start -->	
 <div class="container mb-3 p-0">
    <div class="d-flex flex-column">
       @include('front.includes.banner')	
        <div class="d-flex flex-wrap mt-3 poductDiv">
         @php
         $rprice=0;
         $sprice=0;
         $image='';
         @endphp
         @foreach($products as $item)
         @foreach ($item->productMeta as $meta)
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
         <div class="col-6 col-md-3 mt-2 ml-0 pl-0">
            <a style=" text-decoration: none;" href="{{url('product/'.$item->ID.'/'.urlencode($item->post_title))}}">
                <div class="card">
                    <img src="{{asset('backend/products/'.$image)}}"  class="rounded img-fluid" style="" alt="...">
                    <div class="text-center">
                        <span style="color:#000000" class="card-text product-title">{{$item->post_title}}</span>
                        <p class="card-text"> @if($rprice) <del style="color:red">৳{{$rprice}}</del> @endif <span style="color:#000000">৳{{$sprice}}</span></p>
                    </div>
                </div>
            </a>
        </div>  
        @endforeach
    </div>
</div>
</div>
<!-- body part end -->
</div>
@endsection 