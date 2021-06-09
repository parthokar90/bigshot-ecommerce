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
        <p class="text-center h3"><u>Delivery Invoice</u></p>
       
    
        <p class="text-center h3">BiGshot Clothing</p>
        <p class="text-center">House 15/1,Road 4,Block A,Section 10,Mirpur,Dhaka.</p>
        <p class="text-center">Mobile:0000000000000</p>
    </div>
    <div class="container-fluid juti" style="float: left;padding-left: 0;padding-right: 0">
        <div class="col1">
            <p>Invoice Number: {{trim($order->ID)}} </p>
            <p>Delivery Company Name:@if(isset($deliverycompany)) {{trim($deliverycompany->post_content_filtered)}} @endif </p>
        </div>
        <div class="col2">
            <p style="text-align: right;margin-top: 27px"> Date: {{date('d-m-Y')}}</p>
        </div>
    </div>
    <br>
    <br>
    <br>
    
    <div style="">
        <table style="width:100%;border:0.5px solid #BFBFBF;" class="table">
            <tr style="background: #BFBFBF; font-size:12px">
                <th>Order id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Items</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
            <tbody>
                @php
                $subtotal=0;
                $qty=0;
                $total_qty=0;
                $total=0;
                $grandTotal=0;
                $grandLinetotal=0;
                $total_sub=0;
                $att=0;
                @endphp
                @foreach($products as $key=>$items)
                @foreach($items->orderMeta as $value)
                @php
                if($value->meta_key=='_line_subtotal'){
                $subtotal=$value->meta_value;
            }
            if($value->meta_key=='_qty'){
            $qty=$value->meta_value;
        }
        if($value->meta_key=='attribute_parent'){
        $att=$value->meta_value;
    }
    if($value->meta_key=='_line_total'){
    $total=$value->meta_value;
}
@endphp
@endforeach
<tr style="font-size:10px">
    <th>{{$order->ID}}</th>
    <th>{{$name->meta_value}} {{$lname->meta_value}}<br>{{$phone->meta_value}}</th>
    <th>{{$address->meta_value}}</th>
    <td>
        {{$items->order_item_name}}
        @php 
        $list_att=DB::table('postmeta')->where('post_id',$att)
        ->where('meta_key','attribute')->get(); 
        @endphp
        @foreach($list_att as $a)
        @php $data_att=json_decode($a->meta_value); @endphp 
        @foreach($data_att as $da)
        {{ucfirst($da->term)}}
        @endforeach 
        @endforeach 
    </td>
    <td>{{$qty}} pcs</td>
    <td>{{number_format($subtotal)}} tk</td>
</tr>
@php
$grandTotal+=$subtotal;
$grandLinetotal+=$total;
$total_qty+=$qty;
@endphp
@endforeach
@if(isset($deliverycharge)) @php $charge=$deliverycharge->meta_value; @endphp @else @php $charge=0; @endphp  @endif 
@if(isset($c)) @php $coupon=$c->meta_value; @endphp @else @php $coupon=0; @endphp  @endif 
</tbody>
<tfoot>
    <tr>
        <td style="font-size:9px;font-weight:bold" colspan="1">Total Parcel</td>
        <td style="font-size:12px" colspan="1">{{$order_total_item}} </td>

        <td style="font-size:12px;font-weight:bold" colspan="2">Total</td>
        <td>{{$total_qty}} pcs</td>
        <td>{{number_format($grandTotal+$charge-$coupon)}} tk</td>
    </tr>
</tfoot>


</table>

</div>

<div class="col1" >
    <p> <u>Receiver</u></p>
    <p>Signature:</p>
    <p>Name:</p>
</div>



</body>
</html>