@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      @include('admin.includes.messages')
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Excel Dispatch</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Excel Dispatch</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->




    <div class="s002">
    
 <div class="d-flex font-weight-bold justify-content-center h2 mb-3">All Complete Excel Dispatch</div>

  

      <div class="container">
    <div class="row">
      <div class="offset-8 col-md-2">
        <a style="text-decoration: none;" href="{{route('all_dispatch_complete')}}">
        <div class="box bg-danger">
          <h3 class="text-center">{{$total_complete}}</h3>
          <p class="lead text-center font-weight-bold">Complete</p>
        </div>
        </a>
      </div>

      <div class="col-md-2">
        <div class="box bg-success">
          <!-- <i class="fa fa-handshake ml-1"></i> -->


          <h3 class="text-center">{{$total_qty}}</h3>

          <p class="lead text-center font-weight-bold">Quantity</p>
        </div>
      </div>


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
                
              </tr>
            </thead>
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
              @php 
                $total_amount=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','_line_subtotal')->sum('meta_value');
               @endphp
              @php $total_qty=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','_qty')->sum('meta_value'); @endphp
              @endforeach
              @endforeach
              <tr>
                <td class="center"> {{$orders->ID}} Date:{{date('d-m-Y',strtotime($orders->post_date))}}</td>
                <td>{{$name}} {{$last_name}}</td>
                <td class="right">{{$phone}}</td>
                <td class="right">{{$address_one}}</td>
                <td class="right">@php $delivery_charge=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery_charge)) @php $charge=$delivery_charge->meta_value;  @endphp @else @php $charge=0; @endphp @endif {{number_format($charge)}} tk</td>
                <td class="right">@php $coupon=DB::table('order_itemmeta')->where('order_id',$orders->ID)->where('meta_key','coupon_taka')->first(); @endphp @if(isset($coupon)) @php $c=$coupon->meta_value;  @endphp @else @php $c=0; @endphp @endif {{number_format($c)}} tk</td>
                <td class="right">{{number_format($total_amount+$charge-$c)}} tk</td>
               
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



</section>
<!-- /.row -->
</div><!-- /.container-fluid -->

<!-- /.content -->
<!--  </div> -->
@endsection

@section('js')

@endsection