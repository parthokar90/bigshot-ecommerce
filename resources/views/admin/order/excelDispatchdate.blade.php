@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">


    </div><!-- /.container-fluid -->








      <div class="card-body">
        <h1 class="mb-3" style="text-align:center;font-weight:bold;">Excel Dispatch</h1>
         
      <div class="container">
         @include('admin.includes.messages')
        <ul class="nav bg-dark d-flex justify-content-around">
         <li class="nav-item" style="border-right: 1px solid white;">
          <a  class="nav-link" href="{{route('order.allStatus')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">All Status({{$total_order_admin}})</a>
        </li>

       <!--  <li class="nav-item " style="border-right: 1px solid white;">
          <a class="nav-link"  href="{{route('order.pendingOrder')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Pending Order ({{$pending_order}})</a>
        </li> -->
        <li class="nav-item " style="border-right: 1px solid white;">
          <a class="nav-link"  href="{{route('order.pendingOrder')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Pending Order ({{$pending_order}})</a>
        </li>
        <li class="nav-item" style="border-right: 1px solid white;">
          <a class="nav-link"  href="{{route('order.processing')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Processing ({{$processing_order}})</a>
        </li>
        <li class="nav-item" style="border-right: 1px solid white;">
          <a  class="nav-link" href="{{route('order.dispat')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Dispatch ({{$dispatch_order}})</a>
        </li>
        <li class="nav-item bg-primary" style="border-right: 1px solid white;">
          <a  class="nav-link active" href="{{route('order.excel.dispatch')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Excel Dispatch</a>
        </li>
        <li class="nav-item" style="border-right: 1px solid white;">
          <a  class="nav-link" href="{{route('order.delivery.invoice')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Delivery Invoice</a>
        </li>
        <li class="nav-item" style="border-right: 1px solid white;">
          <a class="nav-link" href="{{route('order.deliver')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Delivered ({{$delivered_order}})</a>
        </li>
        <li class="nav-item">
          <a  class="nav-link" href="{{route('order.cancelled')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Cancelled ({{$cancelled_order}})</a>
        </li>
      </ul>
    </div>
  </div>
    <div class="s002">
    <div class="d-flex justify-content-center h2 mb-3">Search Excel Dispatch Order</div>
     <h5 class="text-center">Date from {{date('d-m-Y',strtotime($start))}} To {{date('d-m-Y',strtotime($end))}}</h5>
    <div class="d-flex justify-content-center mb-3">
      <form class="form-inline" method="post" action="{{route('excel.dispatch.order.date')}}" >
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
    </div>
<!-- Main content -->
<section class="content">
  <div class="container">
    <div class="card">

      <div class="card-header">
        <strong></strong>
        <span class="float-right"> <strong></strong></span>
      </div>

      <div class="card-body">
        {{$order->links()}}
        @if($order->count()>0)
        <button id="selectAll" class="btn btn-info" type="button">Copy</button>
        <button id="download_excel" class="btn btn-success" type="button">Download</button>
        <button style="display: none;" id="refresh_excel" class="btn btn-success" type="button">Refresh</button>
        @endif 
<div class="loader">
  <div class="loading">
  </div>
</div>
        <div class="table-responsive-sm">
          <table id="example" class="table table-striped">

            <thead>
              <tr>
                <th class="center">Oder Id</th>
                <th>Name</th>
                <th class="right">Mobile</th>
                <th class="right">Address</th>
                <th class="right">Delivery Charge</th>
                <th class="right">Coupon</th>
                <th class="right">Amount</th>
                <th class="right">Status</th>
              </tr>
            </thead>
            <form id="copy_form" class="form-inline" method="post" action="{{route('order.excel.dispatch.download')}}" >
             @csrf() 
            <tbody>
              @php $first_name=''; $last_name=''; $address=''; $phone=''; $subtotal=0; $total_amount=0; $total_qty=0; @endphp
              @foreach($order as $orders)
              @foreach($orders->productMeta as $meta)
              @if($meta->meta_key=='first_name') @php $name=$meta->meta_value; @endphp @endif
              @if($meta->meta_key=='last_name') @php $last_name=$meta->meta_value; @endphp @endif
              @if($meta->meta_key=='address_one') @php $address_one=$meta->meta_value; @endphp @endif
              @if($meta->meta_key=='phone') @php $phone=$meta->meta_value; @endphp @endif
              @endforeach
              @foreach($orders->orderItem as $info)
              @foreach($info->orderMeta as $value)
              @if($value->meta_key=='_line_subtotal')
              @php $subtotal=$value->meta_value; @endphp
              @endif
              @php $total_amount=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','_line_subtotal')->sum('meta_value'); @endphp
              @php $total_qty=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','_qty')->sum('meta_value'); @endphp
              @endforeach
              @endforeach
              <tr>
                <td class="center"><input type="checkbox" name="check_id[]" value="{{$orders->ID}}"> {{$orders->ID}} Date:{{date('d-m-Y',strtotime($orders->post_date))}}</td>
                <td>{{$name}} {{$last_name}}</td>
                <td class="right">{{$phone}}</td>
                <td class="right">{{$address_one}}</td>
                <td class="right">@php $delivery=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery)) @php $charge=$delivery->meta_value; @endphp @else @php $charge=0; @endphp @endif {{$charge}} tk</td>
                <td class="right">@php $coupon=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','coupon_taka')->first(); @endphp @if(isset($coupon)) @php $c=$coupon->meta_value; @endphp @else @php $c=0; @endphp @endif {{$c}} tk</td>
                <td class="right">{{number_format($total_amount+$charge-$c)}} tk</td>
                <td>@if($orders->post_status=='dispatch_complete') Complete @else In Complete @endif</td>
              </tr>
              @endforeach
            </tbody>
              </form>
          </table>
     
        </div>
            
        <div class="row">
          <div class="col-lg-4 col-sm-5">

          </div>

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
<script>
$(document).ready(function () {
  $('body').on('click', '#selectAll', function () {
        $('input[type="checkbox"]', '#example').prop('checked', true);
    $(this).toggleClass('allChecked');
  })

  $("#download_excel").click(function(){
      var checked = $("#example input:checked").length > 0;
    if (!checked){
        alert("Please check at least one checkbox");
        return false;
    }
    $('#copy_form').delay(200).submit();
    $("#refresh_excel").show();
    $("#download_excel").hide();
  });

  $("#refresh_excel").click(function(){
    location.reload();
  });



});
</script>
@endsection