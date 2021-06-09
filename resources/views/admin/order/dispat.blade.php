@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->



      <div class="card-body">
        <h1 class="mb-3" style="text-align:center;font-weight:bold;">All Dispatch Order</h1>
         
      <div class="container">
         @include('admin.includes.messages')
        <ul class="nav bg-dark d-flex justify-content-around">
         <li class="nav-item" style="border-right: 1px solid white;">
          <a  class="nav-link " href="{{route('order.allStatus')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">All Status({{$total_order_admin}})</a>
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
        <li class="nav-item bg-primary" style="border-right: 1px solid white;">
          <a  class="nav-link active" href="{{route('order.dispat')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Dispatch ({{$total_order}})</a>
        </li>
        <li class="nav-item" style="border-right: 1px solid white;">
          <a  class="nav-link" href="{{route('order.excel.dispatch')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Excel Dispatch</a>
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
      <div class="d-flex  justify-content-center h2 mb-3">Search Dispatch Order</div>
      <div class="d-flex justify-content-center mb-3">
        <form class="form-inline" method="get" action="{{route('dispatch.order.date.wise')}}" >
          <div class="form-group mb-2">
            <label for="depart" class="mr-2">Order Id</label>
            <input required type="text" class="form-control" name="order_id" placeholder="Scanner or Order Id" />
          </div>

          <button type="submit" class="btn btn-primary mb-2">SEARCH</button>
        </form>
      </div>
 
    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <strong></strong>
          <span class="float-right"> <strong></strong></span>
        </div>
        <div class="card-body">
          <div class="table-responsive-sm">
             <h5 class="text-center">Current Month Order List</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="center">Oder Id</th>
                  <th>Name</th>
                  <th class="right">Address</th>
                  <th class="right">Mobile</th>
                  <th class="right">Delivery Charge</th>
                  <th class="right">Coupon</th>
                  <th class="right">Amount</th>
                  <!-- <th class="right">Comments</th> -->
                  <th class="right">Action</th>
                </tr>
              </thead>
              <tbody>
                @php $first_name=''; $last_name=''; $address=''; $phone=''; $subtotal=0; $total_amount=0; $tot_charge=0; $tot_coupon=0; @endphp
                @foreach($order as $orders)
                @foreach($orders->productMeta as $meta)
                @if($meta->meta_key=='first_name') @php $name=$meta->meta_value; @endphp @endif
                @if($meta->meta_key=='last_name') @php $last_name=$meta->meta_value; @endphp @endif
                @if($meta->meta_key=='address_one') @php $address_one=$meta->meta_value; @endphp @endif
                @if($meta->meta_key=='phone') @php $phone=$meta->meta_value; @endphp @endif
                @endforeach
                @foreach($orders->orderItem as $info)
                @foreach($info->orderMeta as $value)
       
                @endforeach
                @endforeach
                <tr>
                  <td class="center">{{$orders->ID}} Date:{{date('d-m-Y',strtotime($orders->post_date))}}</td>
                  <td>{{$name}} {{$last_name}}</td>
                  <td class="right">{{$address_one}}</td>
                  <td class="right">{{$phone}}</td>
                  <td class="right">@php $delivery=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery)) @php $charge=$delivery->meta_value; @endphp @else @php $charge=0; @endphp @endif {{number_format($charge)}} tk @php $tot_charge+=$charge; @endphp</td>
                  
                <td class="right">@php $coupon=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','coupon_taka')->first(); @endphp 
               @if(isset($coupon)) @php $c=$coupon->meta_value; @endphp @else @php $c=0; @endphp @endif {{number_format($c)}} tk</td>
                  <td class="right">@php $sub=$subtotal=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','_line_subtotal')->sum('meta_value'); @endphp {{number_format($subtotal+$charge-$c)}} tk @php $tot_coupon+=$c; @endphp</td>
                  <td class="right">
                  <a href="{{route('pending_order_print',$orders->ID)}}" class="btn btn-success btn-sm mb-2">
                    <i class="fas fa-print"> </i> Print</a><br>
                  <a href="{{route('pending_order_edit',$orders->ID)}}" class="btn btn-info btn-sm mb-2">
                    <i class="fas fa-edit"> </i>View</a><br>
                  <a onclick="return confirm('Are you sure want to cancel this order?')" href="{{route('pending_order_cancel',$orders->ID)}}" class="btn btn-danger btn-sm"> <i class="fas fa-window-close"> </i> Cancel</a><br>
                  <a  href="{{route('cancel_order_edit',$orders->ID)}}" class="btn btn-warning btn-sm mt-2"> <i class="fas fa-window-close"> </i> Return</a><br> 
                  <a onclick="return confirm('Do you want to delivery?')" href="{{route('order_dispatch_d',$orders->ID)}}" class="btn btn-success btn-sm mt-2"> <i class="fas fa-window-close"> </i> Delivered</a>





                  </td>
                  <!-- <td class="right">hello</td> -->
                </tr>
                   @php $total_amount+=$sub;   @endphp
                @endforeach
              </tbody>
            </table>
            {{$order->links()}}
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
        <div class="col-md-6">
          <div class="box bg-primary">
            <!-- <i class="fa fa-lemon ml-1"></i> -->
            <h3 class="text-center">{{$total_order}}</h3>
            <p class="lead text-center font-weight-bold">Total Order</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box bg-info">
            <!-- <i class="fa fa-handshake ml-1"></i> -->
            <h3 class="text-center">{{number_format($total_amount+$tot_charge-$tot_coupon)}} tk</h3>
            <p class="lead text-center font-weight-bold">Total Amount</p>
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