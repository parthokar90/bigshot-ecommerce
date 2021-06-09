<?php 
use App\Model\front\Order_item;
?>
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
            <li class="breadcrumb-item active">Order Detail</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <div class="d-flex font-weight-bold justify-content-center h2 mb-3">Order Details</div>
    <!-- <div class="d-flex justify-content-center">
            <form class="form-inline" method="post" action="{{route('s_pending_order')}}" >
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
    </div> -->
  </section>
  <section class="content">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive-sm">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="center">Oder Id</th>
                  <th>Items</th>
                  <th>Attribute</th> 
                  <th>Qty</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 @foreach($orders as $items)
                <tr>
                  <td>{{$items->ID}}</td>
                  <td>
                  @foreach($items->orderItem as $pro_name)
                    <table style="width:100%;">
                      <tr>
                        <td>{{$pro_name->order_item_name}}</td>
                      </tr>
                    </table>
                  @endforeach 
                  </td>
                  <td>



 @foreach($items->orderItem as $pro_name)
                    <table style="width:100%;">
                      <tr>
                        <td>

@php 
                           $lists=DB::table('postmeta')
                           ->where('post_id',$pro_name->product_id)
                            ->where('meta_key','attribute')
                            ->select('meta_value','post_id')
                            ->get();
                          @endphp
                            @foreach($lists as $a) 
                                @php 
                                  $attribute=json_decode($a->meta_value);
                                @endphp
                                   @foreach($attribute as $att)     
                          {{$att->taxonomy}} : {{$att->term}}
                      @endforeach 
                            @endforeach 



                        </td>
                      </tr>
                    </table>
                  @endforeach 
                  </td>


                  <td>



   @foreach($items->orderItem as $pro_name)
                    <table style="width:100%;">
                      <tr>
                        <td>
                           @foreach($pro_name->orderMeta as $meta)
                         @if($meta->meta_key=='_qty') 
                           @php $quantity=$meta->meta_value; @endphp 
                         @endif
                      @endforeach
                      {{$quantity}}
                        </td>
                      </tr>
                    </table>
                  @endforeach 


                  
                  </td>








                  <td>
                       <a href="{{route('pending_order_print',$items->ID)}}" class="btn btn-success"> <i class="fas fa-print"> </i> Print</a>
                    <a href="{{route('pending_order_edit',$items->ID)}}" class="btn btn-warning"> <i class="fas fa-edit"> </i>Details</a>
                  </td>
                </tr>
                @endforeach 
              </tbody>
              {{$orders->links()}}
            </table>
          </div>
        </div>
      </div>
    </div>
</section>
</div>
@endsection
@section('js')
@endsection