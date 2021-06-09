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
    <p>Invoice Number: inv-{{($invoiceNumber)}} </p>
    <p>Delivery Company Name: {{$company_name}} </p>
  </div>
  <div class="col2">
    <p style="text-align: right;margin-top: 27px;float: right;"> Date: {{date('d-m-Y')}}</p>
  </div>
</div>


<br>
<br>
<br>


<table class="table table-striped">
  <thead>
    <tr>
      <th class="center">Order id</th>
      <th>Cust.Info</th>
      <th class="text-center">Items</th>                 
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
    <tr>
      <td class="left">{{$item->ID}} <input type="hidden" name="order[]" value="{{$item->ID}}"></td>
      <td class="left">{{$first_name}} {{$last_name}}<br>{{$address}} <br>{{$mobile_no}}</td>
      <td class="left">
        @foreach($item->orderItem as $meta)
      
        <table style="width:100%" class="text-center">

          <tr class="text-center">
            <td >{{$meta->order_item_name}}</td>
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
      <td class="left">
       @php $qty=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','_qty')->sum('meta_value'); 
       $tqty +=$qty;
       @endphp 
       {{$qty}}
     </td>

     @php $total_order=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','_line_subtotal')->sum('meta_value');

     $line_total=$total_order+$charge-$c;
$grandTotal += $line_total;
      @endphp 
     <td class="left">{{number_format($line_total)}} tk</td>
   </tr>
   @endforeach 
 </tbody>
 <tfoot>
  <tr>
    <td>Total Parcel</td>
    <td style="font-size:12px" >{{$orders->count()}} </td>

    <td style="font-size:12px;font-weight:bold" >Total</td>
    <td>{{$tqty}} pcs</td>
    <td>{{number_format($grandTotal)}} tk</td>
  </tr>
</tfoot>

</table>


<div class="col1">
  <p>Receiver:</p>
  <p>Signature:</p>
  <p>Name:</p>
</div>
</body>
</html>