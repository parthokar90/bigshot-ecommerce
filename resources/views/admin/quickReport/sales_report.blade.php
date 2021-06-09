<?php

use App\Model\front\Order_item;
?>
<style>
  li{
    list-style: none;
  }
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
@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->

    <div class="card-body">

    </div>

    <div class="d-flex justify-content-center h2 mb-3">Search Sales Order</div>
    <div class="d-flex justify-content-center">
     <form class="form-inline" method="get" action="{{route('sales.report')}}" >
      @csrf() 
      <div class="form-group mb-2">
        <label for="depart" class="mr-2">Start Date </label>
        <input class="form-control datepicker" name="start" value="{{date('Y-m-d')}}" id="depart" type="date"/>
      </div>
      <div class="form-group mx-sm-3 mb-2">
        <label for="return" class="mr-2">End Date </label>
        <input class="form-control datepicker" name="end" value="{{date('Y-m-d')}}" id="return" type="date"/>
      </div>
      <button type="submit" class="btn btn-primary mb-2">SEARCH</button>
    </form>
  </div>
  
</section>
<!-- Main content -->
<section class="content">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive-sm">
          <h5 class="text-center"></h5>
          <table class="table table-striped text-center">
            <thead>
              <tr>
                <th class="center">Oder Id</th>
                <th>Cust.Details</th>
                <th class="text-center">Item Details</th>
                <th class="text-center">Total Order</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $pro_name=''; $order_qty=0; $customer=''; $address=''; $phone=''; $tot_delivery_chage=0; $skuu=''; $pic=''; $pro_name=''; $att=0; $qt=0; @endphp
              @foreach($orders as $key=>$items)
              @php $order_qty=DB::table('order_itemmeta')->where('order_id',$items->ID)->where('meta_key','_qty')->sum('meta_value'); @endphp
              @php $pro_name=DB::table('order_items')->where('order_id',$items->ID)->select('order_item_name')->first(); @endphp 
              @foreach($items->productMeta as $info) 
              @if($info->meta_key=="first_name")
              @php $customer=$info->meta_value; @endphp     
              @endif 

              @if($info->meta_key=="address_one")
              @php $address=$info->meta_value;  @endphp                 
              @endif

              @if($info->meta_key=="phone")
              @php $phone=$info->meta_value;   @endphp                  
              @endif 
              @endforeach
              <tr style="background: #ffffff;">
               <td>
                 {{$items->ID}}
                 <hr style="border: 0.1px solid black">
                 {{date('d-m-y',strtotime($items->post_date))}}
               </td>
               <td>
                 {{$customer}}<br>
                 {{$phone}}<br>
                 {{$address}}
               </td>
               <td>
                <table style="width:100%">

                 @foreach($items->orderItem as $orderMetas) 
                 <tr style="background: #ffffff;">
                  <td>
                    @php 
                    $pic=DB::table('postmeta')->where('meta_key','attached_file')
                    ->where('post_id',$orderMetas->product_parent) 
                    ->first();
                    $skuu=DB::table('postmeta')->where('meta_key','_sku')
                    ->where('post_id',$orderMetas->product_parent) 
                    ->first();
                    @endphp 
                    @if(isset($pic)) @php $im=$pic->meta_value; @endphp
                    <img src="{{asset('backend/products/'.$im)}}" width="50" height="50"><br>
                    @endif 
                    @if(isset($skuu)) {{$skuu->meta_value}}  @endif 
                  </td>
                  <td>
              
                   @foreach($orderMetas->orderMeta as $value)
                   @if($value->meta_key=='attribute_parent')
                   @php 
                $termsInfo='';
                   $att=$value->meta_value; @endphp
                   @endif
                   @endforeach
                   @php 
                   $list_att=DB::table('postmeta')->where('post_id',$att)
                   ->where('meta_key','attribute')->get(); 
                   @endphp
                   @foreach($list_att as $a)
                   @php $data_att=json_decode($a->meta_value); @endphp 
                   @foreach($data_att as $da)
                   @php
                   $termsInfo .=' - ';
                   $termsInfo .= $da->term;
                   @endphp
                   @endforeach 
                   @endforeach
                  {{substr($termsInfo,3)}}
                    <br> 
                   <div class="mt-2"> 
                    @foreach($orderMetas->orderMeta as $value)
                    @if($value->meta_key=='_qty')
                    @php $qt=$value->meta_value; @endphp
                    @endif
                    @endforeach 
                    Qty-{{$qt}} <br>
                    {{$orderMetas->order_item_name}}
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </td>
          @php $delivery=DB::table('order_itemmeta')->where('order_id',$items->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery)) @php $charge=$delivery->meta_value; @endphp @else @php $charge=0; @endphp @endif
          @php $coupon=DB::table('order_itemmeta')->where('order_id',$items->ID)->where('meta_key','coupon_taka')->first(); @endphp 
          @if(isset($coupon)) @php $c=$coupon->meta_value; @endphp @else @php $c=0; @endphp @endif 
          <td>@php $amount=DB::table('order_itemmeta')->where('order_id',$items->ID)->where('meta_key','_line_subtotal')->sum('meta_value'); @endphp {{number_format($amount+$charge-$c)}} tk <br> {{$order_qty}} Pcs</td>
          <td class="right">

           @php $current_status=$items->post_status; @endphp
            @if($current_status=='on-hold') 
              <span class="pending">Pending</span>
              @elseif($items->post_status=='dispatch_complete') 
                <span class="">Dispatch Complete</span>
              @elseif($current_status=='processing')
              <span class="processing">Processing</span>
               @elseif($current_status=='dispatch')
              <span class="dispatch">Dispatch</span>
               @elseif($current_status=='delivered')
              <span class="delivered">Delivered</span>
               @else
              <span class="cancel">Cancelled</span>
            @endif
                    
          </td>

          <td>
           <a href="{{route('pending_order_print',$items->ID)}}" class="btn btn-success btn-sm mb-1"> <i class="fas fa-print"> </i> Print</a>
          <!--  <a onclick="return confirm('are you sure??')" href="{{route('pending_order_processing',$items->ID)}}" class="btn btn-primary btn-sm  mb-1" ><i class="fas fa-spinner"> </i> Processing</a><br>
           <a href="{{route('pending_order_edit',$items->ID)}}" class="btn btn-warning"> <i class="fas fa-edit"> </i>@if($items->post_status=='on-hold') Edit @else View @endif</a><br>
           <a onclick="return confirm('are you sure??')" href="{{route('pending_order_cancel',$items->ID)}}" class="btn btn-danger btn-sm"> <i class="fas fa-window-close"> </i> Cancel</a> -->
         </td>
       </tr>
       @endforeach
     </tbody>
   </table>
 </div>

 <div class="row">
  <div class="col-lg-4 col-sm-5">

  </div>

