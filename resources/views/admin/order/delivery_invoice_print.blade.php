<!DOCTYPE html>
<html>
<head>
  <title>Delivery Invoice</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <style>
    .col1{
     width:50%;
     float: left;
   }
   .col2{
    width:50%;
    float: right;
  }
  p {
    margin-bottom: 0.1rem;
  }
  .h3{
    margin-bottom: 0px;
  }

  td{
     border: 0px solid #ffffff!important;
  }
  table{
    padding: 10px 5px !important;
  }
</style>
</head>
<body>
 <div class="container">
  <h1 class="text-center"><u>Delivery Invoice</u></h1>
  <p class="text-center">BiGshot Clothing</p>
  <p class="text-center">House 15/1, Road 4, Block A, Section 10, Mirpur, Dhaka.</p>
  <p class="text-center">Mobile: 0000000000000</p>

</div>

<div class="container-fluid juti" style="float: left;padding-left: 0;padding-right: 0">
  <div class="col1">
    <p>Invoice Number: {{($invoiceNumber)}} </p>
    <p>Delivery Company Name: {{$company_name}} </p>
  </div>
  <div class="col2">
    <p style="text-align: right;margin-top: 27px"> Date: {{date('d-m-Y')}}</p>
  </div>
</div>
<br>
<br>
<br>
<table class="table-bordered" style="width:100%;">
  <thead>
    <tr style="background: #BFBFBF;font-size:16px;padding:15px 0px;">
      <th class="center">Order id</th>
      <th>Name</th>
      <th>Address</th>
      <th style="text-align: center;">Items</th>                 
      <th class="right">Qty</th>
      <th class="right">Amount</th>
    </tr>
  </thead>
  <tbody>
    @php $to_items_parcel=0; $tot_parcel=0; $to_amount_charge=0; $att=0; $q=0;$s=0; $att=0; $total_parcel=0; $product=''; $qty=0; $subtotal=0; $grandTotal=0; $mobile_no=''; $address=''; $sku=''; $customer=''; $first_name=''; $last_name=''; 
    $tqty=0;
    @endphp
    @foreach($orders as $item)
    @foreach($item->productMeta as $info) 
    @if($info->meta_key=='phone')
    @php $mobile_no=$info->meta_value; @endphp
    @endif 
    @if($info->meta_key=='address_one')
    @php $address=$info->meta_value; @endphp
    @endif  
    @if($info->meta_key=='first_name')
    @php $first_name=$info->meta_value; @endphp
    @endif 
    @if($info->meta_key=='last_name')
    @php $last_name=$info->meta_value; @endphp
    @endif 
    @endforeach
    <tr style="background: #ffffff;font-size:12px;">
      <td style="text-align: center;">{{$item->ID}}</td>
      <td class="left"> {{$first_name}} {{$last_name}}</td>
      <td class="left"> {{$address}} </td>
      <td class="left">
        @foreach($item->orderItem as $meta)
        <table style="width:100%" style="text-align: center;">
          <tr>
            <td>
            {{$meta->order_item_name}}
             @foreach($meta->orderMeta as $value)
                       @if($value->meta_key=='attribute_parent')
                       @php $att=$value->meta_value; @endphp
                       @endif 
                       @endforeach
                       @php 
                       $list_att=DB::table('postmeta')->where('post_id',$att)
                       ->where('meta_key','attribute')->get(); 
                       @endphp
                       @foreach($list_att as $a)
                       @php $data_att=json_decode($a->meta_value); @endphp 
                       @foreach($data_att as $da)
                       {{ucfirst($da->taxonomy)}} : {{ucfirst($da->term)}}
                     </br>
                     @endforeach 
              @endforeach 
            </td>
            <td class="text-center">
            @php  $qty=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('product_id',$meta->product_id)->where('meta_key','_qty')->first(); 
            $item_qty=$qty->meta_value;
            @endphp
              {{$item_qty}}
            </td>
          </tr>
        </table>
        @endforeach
      </td>
      <td style="text-align:justify;">
       @php $qty=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','_qty')->sum('meta_value'); 
       $tqty +=$qty;
       @endphp 
       {{$qty}}
     </td>
    @php 
     $delivery=DB::table('order_itemmeta')->where('order_id',$item->ID)
     ->where('meta_key','delivery_charge')->first();
     $coupon=DB::table('order_itemmeta')->where('order_id',$item->ID)
     ->where('meta_key','coupon_taka')->first();   
   @endphp 
   @if(isset($delivery)) 
     @php $charge=$delivery->meta_value; @endphp 
      @else
    @php $charge=0; @endphp
    @endif  
    @if(isset($coupon)) 
     @php $c=$coupon->meta_value; @endphp
    @else
    @php $c=0; @endphp
    @endif 
     @php 
     $total_order=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','_line_subtotal')->sum('meta_value');
     $line_total=$total_order+$charge-$c;
$grandTotal+=$line_total;
      @endphp 
     <td class="left">{{number_format($line_total)}} tk</td>
   </tr>
   @endforeach 
 </tbody>
 <tfoot>
  <tr>
    <td style="font-size:12px;">Total Parcel</td>
    <td style="font-size:12px" >{{$orders->count()}} </td>
    <td style="font-size:12px;font-weight:bold" >Total</td>
    <td></td> 
    <td>{{$tqty}} pcs</td>
    <td>{{number_format($grandTotal)}} tk</td>
  </tr>
</tfoot>
</table>
<div class="col1">
  <p><u>Receiver:</u></p>
  <p>Signature:</p>
  <p>Name:</p>
</div>
</body>
</html>