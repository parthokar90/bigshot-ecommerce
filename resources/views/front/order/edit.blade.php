@extends('front.layouts.front_master')
@section('content')
<!-- div start -->
<div class="container">
 <div style="border:1px solid #000000">
  <h2 class="text-center">INVOICE</h2>
  <div class="row">
   <!-- order placed test start -->
   @php $order_amount=0; $after_total=0; $sub=0; $total_order_qty=0; $total_order_amount=0; $name=''; $address='';  $payment_method=''; $qtty=0; $phone=''; @endphp
   @foreach($order_info as $info)
   @if($info->meta_key=='first_name') @php $name=$info->meta_value; @endphp @endif
   @if($info->meta_key=='address_one') @php $address=$info->meta_value; @endphp @endif
   @if($info->meta_key=='payment_method') @php $payment_method=$info->meta_value; @endphp @endif
   @if($info->meta_key=='phone') @php $phone=$info->meta_value; @endphp @endif
   @endforeach
   <div class="col-md-6 ml-2">
     <span class="font-weight-bold">Oder placed: {{date('d-M-Y',strtotime($order->post_date))}}</span><br>
     <span class="font-weight-bold">Order Number: {{$order->ID}}</span>
   </div>
   <div class="col-md-6"></div>
   <!-- order placed test end -->

   <!-- ship to div start -->
   <div class="col-md-6 ml-2 mt-3">
     <h2>Ship To</h2>
     <hr>
     <span>{{$name}}</span><br>
     <span>{{$address}}</span><br>
     <span>{{ucfirst($dist->meta_value)}},{{ucfirst($city->meta_value)}},</span><br>
     <span>{{$zip->meta_value}}</span>
   </div>
   <div class="col-md-6"></div>
   <!-- ship to div  end -->

   <!-- payment method start -->
   <div class="col-md-6 ml-2 mt-3">
     <h5>Payment Method: @if($payment_method=='') Cash @else {{ucfirst($payment_method)}} @endif</h5>
   </div>
   <div class="col-md-6"></div>
   <!-- payment method end -->

   <!-- Items in order div start  -->
   <div class="col-md-12 mt-3">
     <div class="font-weight-bold" style="background:#C0C4C8;margin: 0px 6px;font-size:20px;padding:2px;"> Items in Order</div>
   </div>
   <!-- Items in order div end -->


   <div class="col-sm-12">
    <table class="table ">
      <tr>
        <th>Pic</th>
        <th>Item</th>
        <th>Qty</th>
        <th>Price</th>
      </tr>

      @foreach($products as $item)
      <tr>
        <td>
          @php 
          $d_img=DB::table('postmeta')
          ->where('post_id',$item->product_id) 
          ->where('meta_key','attached_file')
          ->first(); 
          $d_sku=DB::table('postmeta')
          ->where('post_id',$item->product_id) 
          ->where('meta_key','_sku')
          ->first();
          @endphp
          @if(isset($d_img))
          <img width="40px" height="40px" src="{{asset('backend/products/'.$d_img->meta_value)}}">
          @endif 

          @php 
          $a_img=DB::table('posts')
          ->where('ID',$item->product_id) 
          ->where('meta_key','attached_file')
          ->join('postmeta','postmeta.post_id','=','posts.post_parent')
          ->first(); 
          $a_sku=DB::table('posts')
          ->where('ID',$item->product_id) 
          ->where('meta_key','_sku')
          ->join('postmeta','postmeta.post_id','=','posts.post_parent')
          ->first(); 
          @endphp
          @if(isset($a_img))
          <img width="50px" height="50px" src="{{asset('backend/products/'.$a_img->meta_value)}}">
          @endif
          <br>

          @if(isset($d_sku))
          <span class="ml-2">{{$d_sku->meta_value}}</span>
          @endif


          @if(isset($a_sku))
          <span class="ml-2"> {{$a_sku->meta_value}}</span>
          @endif
        </td>
        <td>
          {{$item->order_item_name}}<br>
          @php 
          $list_att=DB::table('postmeta')->where('post_id',$item->product_id)
          ->where('meta_key','attribute')->get(); 
          @endphp
          @foreach($list_att as $a)
          @php $data_att=json_decode($a->meta_value); @endphp 
          @foreach($data_att as $da)
          <span style="font-size:15px">  {{ucfirst($da->term)}} </span>
          @endforeach 
          @endforeach 
        </td>
        <td>
          <!-- quantity -->
          @foreach($item->orderMeta as $meta)
          @if($meta->meta_key=='cancel_quantity')
          @php $cancel_qty=$meta->meta_value; @endphp
          @endif 
          @if($meta->meta_key=='_qty')
          {{$meta->meta_value}} pcs
          @endif
          @endforeach 
          <!-- quantity -->
        </td>
        <td>
          <!-- price -->
          @foreach($item->orderMeta as $meta)
          @if($meta->meta_key=='_qty')
          @php $qtty=$meta->meta_value; @endphp
          @endif
          @endforeach 
          @php
          $pro_default=DB::table('postmeta')
          ->where('post_id',$item->product_id) 
          ->where('meta_key','sale_price')
          ->first();  
          $pro_att=DB::table('posts')
          ->where('ID',$item->product_id) 
          ->where('meta_key','sale_price')
          ->join('postmeta','postmeta.post_id','=','posts.post_parent')
          ->first();  
          @endphp
          @if(isset($pro_default)) 
          {{ number_format($pprice=$qtty*$pro_default->meta_value)}} tk
          @endif

          @if(isset($pro_att)) 
          {{ number_format($pprice=$qtty*$pro_att->meta_value)}} tk
          @endif
          @php $total_order_qty+=$qtty; @endphp
          @php $total_order_amount+=$pprice; $sub+=$pprice;  @endphp
          <!-- price -->
        </td>
      </tr>
      @endforeach

      <tr>
        <td colspan="2">Sub Total</td>

        <td>{{$total_order_qty}} pcs</td>
        <td> {{number_format($sub)}} tk</td>
      </tr>
      <tr>
        <td colspan="3"> Delivery Charge</td>


        <td>
          (+)
          @php $delivery_charge=DB::table('order_itemmeta')
          ->where('order_id',$order->ID) 
          ->where('meta_key','delivery_charge') 
          ->first();
          @endphp
          @if(isset($delivery_charge)) 
          {{number_format($d_charge=$delivery_charge->meta_value)}} tk
          @else 
          {{$d_charge=0}} tk
          @endif 
        </td>
      </tr>

      <tr>
        <td colspan="3">Discount</td>


        <td>

        (-) {{number_format($c_taka=$c)}} tk

       </td>
     </tr>
     <tr>
      <td colspan="3">Order Total</td>

           @php $total_sub=$sub+$d_charge; @endphp
      <td>{{$after_total=number_format($total_sub-$c_taka)}} tk</td>
    </tr>

  </table>
</div>
<!-- subtotal div  end -->
</div>
</div>
 <div class="text-center mt-2 mb-5"><a class="btn btn-success btn-sm" href="{{route('customer_invoice_download',$order->ID)}}"><i class="fa fa-download"></i> Download Invoice</a> <a class="btn btn-success btn-sm" href="{{route('order-list.index')}}"><i class="fas fa-arrow-right"></i> Back to list</a></div>
</div>
<!-- div end -->
@endsection