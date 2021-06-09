@extends('front.layouts.front_master')
@section('title') Bigshot | 
{{$product->post_title}}
@endsection 
@section('content')
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
if($meta['meta_key']=='default_qty'):
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
<div class="container">
   <div class="d-flex flex-wrap mb-3 pt-5 pb-5" style="border:1px solid #C7C7C7">
     <div class="col-md-2 col-4 mt-4 mb-4" id="im_gallary">
         @foreach($gallery_images as $g)
            <div class="mb-2">
                <img onmouseover="changeImage('{{$g->meta_value}}')" onclick="changeImage('{{$g->meta_value}}')" class="rounded mt-1" src="{{asset('backend/products/'.$g->meta_value)}}" style="width: 100%" alt="">
             </div>
        @endforeach
     </div>
     <div class="col-md-6 col-8 text-center">
       <span style="font-size:20px">{{$product->post_title}}</span>
       <img id="featured" src="{{asset('backend/products/'.$image)}}" width="100%" alt="Responsive image"> 
     </div>

     <div class="col-md-4 col-12 mt-5 mb-2" style="line-height: 50px;">
        TK {{number_format($sprice)}}       <a class="d-lg-none mt-2 float-right" href="{{url('/wishlist/product/'.$product->ID)}}">
                                               <i  class="far fa-heart" style="font-size: 2rem;color: #BD2B88;"></i>
                                            </a>
       <form class="" action="{{route('addCart')}}" method="POST">
         @csrf
         <input type="number" step="1" min="1" max="" name="quantity" class="form-control mt-5 mb-2" id="" value="1" autocomplete="off">
        @if($attributes->count()>0)
            <select name="" id="att_select" class="form-control mt-2 mb-2" required>
                    <option>Select {{ucfirst($attributes[0]->taxonomy)}}</option>  
                    @foreach($attributes as $att)                   
                        <option value="{{$att->id}}">{{$att->term}} </option>
                    @endforeach
            </select>
        @if($count>0)
             <select name="" id="att_value" class="form-control">
                 <option>Select Size</option>
             </select>
        @endif 
        <input type="hidden" id="a_id" name="attribute_id" value="">
        <input type="hidden" name="name" value="{{$product->post_title}}">
        <input type="hidden" name="main_qty" value="{{$qty}}">
        <input type="hidden" name="price" value="{{$sprice}}">
        <input id="proid" type="hidden"  value="{{$product->ID}}">
        @else 
        <input type="hidden" name="id" value="{{$product->ID}}">
        <input type="hidden" name="name" value="{{$product->post_title}}">
        <input type="hidden" name="main_qty" value="{{$qty}}">
        <input type="hidden" name="price" value="{{$sprice}}">
        @endif
        <button style="background:#00B0F0;border:1px solid #00B0F0;width:100%;" type="submit" id="final_cart_submit" class="btn btn-dark btn-large mt-3 mb-3"> Add To Bag </button>
           <a class="d-none d-lg-block mt-3" href="{{url('/wishlist/product/'.$product->ID)}}">
             <i  class="far fa-heart" style="font-size: 2rem;color: #BD2B88;"></i>
          </a>
       </form>
      </div>
           <div class="mt-3 h4 text-justify p-3">Description</div>
                <div class="text-justify p-3">
                    {!! $product->post_content !!}
                    <p>
                        Delivery Guarantee: (Delivery Time and Delivery charge # Dhaka Metro 1-3
                        working
                        days, charge 60tk # Dhaka suburb area 2-5 working days, charge 100tk # Bangladesh
                        wide 2-5 working days,
                        120tk.)
                    </p>
             </div>                       
            </div>
             <div class="mt-3 h4 text-justify p-3">Related Product</div>
           <div class="d-flex flex-wrap">
         
                        @php
                        $rprice=0;
                        $sprice=0;
                        $img='';
                        @endphp
                        @foreach($product_related as $related)
                        @php
                        $product_info=DB::table('postmeta')->where('post_id',$related->ID)->get();
                        @endphp
                        @foreach($product_info as $info)
                        @if($info->meta_key=='regular_price') @php $rprice=$info->meta_value @endphp
                        @endif
                        @if($info->meta_key=='sale_price') @php $sprice=$info->meta_value @endphp
                        @endif
                        @if($info->meta_key=='attached_file')
                        @php $img=$info->meta_value @endphp
                        @endif
                        @endforeach
                        <div class="col-md-3 col-6 p-3">
                          <a href="{{url('product/'.$related->ID.'/'.urlencode($related->post_title))}}">
                             <img src="{{asset('backend/products/'.$img)}}"
                                         class="img-fluid">
                                    <div class="text-center">
                                        <div  style="color:#000000">{{$related->post_title}}</div>
                                        <div class="">@if($rprice)
                                            <del style="color:red">৳{{$rprice}}</del>@endif
                                            <span style="color:#000000"> ৳{{$sprice}}</span>
                                        </div>
                              </div>
                          </a>
                        </div>
                        @endforeach
           </div>
     </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   @include('error_message.message')
  <script>
     function changeImage(imgName) {
        image = document.getElementById('im_gallary');
        var s=image.src = imgName;
        var path="{{asset('/backend/products/')}}"+"/"+s;
        var image1 = document.getElementById('featured');
          if (image1.src.match(path)) {
                image1.src = ss;
            }
            else {
                image1.src = path;
            }
     }
 $("#att_select").on('change', function() {
      var id = $("#att_select").val();
      var proid = $("#proid").val();
      $.ajax({
        type: "GET",
        url: "{{url('att')}}" + "/" + id+"/"+proid,
        dataType: "json",
        success: function(response) {
            if (response!=0){
                 $('#attribut-value').show();
                var schema_one = '';
                $.each(response, function(i, item) { 
                    schema_one += '<option value="' + item.term_id+ '">' + item.term + '</option>';
                    document.getElementById('a_id').value=item.product_parent
                });
                $('#att_value').html(schema_one);

            }else{
           var id = $("#att_select").val();
            var proids = $("#proid").val();
            $.ajax({
                    type: "GET",
                    url: "{{url('only')}}" + "/" + id+"/"+proids,
                    dataType: "json",
                    success: function(response) {
                    var schema_one = '';
                    $.each(response, function(i, item) {
                        document.getElementById('a_id').value=item.product_parent 
                    });
                    },
                    error: function(response) {
                    console.log(response);
                    }
                })
            }
        },
        error: function(response) {
          console.log(response);
        }
      })
    });

     $("#att_value").on('change', function() {
      var id = $("#att_value").val();
            var proidd = $("#proid").val();
      $.ajax({
        type: "GET",
        url: "{{url('atts')}}" + "/" + id+"/"+proidd,
        dataType: "json",
        success: function(response) {
          var schema_one = '';
          $.each(response, function(i, item) {
            document.getElementById('a_id').value=item.product_parent 
          });
        },
        error: function(response) {
          console.log(response);
        }
      })
    });
  </script>
@endsection