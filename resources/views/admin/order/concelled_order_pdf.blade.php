<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-9">
                    <div style="height: 50px" class="font-weight-bold text-center">
                        Delivery Order
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <table class="table table-striped">
                                <!-- <tr>
                                        <td colspan="2" class="text-center font-weight-bold">Print Order</td>
                                    </tr>  -->
                                <tr>
                                    <td>Order #</td>
                                    <td>{{$order->ID}}</td>
                                </tr>

                                <tr>
                                    <td>Payment via</td>
                                    <td>Cash</td>
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
                                    <td class="font-weight-bold">Billing</td>
                                    <td>{{$name->meta_value}}</td>
                                </tr>
                                <!-- 
                                    <tr>
                                        <td class="font-weight-bold">Email Address</td>
                                        <td>akhoart@email.com</td>
                                    </tr> -->

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
                        <!--  <div class="card-header">
                                 <table class="table table-striped">
                                     <tr>
                                         <td colspan="2" class="text-center font-weight-bold">Item Info</td>
                                     </tr> 
                                 </table>
                             </div> -->
                        <div class="card-body d-flex flex-column ">
                            <div>
                                <table class="table table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Cost</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $subtotal=0;
                                        $att=0;
                                        $qty=0;
                                        $total=0;
                                        $grandTotal=0;
                                        $grandLinetotal=0;
                                        $total_sub=0;
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
                                        <tr>
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
                                                                <td>{{strtoupper($da->taxonomy)}}</td>
                                                                <td>{{strtoupper($da->term)}}</td>
                                                                </tr>
                                                            @endforeach 
                                                        @endforeach 
                                                    </tbody>
                                                    </table>  
                                        
                                        
                                        </td>
                                            <td>{{$subtotal}}</td>
                                            <td>{{$qty}}</td>
                                            <td>{{$subtotal}}</td>
                                        </tr>
                                        @php
                                        $grandTotal +=$subtotal;
                                        $grandLinetotal +=$total;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>