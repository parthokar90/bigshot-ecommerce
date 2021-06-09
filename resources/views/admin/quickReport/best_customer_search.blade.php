@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      @include('admin.includes.messages')
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Pending Order</h1> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Best Customer List</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <div class="s002">
 



 <div class="d-flex font-weight-bold justify-content-center h2 mb-3">Search Best Customer List</div>
    <div class="d-flex justify-content-center">
      <form class="form-inline" method="post" action="{{route('best.customer.search')}}" >
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
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive-sm">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="center">#</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th class="right">Address</th>
                  <th class="center">Quantity</th>
                  <th class="right">Amount</th>
                </tr>
              </thead>
              <tbody>
			     @php $total_qty=0; $total_sale=0; @endphp
               @foreach($data as $key=>$item)
               @php $customer_name=DB::table('postmeta')
               ->where('post_id',$item->order_id)
               ->where('meta_key','first_name')
               ->first();
               $customer_mobile=DB::table('postmeta')
               ->where('post_id',$item->order_id)
               ->where('meta_key','phone')
               ->first();
                $customer_address=DB::table('postmeta')
               ->where('post_id',$item->order_id)
               ->where('meta_key','address_one')
               ->first();
               @endphp
                <tr>
                  <td rowspan="" class="center">{{++$key}}</td>
                  <td rowspan="" class="center">{{$customer_name->meta_value}}</td>
                  <td rowspan="" class="center">{{$customer_mobile->meta_value}}</td>
                  <td rowspan="" class="center">{{$customer_address->meta_value}}</td>
                  <td rowspan="" class="center">{{$item->total_qty}} @php $total_qty+=$item->total_qty; @endphp</td>
                  <td rowspan="" class="center">@php $total=DB::table('order_itemmeta')
                    ->where('customer_id',$item->customer_id)
                    ->where('meta_key','_line_subtotal')->sum('meta_value'); @endphp {{number_format($total)}} tk @php $total_sale+=$total; @endphp</td>
                    <td rowspan="" class="center">
                       @php $email=DB::table('users')->where('id',$item->customer_id)->select('email')->first();  @endphp
                    
                      <!-- <a class="btn btn-primary btn-sm" href="#">Send Sms</a> -->
                    </td>
                </tr>
                @endforeach
              </tbody>
			     <tfoot style="background: #000000;color:#ffffff">
                <tr>
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>{{$total_qty}} pcs</td>
                  <td>{{number_format($total_sale)}} tk</td>
                </tr>
              </tfoot>
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