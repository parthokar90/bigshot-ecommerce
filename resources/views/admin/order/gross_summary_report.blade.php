
@extends('admin.layouts.master')
@section('content')
<style>
.items_ul li{
 list-style: none;
    font-size: 16px;
    font-weight: bold;
}
</style>
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
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Gross profit</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <div class="s002">

            <div class="d-flex font-weight-bold justify-content-center h2 mb-3">Search Gross profit Summary</div>
            <div class="d-flex justify-content-center">
                <form class="form-inline" method="post" action="{{route('grossSummaryShow')}}" >
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
         <div class="container mt-3 text-center">
        <h2>Summary</h2>
        <hr style="border:1px solid black; width:150px; margin-top: -5px; margin: auto;">
         <div class="d-flex flex-row mt-5">
            <div class="col-md-4">
              
            </div>
            <div class="col-md-4">
                <span>{{date('d-m-Y',strtotime($start))}} TO {{date('d-m-Y',strtotime($end))}}</span>
            </div>
            <div class="col-md-4">
                
            </div>
         </div>
         <!-- table start -->
         <table class="table table-bordered mt-5">
            <thead  style="background-color: #BFBFBF; border: 1px solid black;">
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
                <th scope="col">Sales Amount</th>
                <th scope="col">Cost</th>
              </tr>
            </thead>
            <tbody style="border: transparent;">
            @php $total_delivery=0; $total_discount=0; $total_qtyy=0; $total_sales_amount=0; $total_costs_amount=0; @endphp
            @foreach($order as $orders)
                @php $order_qty=0; $order_sale_amount=0; $order_cost_amount=0; @endphp
              <tr style="font-size: 14px;">
                <td>{{date('d-m-Y',strtotime($start))}} <br> TO <br> {{date('d-m-Y',strtotime($end))}} </td>
                <td>
                    {{  $orders->category_name}} 
                </td>
                <!-- qty -->
                <td>
                   @php 
                    $category_product=DB::table('term_relationships')
                    ->where('term_taxonomy_id',$orders->cat_id)
                    ->join('order_items','order_items.product_parent','=','term_relationships.object_id')
                    ->where('post_status','!=','cancelled')
                    ->join('posts','posts.ID','=','order_items.order_id')
                    ->select('order_id','product_parent')
                    ->groupBy('term_taxonomy_id','ID')
                    ->get();
                   @endphp

                   @foreach($category_product as $product)    
                           @php 
                           $qty=DB::table('order_itemmeta')
                          ->where('order_id',$product->order_id) 
                          ->where('product_parent',$product->product_parent) 
                          ->where('meta_key','_qty')
                          ->sum('meta_value');
                          @endphp   
                          @php $order_qty+=$qty; @endphp     
                   @endforeach
                   {{$order_qty}} pcs @php $total_qtyy+=$order_qty; @endphp
                  </td>
                <!-- qty -->

                <!-- sale amount -->
                <td>
                  @foreach($category_product as $product)    
                           @php 
                           $sale_amount=DB::table('order_itemmeta')
                          ->where('order_id',$product->order_id) 
                          ->where('product_parent',$product->product_parent) 
                          ->where('meta_key','_line_subtotal')
                          ->sum('meta_value');
                          @endphp   
                          @php $order_sale_amount+=$sale_amount; @endphp     
                   @endforeach
                   {{number_format($order_sale_amount)}} Tk @php $total_sales_amount+=$order_sale_amount; @endphp
                </td>
               <!-- sale amount -->

                <!-- cost amount -->
                <td>
                  @foreach($category_product as $product)    
                           @php 
                           $cost_amount=DB::table('order_itemmeta')
                          ->where('order_id',$product->order_id) 
                          ->where('product_parent',$product->product_parent) 
                          ->where('meta_key','order_product_cost')
                          ->join('posts','posts.ID','=','order_itemmeta.order_id')
                          ->sum('meta_value');
                          @endphp   
                          @php $order_cost_amount+=$cost_amount; @endphp  
                   @endforeach
                   {{number_format($order_cost_amount)}} Tk @php $total_costs_amount+=$order_cost_amount; @endphp                
                </td>
               <!-- cost amount -->
              </tr>
            @endforeach 
            </tbody>

             @foreach($order_two as $two)
                  <!-- delivery charge -->
                     @php
                      $charge=DB::table('order_itemmeta')
                      ->where('order_id',$two->ID)
                      ->where('meta_key','delivery_charge')
                      ->first();
                     @endphp
                  <!-- delivery charge -->   
                   <!-- coupon -->
                     @php
                      $coupon=DB::table('order_itemmeta')
                      ->where('order_id',$two->ID)
                      ->where('meta_key','coupon_taka')
                      ->first();
                     @endphp
                  <!-- coupon --> 
                  @if(isset($charge))  @php $delivery_charge=$charge->meta_value; @endphp @else @php $delivery_charge=0; @endphp  @endif 
                  @if(isset($coupon))  @php $discount=$coupon->meta_value; @endphp @else @php $discount=0; @endphp  @endif 
     
                 @php $total_delivery+=$delivery_charge; @endphp
                 @php $total_discount+=$discount; @endphp
             @endforeach 
  

            <tfoot style="border: transparent; background-color:#BFBFBF;">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Total</th>
                    <th scope="col">{{$total_qtyy}} pcs</th>
                    <th scope="col">{{number_format($total_sales_amount)}} Tk</th>
                    <th scope="col">{{number_format($total_costs_amount)}} Tk</th>
                  </tr>
            </tfoot>
          </table>
          <ul class="items_ul">
            <li>Sales amount: {{number_format($total_sales_amount)}} Tk</li>
            <li>Delivery Charge:(+) {{number_format($total_delivery)}} Tk</li>
            <li>Coupon:(-) {{number_format($total_discount)}} Tk</li>
            <li>Total Cost:(-) {{number_format($total_costs_amount)}} Tk</li>
            <li>Profit: @php $profit=$total_sales_amount+$total_delivery-$total_discount-$total_costs_amount; @endphp {{number_format($profit)}} Tk</li>
          </ul>
      </div>
    
    </section>
</div>
@endsection
