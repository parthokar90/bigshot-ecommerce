<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
table, td, th {
  border: 1px solid black;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
</head>
<body>


                    <div style="height: 50px" class="font-weight-bold text-center">
                        All Order
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <table class="table table-striped">
                                <tr>
                                    <td>Order #</td>
                                    <td>{{$order->ID}}</td>
                                </tr>
                                <tr>
                                    <td>Payment via</td>
                                    <td> 
                                        @foreach ($order_info as $meta)
                                        @if($meta->meta_key=='payment_method')
                                       {{$meta->meta_value }}
                                       @endif
                                       @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Date created</td>
                                    <td> {{$order->post_date}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Status</td>
                                    <td>{{$order->post_status}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Customer</td>
                                    <td>{{$name->meta_value}} {{$lname->meta_value}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Phone</td>
                                    <td>{{$phone->meta_value}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Shipping</td>
                                    <td>City:{{$city->meta_value}}</td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <div class="card-body d-flex justify-content-between flex-row ">
                            <table class="table table-striped">
                            </table>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-body d-flex flex-column ">
                            <div>
                                <table class="table table-striped" style="width:100%">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total_order_taka=0;
                                        $subtotal=0;
                                        $qty=0;
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
                                        if($value->meta_key=='_line_total'){
                                        $total=$value->meta_value;
                                        }
                                         if($value->meta_key=='attribute_parent'){
                                        $att=$value->meta_value;
                                        }
                                        @endphp
                                        @endforeach
                                        <tr style="text-align: center;">
                                            <th>{{++$key}}</th>
                                            <td>{{$items->order_item_name}} 
                                              <table class="table">
                                                <tbody>
                                                    @php 
                                                        $list_att=DB::table('postmeta')->where('post_id',$att)
                                                        ->where('meta_key','attribute')->get(); 
                                                    @endphp
                                                    @foreach($list_att as $a)
                                                    @php $data_att=json_decode($a->meta_value); @endphp 
                                                        @foreach($data_att as $da)
                                                            <tr>
                                                            <td>{{ucfirst($da->taxonomy)}}</td>
                                                            <td>{{ucfirst($da->term)}}</td>
                                                            </tr>
                                                        @endforeach 
                                                    @endforeach 
                                                </tbody>
                                                </table>
                                            </td>
                                            <td>@php $price=DB::table('postmeta')->where('post_id',$items->product_parent)
                                            ->where('meta_key','sale_price')->first(); 
                                            @endphp @if(isset($price)) @php $p_price=$price->meta_value; @endphp @else @php $p_price=0; @endphp @endif {{number_format($p_price)}} tk</td>
                                            <td>{{$qty}}</td>
                                            <td>{{number_format($qty*$p_price)}} tk @php $total_order_taka+=$qty*$p_price; @endphp</td>
                                        </tr>
                                        @endforeach
                                     
                                        @if(isset($deliverycharge)) @php $charge=$deliverycharge->meta_value; @endphp @else @php $charge=0; @endphp  @endif 
                                        @if(isset($coupon)) @php $c=$coupon->meta_value; @endphp @else @php $c=0; @endphp  @endif  
                                       
                                    </tbody>
                                       <h4> Total Order: {{number_format($total_order_taka+$charge-$c)}} tk</h4>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
 

</body>

</html>