</div>

</div>
</div>
</div>
<div class="container">
  <div class="row">
   <div class="col-md-4">
    <div class="box bg-primary card text-center font-weight-bold pt-2 pb-2 h5">
      <div class="">{{ $total_orders}}</div>
      <div class="">Total Order</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box bg-success card text-center font-weight-bold pt-2 pb-2 h5">
      <div >{{$total_item}}</div>
      <div >Total Quantity</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box bg-info card text-center font-weight-bold pt-2 pb-2 h5">
      <!-- <i class="fa fa-handshake ml-1"></i> -->
      @php $tot_d=0; $tot_c=0; @endphp
      @foreach($or as $ors)
      @php 
      $d=DB::table('order_itemmeta')->where('order_id',$ors->ID)->where('meta_key','delivery_charge')->first(); 
      $cc=DB::table('order_itemmeta')->where('order_id',$ors->ID)->where('meta_key','coupon_taka')->first(); 
      @endphp
      @if(isset($d)) @php $tot_d+=$d->meta_value; @endphp @endif
      @if(isset($cc)) @php $tot_c+=$cc->meta_value; @endphp @endif
      @endforeach
      {{number_format($total_amount+$tot_d-$tot_c)}}


      <div>Total Amount</div>
    </div>
  </div>
</div>       

</div>
</section>
<!-- /.row -->
</div><!-- /.container-fluid -->

<!-- /.content -->
<!--  </div> -->
@endsection

@section('js')

@endsection