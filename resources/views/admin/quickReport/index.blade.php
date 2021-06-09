<?php

use Carbon\Carbon; ?>
@extends('admin.layouts.master')
@section('content')
<style>
    .box{
        border-radius: 10px;
        box-shadow:2px 2px 10px black;
        text-align: center;
    }
    a{
        text-decoration:none !important;
    }
    .box p{
        font-size:1.0em;
    }
    .reportTitleBg{
        background: #3467C1;
        text-align: center;
    }
    .reportText{
        text-align:center;
        font-weight:bold;
        color:white;
        font-size: 0.8rem;
    }
    .reportDayText{
        text-align:center;
        color:white;
        font-weight:  bold;
    }
    .reportDayValue{
        text-align:center;
        color:white;
    }
    .todayBg{
        background:#6DB040;
    }
    .dayThreeBg{
        background:#FAC300;
    }
    .dayFourBg{
        background:#F47926;
    }
    .dayFiveBg{
        background:#C00000;
    }
    .allStatus{
        background:#FF0000;
    }
</style>
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <div class="col-sm-6">
                    <h1>Quick Report List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Quick Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="mt-5 mb-5 ml-3">
        <div class="d-flex flex-row ml-2 flex-wrap">
            <div class="col-md-1 ml-3 reportTitleBg d-flex justify-content-center align-items-center box pl-2 pr-2 text-center" style="padding: 27px 0px;">

                <div class="reportText">Pending Order</div>

            </div>

            <a class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column" href="{{route('todayPendingOrder')}}">
                <div class="reportDayText">Today </div>                 
                <div class="reportDayValue">{{$today_pending_order}}</div>
            </a>           

            <a class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column" href="{{route('pendingOrderByDate',1)}}">                                    
                <div class="reportDayText"> Day 2</div>                  
                <div class="reportDayValue">{{$day_one_pending_order}}</div>
            </a>


            <a class="col-md-1 box ml-3 dayThreeBg d-flex justify-content-center flex-column" href="{{route('pendingOrderByDate',2)}}"> 
                <div class="reportDayText"> Day 3</div>                  
                <div class="reportDayValue">{{$day_two_pending_order}}</div>
            </a>


            <a class="col-md-1 box ml-3 dayFourBg d-flex justify-content-center flex-column"  href="{{route('pendingOrderByDate',3)}}">                                   
                <div class="reportDayText"> Day 4</div>                  
                <div class="reportDayValue">{{$day_three_pending_order}}</div>
            </a>


            <a class="col-md-1 box ml-3 dayFiveBg d-flex justify-content-center flex-column"  href="{{route('pendingOrderByDate',4)}}">                                   
                <div class="reportDayText"> Day 5</div>                  
                <div class="reportDayValue">{{$day_four_pending_order}}</div>
            </a>


            <a class="col-md-1 box ml-3 allStatus d-flex justify-content-center flex-column"  href="{{url('admin/pendingOrderAll')}}">
                <div class="reportDayText"> All</div>                  
                <div class="reportDayValue">{{$all_pending_order}}</div>
            </a>

        </div>     

        <div class="d-flex flex-row ml-2 mt-2 flex-wrap">

            <div class="col-md-1 ml-3 reportTitleBg d-flex justify-content-center align-items-center pl-2 pr-2 text-center box" style="padding: 27px 0px;">
                <div class="reportText">Processing</div>
            </div>

            <a class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column" href="{{route('processingOrderByDate',0)}}">
                <div class="reportDayText">Today </div>                 
                <div class="reportDayValue">{{$today_processing_order}}</div>
            </a>

            <a class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column" href="{{route('processingOrderByDate',1)}}">
                <div class="reportDayText"> Day 2</div>                  
                <div class="reportDayValue">{{$day_one_processing_order}} </div>
            </a>

            <a class="col-md-1 box ml-3 dayThreeBg d-flex justify-content-center flex-column" href="{{route('processingOrderByDate',2)}}">
                <div class="reportDayText"> Day 3</div>                  
                <div class="reportDayValue">{{$day_two_processing_order}} </div>
            </a>

            <a class="col-md-1 box ml-3 dayFourBg d-flex justify-content-center flex-column" href="{{route('processingOrderByDate',3)}}">                                   
                <div class="reportDayText"> Day 4</div>                  
                <div class="reportDayValue">{{$day_three_processing_order}} </div>
            </a>

            <a class="col-md-1 box ml-3 dayFiveBg d-flex justify-content-center flex-column" href="{{route('processingOrderByDate',4)}}">                                   
                <div class="reportDayText"> Day 5</div>                  
                <div class="reportDayValue">{{$day_four_processing_order}}</div>
            </a>

            <a class="col-md-1 box ml-3 allStatus d-flex justify-content-center flex-column" href="{{route('all_processing')}}">
                <div class="reportDayText"> All</div>                  
                <div class="reportDayValue">{{$all_processing_order}}</div>
            </a>
        </div>

        <div class="d-flex flex-row ml-2 mt-2 flex-wrap">

            <div class="ml-3 col-md-1 reportTitleBg d-flex justify-content-center align-items-center pl-2 pr-2 text-center box" href="#" style="padding: 27px 0px;">
                <div class="reportText">Dispatch</div>
            </div>

            <a class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column" href="{{route('dispatchByDate',0)}}">
                <div class="reportDayText">Today </div>                 
                <div class="reportDayValue">{{$today_dispatch_order}}</div>
            </a>              

            <a class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column" href="{{route('dispatchByDate',1)}}">  
                <div class="reportDayText"> Day 2</div>                  
                <div class="reportDayValue">{{$day_one_dispatch_order}}</div>
            </a>

            <a class="col-md-1 box ml-3 dayThreeBg d-flex justify-content-center flex-column" href="{{route('dispatchByDate',2)}}">
                <div class="reportDayText"> Day 3</div>                  
                <div class="reportDayValue">{{$day_two_dispatch_order}}</div>
            </a>

            <a class="col-md-1 box ml-3 dayFourBg d-flex justify-content-center flex-column" href="{{route('dispatchByDate',3)}}">  
                <div class="reportDayText"> Day 4</div>                  
                <div class="reportDayValue">{{$day_three_dispatch_order}}</div>
            </a>

            <a class="col-md-1 box ml-3 dayFiveBg d-flex justify-content-center flex-column" href="{{route('dispatchByDate',4)}}">  
                <div class="reportDayText"> Day 5</div>                  
                <div class="reportDayValue">{{$day_four_dispatch_order}}</div>
            </a>

            <a class="col-md-1 box ml-3 allStatus d-flex justify-content-center flex-column" href="{{route('order.dispatall')}}">
                <div class="reportDayText"> All</div>                  
                <div class="reportDayValue">{{$all_dispatch_order}}</div>
            </a>
        </div>

        <div class="d-flex flex-row ml-2 mt-2 flex-wrap">
            <div class="col-md-1 ml-3 box reportTitleBg d-flex justify-content-center align-items-center pl-2 pr-2 text-center" style="padding: 27px 0px;">                 
                <div class="reportText">Stock Moving</div>
            </div>

            <a class="col-md-1 box ml-3  todayBg d-flex justify-content-center flex-column" href="{{route('stockMove',7)}}">
                <div class="reportDayText">Week 1 </div>
                <div class="reportDayValue">                      
                    {{ $stcokMove['week1']}}
                </div>
            </a>

            <a class="col-md-1 box ml-3  todayBg d-flex justify-content-center flex-column" href="{{route('stockMove',15)}}">
                <div class="reportDayText"> Week 2</div>
                <div class="reportDayValue">
                    {{ $stcokMove['week2']}}
                </div>
            </a>

            <a class="col-md-1 box ml-3  dayThreeBg d-flex justify-content-center flex-column" href="{{route('stockMove',30)}}">
                <div class="reportDayText"> Month 1</div>
                <div class="reportDayValue">
                    {{ $stcokMove['month1']}}
                </div>
            </a>

            <a class="col-md-1 box ml-3  dayFourBg d-flex justify-content-center flex-column" href="{{route('stockMove',60)}}">
                <div class="reportDayText"> Month 2</div>
                <div class="reportDayValue">{{ $stcokMove['month2']}}</div>
            </a>

            <a class="col-md-1 box ml-3  dayFiveBg d-flex justify-content-center flex-column" href="{{route('stockMove',90)}}">
                <div class="reportDayText"> Month 3</div>
                <div class="reportDayValue">
                    {{ $stcokMove['month3']}}
                </div>
            </a>

            <a class="col-md-1 box ml-3  allStatus d-flex justify-content-center flex-column" href="{{route('stockMove','all')}}">
                <div class="reportDayText"> All</div>
                <div class="reportDayValue"> {{ $stcokMove['week1']+$stcokMove['week2']+$stcokMove['month1']+$stcokMove['month2']+$stcokMove['month3']}}</div>
            </a>

        </div>
        <div class="d-flex flex-row ml-2 mt-2 flex-wrap">
            <div class="col-md-1 ml-3 box reportTitleBg d-flex justify-content-center align-items-center pl-2 pr-2 text-center" style="padding: 27px 0px;">
                <div class="reportText">Stock</div>
            </div>

            <div class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column" >
                <a href="{{url('admin/stock')}}">
                    <div class="reportDayText">Pieces </div>
                    <div class="reportDayValue">
                   <!-- stock start -->
                       @php $tot_costt=0;$tot_selll=0; $tott_qtyy=0; $qty=0; $i=0; $price=0; $sprice=0; $sku=''; $total_sell_price=0; $cost=0; $img='';
                                @endphp
                                @foreach($products as $item)
                                @php $product_info=DB::table('postmeta')->where('post_id',$item->ID)->get();
                                @endphp
                                @foreach($product_info as $info)
                                @if($info->meta_key=='default_qty')
                                @php $qty=$info->meta_value; @endphp
                                @endif
                                @endforeach 
                                   @php 
                                        $lists=DB::table('posts')
                                        ->where('post_type','product_varient')
                                        ->where('post_parent',$item->ID)
                                        ->where('meta_key','attribute')
                                        ->join('postmeta','posts.ID','=','postmeta.post_id')
                                        ->select('meta_value','post_id')
                                        ->get();
                                         @endphp
                                                @php $i=0; @endphp 
                                                            @foreach($lists as $a) 
                                                                @php 
                                                                $i++;
                                                                @endphp
                                                            @endforeach 
                                @if($i>0) 
                                        @php $qty=DB::table('posts')
                                        ->where('post_type','product_varient')
                                        ->where('post_parent',$item->ID)
                                        ->where('meta_key','attribute_stock')
                                        ->join('postmeta','posts.ID','=','postmeta.post_id')
                                        ->sum('meta_value'); @endphp @php $main_qty=$qty; @endphp  @else @php $main_qty=$qty; @endphp @endif  @php $main_qty; $tott_qtyy+=$main_qty; @endphp


                        @endforeach 
                        {{$tott_qtyy}}
                    <!-- stock end -->
                    </div>
                </a>
            </div>


            <div class="col-md-1 box ml-3 dayThreeBg d-flex justify-content-center flex-column">
                <a href="{{url('admin/stock')}}">
                    <div class="reportDayText"> Amount</div>
                    <div class="text-center font-weight-div">
                        @php $de_sell=0; $tot_p=0; @endphp
                                   @foreach($d_sell as $item)
                                     @php $product_info=DB::table('postmeta')->where('post_id',$item->ID)->get();
                                     @endphp
                                          @foreach($product_info as $info)
                                            @if($info->meta_key=='sale_price')
                                      @php $de_sell=$info->meta_value; $tot_p+=$de_sell @endphp
                                   @endif
                                           @endforeach 
                                  @endforeach 
                        {{number_format($tot_p)}}
                    </div>
                </a>
            </div>
        </div>
        <div class="d-flex flex-row ml-2 mt-2 flex-wrap">
            @php $total_d_data=0; $total_stock_data=0;  $pro_qty=0;$pro_alert_qty=0; $products_id=0; $weekly_lower_stock_count=0; $weekly_total_sold_out_product=0; @endphp  
            @foreach($pro as $pros)
            @foreach($pros->productMeta as $pro_info) 
            @if($pro_info->meta_key=='qty') @php $pro_qty=$pro_info->meta_value; @endphp @endif 
            @if($pro_info->meta_key=='alert_qty') @php $pro_alert_qty=$pro_info->meta_value; @endphp @endif  
            @endforeach
            @php
            $date = Carbon::parse($pros->post_date);
            $now = Carbon::now();
            $diff = $date->diffInDays($now);
            @endphp
            @if($diff<=7)
            @php 
            $products_id=$pros->ID; 
            $weekly_lower_stock_count=
            DB::table('postmeta')
            ->where('post_id',$products_id)
            ->where('meta_key','qty')
            ->where('meta_value','<=',$pro_alert_qty)
            ->count(); 
            @endphp
            @php
            @endphp
            @endif
            @endforeach 

            <div class="col-md-1 box ml-3 reportTitleBg d-flex justify-content-center align-items-center pl-2 pr-2 text-center" style="padding: 3px 0px;">
                <div class="reportText" style="padding: 20px 0px;">Lower Stock</div>
             
            </div>

         <!-- default product start -->
              @php $alert_quantity=0; $dj=0; @endphp  
              @foreach($d_pro as $dp) 
                @foreach($dp->productMeta as $dmeta) 
                   @if($dmeta->meta_key=='alert_qty') @php $alert_quantity=$dmeta->meta_value; @endphp @endif
                @endforeach
                @php 
                 $low_product_default=DB::SELECT("SELECT * FROM `postmeta` WHERE `meta_key` LIKE 'default_qty' AND post_id=$dp->post_id AND meta_value<=$alert_quantity");
                @endphp
                @foreach($low_product_default as $low)
                              @php $dj++; @endphp
                @endforeach
              @endforeach
              <!-- default product end -->

                <!-- attribute product start -->
              @php $alert_quantity=0; $aj=0; @endphp  
              @foreach($a_pro as $dp) 
                @foreach($dp->productMeta as $dmeta) 
                   @if($dmeta->meta_key=='attribute_low_stock') @php $alert_quantity=$dmeta->meta_value;  @endphp @endif
                @endforeach
                @php 
                 $low_product_att=DB::SELECT("SELECT * FROM `postmeta` WHERE `meta_key` LIKE 'attribute_stock' AND post_id=$dp->post_id AND meta_value<=$alert_quantity");
                @endphp
                @foreach($low_product_att as $low)
                        @php $aj++; @endphp
                @endforeach
              @endforeach
              <!-- attribute product end -->
                 <div class="ml-1 todayBg d-flex justify-content-center flex-column"></div>
            <div class="col-md-2 box ml-3 todayBg d-flex justify-content-center flex-column"> 
                <a href="{{url('admin/stock/lower')}}">                
                    <div class="reportDayText"> All</div>
                    <div class="reportDayValue">

                       {{$dj+$aj}}
                    </div>
                </a>
            </div>
        </div> 



        <div class="d-flex flex-wrap ml-2 mt-2">
            <div class="col-md-1 box ml-3 reportTitleBg d-flex justify-content-center align-items-center pl-2 pr-2 text-center" style="padding: 3px 0px;">                 
                <div style="padding: 20px 0px;" class="reportText">Sold Out</div>
            </div>

              <div class="ml-1 todayBg d-flex justify-content-center flex-column"></div>

            <div class="col-md-2 box ml-3 dayThreeBg d-flex justify-content-center flex-column">
                <a href="{{url('admin/stock/list/sold')}}">
                    <div class="reportDayText"> All</div>
                    <div class="reportDayValue"> 
                    @php $total_sale_ii=0; $total_sale_jj=0; $total_cost_ii=0; $total_cost_jj=0; $ii=0;$jj=0; @endphp
                    @foreach($default_product_sold as $dpro)         
                    @php $ii++;
                    @endphp
                    @endforeach 
                    @foreach($attribute_product_sold as $apro) 
                        @php 
                                        $parent_id=DB::table('posts')
                                        ->where('ID',$apro->post_id)
                                        ->select('post_parent')->first();
                                        @endphp
                    @php $jj++; @endphp
                    @endforeach 
                   {{$ii+$jj}}
                </div>
                </a>
            </div>
        </div>





        <div class="d-flex flex-row ml-2 mt-2 flex-wrap">
            <div class="col-md-1 box ml-3 reportTitleBg d-flex justify-content-center align-items-center pl-2 pr-2 text-center" style="padding: 27px 0px;">
                <div class="reportText">Best Selling</div>
            </div>

            <div class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column" >
                <a href="{{url('admin/quickReport/best_selling_items')}}">
                    <div class="reportDayText">Monthly</div>
                    <div class="reportDayValue">
                        @php $item_monthly=0; @endphp
                        @foreach($monthly_best_sell_item as $best_monthly) 
                        @php $item_monthly+=$best_monthly->total_qty; @endphp  
                        @endforeach
                        {{$item_monthly}}
                    </div>
                </a>
            </div>

            <div class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column">
                <a href="{{route('b_sell_yearly')}}">
                    <div class="reportDayText">Yearly</div>
                    <div class="reportDayValue">
                        @php $item=0; @endphp
                        @foreach($yearly_best_sell_item as $best)  @php $item+=$best->total_qty; @endphp  @endforeach
                        {{$item}}
                    </div>
                </a>
            </div>
        </div> 








        
        <div class="d-flex flex-row ml-2 mt-2 flex-wrap">


            <div class="col-md-1 box ml-3  reportTitleBg d-flex justify-content-center align-items-center pl-2 pr-2 text-center" style="padding: 27px 0px;">
                <div class="reportText">Delivered</div>
            </div>


            <div class="col-md-1 box ml-3  todayBg d-flex justify-content-center flex-column">
                <a  href="{{url('delivered/order')}}">
                    <div class="reportDayText">Quantity</div>
                    <div class="reportDayValue">{{$delivered_qty}}</div>
                </a>
            </div>



            <div class="col-md-1 box ml-3  dayThreeBg d-flex justify-content-center flex-column">
                <a  href="{{url('delivered/order')}}">
                    <div class="reportDayText"> Amount</div>
                    <div class="reportDayValue">
                        @php $total_delivered_amount=0; $total_charge=0; $total_coupon=0; @endphp
                        @foreach($delivered_order as $d_order)
                        @php $delivery=DB::table('order_itemmeta')->where('order_id',$d_order->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery)) @php $charge=$delivery->meta_value; @endphp @else @php $charge=0; @endphp @endif
                        @php $coupon=DB::table('order_itemmeta')->where('order_id',$d_order->ID)->where('meta_key','coupon_taka')->first(); @endphp @if(isset($coupon)) @php $ch=$coupon->meta_value; @endphp @else @php $ch=0; @endphp @endif
                        @php $total_charge+=$charge; @endphp
                        @php $total_coupon+=$ch; @endphp
                        @foreach($d_order->orderItem as $item_order)
                        @foreach($item_order->orderMeta as $meta)
                        @if($meta->meta_key=='_line_subtotal') @php $total_delivered_amount+=$meta->meta_value; @endphp @endif
                        @endforeach 
                        @endforeach 
                        @endforeach
                        {{number_format($total_delivered_amount+$total_charge-$total_coupon)}}
                    </div>
                </a>
            </div>
        </div>   
        <div class=" d-flex flex-row ml-2 mt-2 flex-wrap">
            <div class="col-md-1 box ml-3 reportTitleBg d-flex justify-content-center align-items-center pl-2 pr-2 text-center" style="padding: 27px 0px;">
                <div class="reportText">Gross Profit</div>
            </div>

            <div class="col-md-1 box ml-3 todayBg d-flex justify-content-center flex-column" >
                <a href="{{route('g_profit_monthly')}}">
                    <div class="reportDayText">Monthly</div>
                    <div class="reportDayValue">
                         @php $total_copp=0; $arra_sale_total=0; $arra_cost_total=0; $total_charge=0; $total_c=0; $total_qty=0; $total_sale_amount=0; $total_cost=0; $total_profit=0; $qty=0; $product_id=0; $sale_price=0; $cost=0; @endphp
                                @foreach($orderrr as $item)
                                 @php $delivery=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery)) @php $charge=$delivery->meta_value; @endphp @else @php $charge=0; @endphp @endif 	
                                        @php $total_charge+=$charge; @endphp	

                                        @php $copp=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','coupon_taka')->first(); @endphp @if(isset($copp)) @php $cc=$copp->meta_value; @endphp @else @php $cc=0; @endphp @endif 	
                                        @php $total_copp+=$cc; @endphp


                                         @foreach($item->orderItem as $meta)
                                            @foreach($meta->orderMeta as $value) 
                                            @if($value->meta_key=='_qty') @php $qty=$value->meta_value; @endphp @endif
                                            @endforeach
                                         
                                            @php $total_qty+=$qty; @endphp
                                            @endforeach

                                             @foreach($item->orderItem as $meta)
                                            @foreach($meta->orderMeta as $value)
                                            @if($value->meta_key=='_line_subtotal') @php $sale_price=$value->meta_value; @endphp @endif
                                            @endforeach
                                         
                                            @php $arra_sale_total+=$sale_price; @endphp
                                            @endforeach

                                            @foreach($item->orderItem as $meta)
                                            @foreach($meta->orderMeta as $value) 
                                            @if($value->meta_key=='_qty') @php $qtyy=$value->meta_value; @endphp @endif
                                            @endforeach
                                            @php $cost=DB::table('postmeta')->where('post_id',$meta->product_parent)->where('meta_key','product_stock')->first(); @endphp
                                            
                                               @php $costt=$cost->meta_value*$qtyy; @endphp 
                                          
                                            @php $arra_cost_total+=$costt; @endphp
                                          @endforeach  
                                          @endforeach  
                                          
                                          {{number_format($arra_sale_total-$arra_cost_total+$total_charge-$total_copp)}}
                      
                    </div>
                </a>
            </div>
            <div class="col-md-1 box ml-3 dayThreeBg d-flex justify-content-center flex-column">
                <a href="{{route('g_profit_y')}}">
                    <div class="reportDayText"> Yearly</div>
                    <div class="reportDayValue">
                         @php $total_copp=0; $arra_sale_total=0; $arra_cost_total=0; $total_charge=0; $total_c=0; $total_qty=0; $total_sale_amount=0; $total_cost=0; $total_profit=0; $qty=0; $product_id=0; $sale_price=0; $cost=0; @endphp
                                @foreach($orderrrr as $item)
                                 @php $delivery=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery)) @php $charge=$delivery->meta_value; @endphp @else @php $charge=0; @endphp @endif 	
                                        @php $total_charge+=$charge; @endphp	

                                        @php $copp=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','coupon_taka')->first(); @endphp @if(isset($copp)) @php $cc=$copp->meta_value; @endphp @else @php $cc=0; @endphp @endif 	
                                        @php $total_copp+=$cc; @endphp


                                         @foreach($item->orderItem as $meta)
                                            @foreach($meta->orderMeta as $value) 
                                            @if($value->meta_key=='_qty') @php $qty=$value->meta_value; @endphp @endif
                                            @endforeach
                                            @php $total_qty+=$qty; @endphp
                                            @endforeach
                                             @foreach($item->orderItem as $meta)
                                            @foreach($meta->orderMeta as $value)
                                            @if($value->meta_key=='_line_subtotal') @php $sale_price=$value->meta_value; @endphp @endif
                                            @endforeach
                                            @php $arra_sale_total+=$sale_price; @endphp
                                            @endforeach
                                            @foreach($item->orderItem as $meta)
                                            @foreach($meta->orderMeta as $value) 
                                            @if($value->meta_key=='_qty') @php $qtyy=$value->meta_value; @endphp @endif
                                            @endforeach
                                            @php $cost=DB::table('postmeta')->where('post_id',$meta->product_parent)->where('meta_key','product_stock')->first(); @endphp
                                               @php $costt=$cost->meta_value*$qtyy; @endphp 
                                            @php $arra_cost_total+=$costt; @endphp
                                          @endforeach  
                                          @endforeach  
                                          {{number_format($arra_sale_total-$arra_cost_total+$total_charge-$total_copp)}}
                             </div>
                         </a>
                  </div>
            </div>    
      </div>  
</div>
@endsection