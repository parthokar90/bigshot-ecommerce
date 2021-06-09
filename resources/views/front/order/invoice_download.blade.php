<!DOCTYPE html>
<html>
<head>
<style>
  .order_invoice{
    border: 1px solid black;
    line-height: normal;
    padding-top: 15px;
  }
  *{
    margin: 0px;
    padding: 7px;
  }
  .col-1{
   width: 27.5%;
  }
  .col-2{
  width: 45%;
  }
 .col-3{
  width: 27.5%;
  }
  table{
      margin:0px;
      padding:0px;
  }
</style>
</head>
<body>
  
  <div class="col-1"></div>
   @php $order_amount=0; $after_total=0; $sub=0; $total_order_qty=0; $total_order_amount=0; $name=''; $address='';  $payment_method=''; $qtty=0; $phone=''; @endphp
   @foreach($order_info as $info)
   @if($info->meta_key=='first_name') @php $name=$info->meta_value; @endphp @endif
   @if($info->meta_key=='address_one') @php $address=$info->meta_value; @endphp @endif
   @if($info->meta_key=='payment_method') @php $payment_method=$info->meta_value; @endphp @endif
   @if($info->meta_key=='phone') @php $phone=$info->meta_value; @endphp @endif
   @endforeach

  <div class="order_invoice col-2">
  <span style="font-weight: bold;">Order Placed: {{date('d-m-Y',strtotime($order->post_date))}}</span><br>
  <span style="font-weight: bold;">Order Number: {{$order->ID}}</span><br>
   <u>Ship To:</u><br> 
  <span>{{$name}}<br></span>
  <span>{{ucfirst($city->meta_value)}}<br></span>
  <span>{{ucfirst($dist->meta_value)}},{{$zip->meta_value}}<br></span>
  <span> {{$address}}</span><br>
  <p>Payment Method:  @if($payment_method=='') Cash @else {{ucfirst($payment_method)}} @endif</p>
   <p style="background-color: #D9D9D9; margin-top: 20px; font-weight: bold;">Items in Order</p>
   <table width="100%" style="border-collapse:collapse;" cellspacing="0" cellpadding="0">
    @foreach($products as $item)
    <tr style="font-size:12px;">
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
          <img style="margin-top:10px" width="30px" height="30px" src="{{asset('backend/products/'.$d_img->meta_value)}}">
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
          <img style="margin-top:10px" width="30px" height="30px" src="{{asset('backend/products/'.$a_img->meta_value)}}">
          @endif
        <br>
        <span style="margin-left:5px">
         @if(isset($d_sku))
          {{$d_sku->meta_value}}
          @endif

          @if(isset($a_sku))
          {{$a_sku->meta_value}}
          @endif
        </span>
        
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
                                     {{ucfirst($da->term)}}
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

    <tr style="font-weight: bold; background-color:#D9D9D9;font-size:15px;">
      <td>Sub Total</td>
      <td></td>
      <td>{{$total_order_qty}} pcs</td>
      <td>{{number_format($sub)}} tk</td>
    </tr>
    <tr style="font-weight: bold;font-size:15px;">
      <td>Delivery Charge</td>
      <td></td>
      <td></td>
      <td>
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
     <tr style="font-weight: bold;font-size:15px;">
      <td>Discount</td>
      <td></td>
      <td></td>
      <td>
      {{number_format($c_taka=$c)}} tk
      </td>
    </tr>
    <tr style="font-weight: bold; background-color:#D9D9D9;font-size:15px;">
      <td>Order Total</td>
      <td></td>
      <td></td>
      <td>
         @php $total_sub=$sub+$d_charge; @endphp
        {{$after_total=number_format($total_sub-$c_taka)}} tk
      </td>
    </tr>
  </table>
  </div>

  <div class="col-3"></div>
</body>
</html>
