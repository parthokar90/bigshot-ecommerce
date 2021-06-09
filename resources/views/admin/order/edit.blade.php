@extends('admin.layouts.master')
@section('content')
<style>
  .pending{
      color:darkblue
    }
    .processing{
       color: lightblue;
    }
    .dispatch{
      color:orange;
    }
    .delivered{
      color:green;
    }
    .cancel{
      color:red;
    }
</style>
<div class="content-wrapper" style="min-height: 1203.6px;" id="app">
    <div class="container-fluid">
        @php $total_items_order_user=0; $total_order_qty=0; $pro_qtyy=0; $check_texonomy=''; $order_sub_total=0; $skuu=''; $address=''; $mobile_no=''; $check_out=''; $customer_ip=''; $shipping_address='';$shipping_city=''; $zip=''; $district='';
         $charge=0;
         @endphp
        @foreach($order_info as $info)
        @if($info->meta_key=='phone')
        @php $mobile_no=$info->meta_value; @endphp
        @endif
        @if($info->meta_key=='address_one')
        @php $address=$info->meta_value; @endphp
        @endif

        @if($info->meta_key=='zip')
        @php $zip=$info->meta_value; @endphp
        @endif

        @if($info->meta_key=='district')
        @php $district=$info->meta_value; @endphp
        @endif

        @if($info->meta_key=='_sku')
        @php $sku=$info->meta_value; @endphp
        @endif
        @if($info->meta_key=='payment_method')
        @php $check_out=$info->meta_value; @endphp
        @endif
        @if($info->meta_key=='_customer_ip_address')
        @php $customer_ip=$info->meta_value; @endphp
        @endif

        @if($info->meta_key=='address_two')
        @php $shipping_address=$info->meta_value; @endphp
        @endif

        @if($info->meta_key=='city')
        @php $shipping_city=$info->meta_value; @endphp
        @endif
        @endforeach
        <div class="row">

            <div class="col-md-4 mt-4">
                <div class="font-weight-bold"><h5 style="font-weight:bold;"><u>ORDER DETAILS</u></h5></div>
                <h3 class="card-title" style="width: 100%">Order Id #{{$id}}</h3>
                <h3 class="card-title">Payment via {{$check_out}}</h3><br><br><br>
                <label for="dateCreated">Date created:</label>
                {{date('Y-m-d',strtotime($order->post_date))}}<br>
                <label for="">Status:</label>

                @php $current_status=$order->post_status; @endphp
                    @if($current_status=='on-hold') 
                    <span class="pending">Pending</span>
                    @elseif($current_status=='dispatch_complete')
                     Dispatch Complete 
                    @elseif($current_status=='processing')
                    <span class="processing">Processing</span>
                    @elseif($current_status=='dispatch')
                    <span class="dispatch">Dispatch</span>
                    @elseif($current_status=='delivered')
                    <span class="delivered">Delivered</span>
                    @else
                    <span class="cancel">Cancelled</span>
                    @endif



              





                @if($order->post_status=='cancelled')
                <div class="form-group">
                    <label for="dateCreated">Full Order Cancel Reason:</label>
                    <p> {{$order->post_content}}</p>
                </div>
                @endif
            </div>

            <div class="col-md-4 mt-4">
                <div class="font-weight-bold"><h5 style="font-weight:bold;"><u>CUSTOMER DETAILS</u></h5></div>

                @foreach($order->productMeta as $info) 
                @if($info->meta_key=="first_name")
                @php $customer=$info->meta_value; @endphp     
                @endif 

                @if($info->meta_key=="last_name")
                @php $l_name=$info->meta_value; @endphp     
                @endif 

                @if($info->meta_key=="address_one")
                @php $address=$info->meta_value;  @endphp                 
                @endif

                @if($info->meta_key=="phone")
                @php $phone=$info->meta_value;   @endphp                  
                @endif 

                @if($info->meta_key=="email")
                 @php $email=$info->meta_value; @endphp                  
                @endif 
                @endforeach

                {{$customer}} {{$l_name}}<br>
                {{$address}}

                <div class="font-weight-bold">Email Address</div>
                <div> {{$email}}</div>

                <div class="font-weight-bold">Phone</div>
                <div>{{$mobile_no}}</div>
            </div>

            <div class="col-md-4 mt-4">
                <div class="font-weight-bold"><h5 style="font-weight:bold;"><u>SHIPPING ADDRESS</u></h5></div>
                @php 
                $user_district=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_district')->first();
                $user_city=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_city')->first();
                $user_zip=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_zip')->first();
                @endphp

                @if(isset($user_district))
                District: {{$user_district->meta_value}}<br>
                City: {{$user_city->meta_value}}<br>
                Zip: {{$user_zip->meta_value}}
                @endif 
            </div>
        </div>



        <table class="table table-striped">
            <thead class="thead-light">
                <tr> 
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th  scope="col">Item</th>
                    <th scope="col">Details</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Total</th>
                    @if($order->post_status=='on-hold')
                    <th scope="col">Action</th>
                    @endif 
                </tr>
            </thead>
            <tbody>
                @php
                $subtotal=0;
                $pro_id=0;
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
                <tr>
                    <th scope="row">{{++$key}}</th>
                    <th scope="row">
                        @php
                        $image=DB::table('postmeta')
                        ->where('post_id',$items->product_parent)
                        ->where('meta_key','attached_file')        
                        ->first(); 
                        @endphp
                        @if(isset( $image))
                        <img width="50px" height="50px" src="{{asset('backend/products/'.$image->meta_value)}}">
                        @endif 
                    </th>
                    <td>{{$items->order_item_name}} <br>
                        @php 
                        $skuu=DB::table('postmeta')->where('post_id',$items->product_parent)->where('meta_key','_sku')->first(); 
                        @endphp 
                        @if(isset($skuu))
                        {{$skuu->meta_value}}
                        @endif 
                    </td>
                    <td>
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
                                    <td>{{$da->taxonomy}}:</td>
                                    <td>{{$da->term}}</td>
                                </tr>
                                @php $check_texonomy=$da->taxonomy; @endphp
                                @endforeach
                                @endforeach 
                                @if($check_texonomy) 
                                @php $pro_id=$items->product_id;  @endphp
                                @else 
                                @php $pro_id=$items->product_parent; @endphp
                                @endif
                            </tbody>
                        </table>
                    </td>
                    <td>
                        @php 
                        $p=DB::table('postmeta')->where('post_id',$items->product_parent)->where('meta_key','sale_price')->first(); 
                        @endphp 
                        @if(isset($p))
                        {{number_format($p->meta_value)}}
                        @endif 
                    </td>
                    <td>
                          @php $stock_qty_att=DB::table('postmeta')->where('post_id',$pro_id)->where('meta_key','attribute_stock')->first();  @endphp
                          @if(isset($stock_qty_att)) 
                             {{$pro_qtyy=$stock_qty_att->meta_value}} pcs 
                          @endif
                             @php $stock_qty_default=DB::table('postmeta')->where('post_id',$pro_id)->where('meta_key','default_qty')->first();  @endphp
                          @if(isset($stock_qty_default)) 
                             {{$pro_qtyy=$stock_qty_default->meta_value}} pcs 
                          @endif
                    </td>
                    <td>
                        {{$qty}} pcs 
                        @php $total_order_qty+=$qty; @endphp
                    </td>
                    <td>{{number_format($p->meta_value*$qty)}} tk @php $order_sub_total+=$p->meta_value*$qty; @endphp</td>
                    @if($order->post_status=='on-hold')
                    <td>
                        <form method="post" action="{{route('update.order.quantity')}}">
                            @csrf
                            @if($qty==0)
                             Order Cancel
                            @else 
                            <input type="number" class="form-control w-25" style="float: left" name="qtyy" min="0" max="{{$pro_qtyy}}" step="1" placeholder="Quantity">  
                            <input type="hidden" name="product_id" value="{{$pro_id}}">
                            <input type="hidden" name="order_id" value="{{$id}}">
                            <input type="hidden" name="order_item_id" value="{{$value->order_item_id}}">
                            <input type="hidden" name="total" value="{{$subtotal}}">
                            <button type="submit" class="btn btn-success" style="float: left">Update</button>
                            @endif
                        </form>  
                    </td>
                    @endif
                </tr>
                @php
                $grandTotal+=$p->meta_value*$qty;
                $grandLinetotal +=$p->meta_value*$qty; 
                @endphp
                @endforeach
            </tbody>
        </table>

        <div class="card-footer ">
            <div class="d-flex flex-column justify-content-end">

                <div class="d-flex flex-row justify-content-end" style="font-size: 16px;">
                    <div class="font-weight-bold">Sub-Total: </div>
                    <div class="ml-1">             
                        {{number_format($sub_total)}} tk 
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-end" style="font-size: 16px;">
                    <div class="font-weight-bold"> Delivery Charge: </div>
                    <div class="ml-1"> 
                      
                       {{number_format($charge_delivery)}} tk
                 
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-end" style="font-size: 16px;">
                    <div class="font-weight-bold"> Coupon: </div>
                    <div class="ml-1">  
                         {{number_format($coupon_amount)}} tk 
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-end" style="font-size: 16px;">
                    <div class="font-weight-bold"> Order Total: </div>
                   
                    <div class="ml-1">  
                      {{number_format($total_order_customer)}} tk 
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <a href="{{ url('admin/allStatus') }}"  class="btn btn-success mb-2">  Back</a>

        </div>
    </div>
</div>
@endsection