<?php 
use App\Model\front\Order_item;
?>
@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Pending Order</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Delivery Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="s002">
      <div class="d-flex font-weight-bold justify-content-center h2 mb-3">Search Delivery Report</div>
    <div class="d-flex justify-content-center">
      <form class="form-inline" method="get" action="{{route('delivery.report')}}" >
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
              <table class="table ">
                <thead>
                  <tr>
                  <th class="center">#</th>
                  <th>Order Id</th>
                  <!-- <th>SKU</th> -->
                  <!-- <th class="right">Color</th> -->
                  <th class="center">Order Date</th>
                  <!-- <th class="right">Status</th> -->
                  <th class="right">Action</th>
                  <!-- <th class="right">Action</th> -->
                  <!-- <th class="right">Comments</th> -->
                  </tr>
                </thead>

                <tbody>
                  @foreach($order_item as $key=>$item) 
                  <tr>
                  <td class="center">{{++$key}}</td>
                  <td class="left strong">{{$item->ID}}</td>
                  <td class="right">{{date('d-M-Y',strtotime($item->post_date))}}</td>
                  <!-- <td class="right">{{$item->post_status}}</td> -->
                  <td class="right"><a href="{{url('order/edit/'.$item->ID)}}" class="btn btn-success btn-sm" href="">View Details</a></td>
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
      <!-- <div class="container">
        <div class="row">
           <div class="col-md-4">
                <div class="box bg-primary">
           
                 
                  <h3 class="text-center">44</h3>
                 
                  <p class="lead text-center font-weight-bold">Total Order</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box bg-success">
           
                 
                 
                  <h3 class="text-center">5</h3>
                 
                  <p class="lead text-center font-weight-bold">Total Item</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box bg-info">
           
                  
                 
                  <h3 class="text-center"> 200</h3>
                  
                  <p class="lead text-center font-weight-bold">Total Amount</p>
                </div>
              </div>
        </div>       
            
      </div> -->
    </section>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
   
    <!-- /.content -->
 <!--  </div> -->
@endsection

@section('js')

@endsection