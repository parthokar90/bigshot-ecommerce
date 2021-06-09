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
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
    <div class="card-body">
        <h1 class="mb-3" style="text-align:center;font-weight:bold;">All Order Status</h1>
         
      <div class="container">
         @include('admin.includes.messages')
        <ul class="nav bg-dark d-flex justify-content-around">
         <li class="nav-item bg-primary" style="border-right: 1px solid white;">
          <a  class="nav-link active" href="{{route('order.allStatus')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">All Status({{$count_order}})</a>
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
    <div class="d-flex justify-content-center h2 mb-3">Search Order</div>
    <div class="d-flex justify-content-center mb-3">
      <form class="form-inline" method="post" action="{{route('order.all.status.search')}}">
      @csrf 
        <div class="form-group mb-2">
          <label for="depart" class="mr-2"> Search Order</label>
          <input  type="text" class="form-control" name="search_item" placeholder="Order Id or Mobile or Email" />
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

      <div class="card-body">

       <h5 class="text-center">{{ $search_title}}</h5>
        <div class="table-responsive-sm">
          <table class="table table-striped">
            <thead>
              <tr class="text-center">
                <th class="center">Oder Id</th>
                <th class="center">Cust.Info</th>
                <th class="right">Quantity</th>
                <th class="right">Delivery Charge</th>
                <th class="right">Coupon</th>
                <th class="right">Amount</th>
                <th class="right">Status</th>
                <th class="right">Action</th>
              </tr>
            </thead>

            <tbody>
              @php $email=''; $first_name=''; $last_name=''; $address=''; $phone=''; $subtotal=0; $total_amount=0; @endphp
              @foreach($order as $orders)

              @foreach($orders->productMeta as $meta)
              @if($meta->meta_key=='first_name') @php $name=$meta->meta_value; @endphp @endif
              @if($meta->meta_key=='last_name') @php $last_name=$meta->meta_value; @endphp @endif
              @if($meta->meta_key=='address_one') @php $address_one=$meta->meta_value; @endphp @endif
              @if($meta->meta_key=='phone') @php $phone=$meta->meta_value; @endphp @endif
              @if($meta->meta_key=='email') @php $email=$meta->meta_value; @endphp @endif
              @endforeach
              @foreach($orders->orderItem as $info)
              @foreach($info->orderMeta as $value)
              @if($value->meta_key=='_line_subtotal')
              @php $subtotal=$value->meta_value; @endphp
              @endif
              @endforeach
              @endforeach
              <tr style="background: #ffffff;">
                <td class="center text-center">{{$orders->ID}}
                  <hr style="border: 0.1px solid black" class="m-0 p-0"> 
                  {{date('d-m-Y',strtotime($orders->post_date))}}
                </td>
                 <td style="text-align:center">
                  {{$name}} {{$last_name}}<br>
                  {{$phone}}<br> 
                  {{$email}}
                </td>
                <td class="right">@php $qty=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','_qty')->sum('meta_value'); @endphp {{$qty}} pcs</td>
                <td class="right">@php $delivery=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery)) @php $charge=$delivery->meta_value; @endphp @else @php $charge=0; @endphp @endif {{number_format($charge)}} tk</td>
                <td class="right">@php $coupon=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','coupon_taka')->first(); @endphp @if(isset($coupon)) @php $c=$coupon->meta_value; @endphp @else @php $c=0; @endphp @endif {{number_format($c)}} tk</td>
                <td class="right">@php $sub=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','_line_subtotal')->sum('meta_value'); @endphp {{number_format($sub+$charge-$c)}} tk</td>
                <td class="right">
                      @php $current_status=$orders->post_status; @endphp
                      @if($current_status=='on-hold') 
                        <span class="pending">Pending</span>
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
                <td class="text-center">
                  <a href="{{route('order.allStatus.print',$orders->ID)}}" class="btn btn-success mb-2"> <i class="fas fa-print"> </i> Print</a><br>
                  <a href="{{route('pending_order_edit',$orders->ID)}}" class="btn btn-warning"> <i class="fas fa-edit"> </i> @if($orders->post_status=='on-hold') Edit @else View @endif</a><br>
                  <a href="{{route('download.shipping.address',$orders->ID)}}" class="btn btn-info btn-sm mt-2"> <i class="fas fa-edit"> </i> Shipping Address</a><br>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
           {{ $order->appends(Request::all())->links() }}
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

@endsection