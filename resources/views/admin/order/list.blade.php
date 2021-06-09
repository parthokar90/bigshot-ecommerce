@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Order List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Order History</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('admin.includes.messages')
      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Order</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <ul class="nav" style="background: #007bff;">
                <li class="nav-item " style="border-right: 1px solid white;">
                  <a class="nav-link"  href="{{route('order.pendingOrder')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Pending Order({{$pending_order}})</a>
                </li>
                  <li class="nav-item " style="border-right: 1px solid white;">
                  <a class="nav-link"  href="{{route('order.pendingOrder')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Sales({{$pending_order}})</a>
                </li>
                <li class="nav-item" style="border-right: 1px solid white;">
                  <a class="nav-link"  href="{{route('order.processing')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Processing({{$processing_order}})</a>
                </li>
                <li class="nav-item" style="border-right: 1px solid white;">
                  <a  class="nav-link" href="{{route('order.dispat')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Dispatch({{$dispatch_order}})</a>
                </li>
                <li class="nav-item" style="border-right: 1px solid white;">
                  <a  class="nav-link" href="{{route('order.excel.dispatch')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Excel Dispatch</a>
                </li>
                <li class="nav-item" style="border-right: 1px solid white;">
                  <a  class="nav-link" href="{{route('order.delivery.invoice')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Delivery Invoice</a>
                </li>
                <li class="nav-item" style="border-right: 1px solid white;">
                  <a class="nav-link" href="{{route('order.deliver')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Delivered({{$delivered_order}})</a>
                </li>
                <li class="nav-item" style="border-right: 1px solid white;">
                  <a  class="nav-link" href="{{route('order.cancelled')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Cancelled({{$cancelled_order}})</a>
                </li>
                <li class="nav-item" style="border-right: 1px solid white;">
                  <a  class="nav-link" href="{{route('order.allStatus')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">All Status({{$total_order_status}})</a>
                </li>
              </ul>
            </div>
            <div class="d-flex justify-content-center">
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection