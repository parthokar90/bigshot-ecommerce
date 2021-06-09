<?php

use App\Model\front\Order_item;
?>
@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <section class="content-header">
        <div class="container-fluid">
        </div>
        <div class="s002">
    <div class="d-flex font-weight-bold justify-content-center h2 mb-3"></div>
                   <div class="card-body">
        <h1 class="mb-3" style="text-align:center;font-weight:bold;">All Delivery Invoice</h1>
      <div class="container">
         @include('admin.includes.messages')
        <ul class="nav bg-dark d-flex justify-content-around">
         <li class="nav-item" style="border-right: 1px solid white;">
          <a  class="nav-link" href="{{route('order.allStatus')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">All Status({{$total_order_admin}})</a>
        </li>
        <li class="nav-item " style="border-right: 1px solid white;">
          <a class="nav-link"  href="{{route('order.pendingOrder')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Sales ({{$pending_order}})</a>
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
        <li class="nav-item bg-primary" style="border-right: 1px solid white;">
          <a  class="nav-link active" href="{{route('order.delivery.invoice')}}" style="color: aliceblue" tabindex="-1" aria-disabled="true">Delivery Invoice</a>
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
      <div class="d-flex justify-content-center mb-3">
        <form class="form-inline" method="get" action="{{route('order.delivery.invoice.data')}}" >
          <div class="form-group mb-2">
            <label for="depart" class="mr-2">Delivery Company</label>
            <input  type="text" class="form-control" name="delivery_company" placeholder="Delivery Company" />
          </div>

           <div class="form-group mb-2">
            <label for="depart" class="mr-2">Order Id</label>
            <input  type="text" class="form-control" name="order_id" placeholder="Scanner or Order Id" />
          </div>

          <div class="form-group mb-2">
            <label for="depart" class="mr-2 ml-2"> Date</label>
            <input  type="date" class="form-control" name="order_date" placeholder="Scanner or Order Id" />
          </div>

          <button type="submit" class="btn btn-primary mb-2">SEARCH</button>
        </form>
      </div>
    </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm">
                      <h5 class="text-center">{{$search_title}}</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">Invoice Number</th>
                                    <th>Order Date</th>
                                    <th>Modified Date</th>
                                    <th>Delivery Company</th>
                                    <th class="right">Download</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($order as $key=>$item)
                             <tr>
                              <td> <a class="btn btn-success" href="{{url('order/edit'.'/'.$item->ID)}}"> {{$item->ID}}</a></td>
                               <td>{{date('d-m-Y',strtotime($item->post_date))}}</td>
                               <td>{{date('d-m-Y',strtotime($item->post_modified))}}</td>
                               <td>{{$item->post_content_filtered}}</td>
                               <td><a class="btn btn-primary" href="{{url('delivered/print'.'/'.$item->ID)}}">Invoice</a></td>
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
</div>
@endsection
@section('js')
@endsection