@extends('front.layouts.front_master')
@section('content')
<style>
.mySlides {
    display: none;
}
</style>
@php
$rprice=0;
$sprice=0;
$qty=0;
$image='no-image.png';
foreach ($product->productMeta as $meta):
if($meta['meta_key']=='_regular_price'):
$rprice=$meta['meta_value'];
endif;
if($meta['meta_key']=='sale_price'):
$sprice=$meta['meta_value'];
endif;
if($meta['meta_key']=='qty'):
$qty=$meta['meta_value'];
endif;
if($meta['meta_key']=='default_attribute'):
$metavalue=json_decode($meta['meta_value']);
endif;
if($meta['meta_key']=='attached_file'):
$image=$meta['meta_value'];
endif;
endforeach;
@endphp
<!-- Page Content  -->
<div id="content" class="p-4 p-md-5">
        @if(session('status'))
                            <div class="alert alert-success" role="alert" id="alert">
                                {{ session('status') }}
                            </div>
                            @endif
    <div class="row">
        <div class="col-md-12 ">
         
            <div class="container-fluid">
                <div class="codepen-container">
                    <div class="content-container">
                        <div class="left-container">
                            <div class="triangle-topleft">
                                <div class="back-arrow" id="buy-toaster">
                                    
                                </div>
                            </div>
                            <div class="product-image col-sm-12 col-md-12">
                        
                                <img width="400" height="auto" id="featured" src="{{asset('backend/products/'.$image)}}"
                                    class="img-responsive" alt="Responsive image" />
                                <ul class="product-image--list">
                                    <div class="w3-content w3-section">
                                        @foreach($gallery_images as $g)
                                        <img width="150px" height="150px" class="mySlides"
                                            src="{{asset('backend/products/'.$g->meta_value)}}">
                                        @endforeach
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="right-container col-sm-12">
                        
                            <form action="{{route('addCart')}}" method="POST" id="addCartForm">
                                @csrf
                                <div class="">
                                    <h1 class="title" style="padding: 0 !important;"></h1>
                                    <h2 class="subtitle subtitle-container">{{$product->post_title}}</h2>
                                    @foreach($arributeArray as $a)
                                    @if($a->taxonomy=='pa_color')
                                    Color:{{$a->term}}
                                    @endif
                                    @if($a->taxonomy=='pa_size')
                                    Size:{{$a->term}}
                                    @endif
                                    @endforeach
                                </div>
                                <span>
                                    <p>
                                        <span class="text-dark"> Price: </span>
                                        <span class="emphasize"> tk. {{$sprice}}</span>
                                        <input type="hidden" name="price" value="{{$sprice}}">

                                    </p>
                                    <div class="tm-size-color-single">
                                        <label for="quantity">Quantity:</label>
                                        <div class="quantity buttons_added">
                                            <input type="number" class="input-text qty text" step="1" min="1" max=""
                                                name="quantity" value="1" title="Qty" size="400" inputmode="numeric">
                                        </div>
                                    </div>
                                </span>
                                <div>
                                    <input type="hidden" name="id" value="{{$product->ID}}">
                                    <input type="hidden" name="name" value="{{$product->post_title}}">
                                    <input type="hidden" name="main_qty" value="{{$qty}}">
                                    <table>
                                        <tr>
                                            <th>
                                                <button type="submit" class="my-btn flex-btn">
                                                    <span id="new-board-btn" class="btn-text text-dark"
                                                        style="width: 195px">Buy</span>
                                                </button>
                                            </th>
                                            <th>
                                                <span class="text-dark">
                                                    <a href="{{url('/wishlist/product/'.$product->ID)}}">
                                                        <i class="far fa-heart ml-2 h4"></i>
                                                    </a>
                                                </span>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="container">
                        <nav class="nav nav-tabs nav-justified">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#home">Description</a>
                            <!-- <a class="nav-item nav-link" data-toggle="tab" href="#menu1">Specification</a> -->
                            <a class="nav-item nav-link" data-toggle="tab" href="#menu2">Related</a>
                            <a class="nav-item nav-link disabled" data-toggle="tab" href="#menu3"></a>
                        </nav>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade show active">
                                <p>{!! $product->post_content !!}</p>
                                <p><b>Delivery Guarantee</b> (Delivery Time and Delivery charge # Dhaka Metro 1-3
                                    working
                                    days, charge 60tk # Dhaka suburb area 2-5 working days, charge 100tk # Bangladesh
                                    wide 2-5 working days,
                                    120tk.)
                                </p>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div>
                                    <h2 class="title" style="padding: 0 !important;"></h2>
                                    @if(isset($metavalue))
                                    @foreach($metavalue as $metaInfo)
                                    <div class="tm-size-color-single">
                                        <label>
                                            @php
                                            $result=explode('_',$metaInfo->taxonomy);
                                            @endphp
                                            {{ucfirst(end($result))}}
                                        </label>
                                        <div>
                                            @php
                                            $termsInfo=DB::table('terms')->where('term_id',$metaInfo->term)->first();
                                            @endphp
                                            @if(isset($termsInfo->name)) {{$termsInfo->name}} @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div id="releted">
                                    <section style="margin-left: 120px" class="mt-5">
                                        <ul class="wrapper cf mt-3">
                                            @php
                                            $rprice=0;
                                            $img='';
                                            @endphp
                                            @foreach($product_related as $related)
                                            @php
                                            $product_info=DB::table('postmeta')->where('post_id',$related->ID)->get();
                                            @endphp
                                            @foreach($product_info as $info)
                                            @if($info->meta_key=='regular_price') @php $rprice=$info->meta_value @endphp
                                            @endif
                                            @if($info->meta_key=='attached_file') @php $img=$info->meta_value @endphp
                                            @endif
                                            @endforeach
                                            <li class="product fl-l col-md-2">
                                                <a href="{{url('product/'.$related->ID.'/'.urlencode($related->post_title))}}"> 
                                                    <div class="container-prod">
                                                        <div class="image">
                                                            <img width="100px" height="100px"
                                                                src="{{asset('backend/products/'.$img)}}">
                                                        </div>
                                                        <div class="container-information">
                                                            <div class="title">
                                                                {{$related->post_title}}
                                                                <span class="text-dark ml-5">৳{{$rprice}}</span>
                                                                </p>
                                                                <a href="#" class="more close">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="buttons cf"><span style="margin-left: 3px;font-size: 12px;"><span class="add ml-2">20,000+ bought this</span></span></div> -->
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        {{$product_related->links()}}
                                    </section>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {
        myIndex = 1
    }
    x[myIndex - 1].style.display = "block";
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
@endsection