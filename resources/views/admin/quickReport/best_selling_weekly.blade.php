<?php

use Carbon\Carbon; ?>
@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Best Selling Items weekly</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
          <div class="s002">
          <legend>Best Selling Items weekly</legend>
        </fieldset>
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
                  <th>#</th>
                  <th>Image</th>
                  <th>SKU</th>
                  <th>Items</th>
                  <th class="right">Categories</th>
                  <th class="center">Quantity</th>
                  <th class="right">Cost</th>
                  <th class="right">Sale Price</th>
                </tr>
              </thead>
              <tbody>
                  @php $quantity_total=0; @endphp
                @foreach($order as $key=>$item)
                  @php 
                            $date = Carbon::parse($item->order_date);
                            $now = Carbon::now();
                            $diff = $date->diffInDays($now);
                            @endphp
                               @if($diff<=7) 
                <tr>
                        <td class="center">{{++$key}}</td>
                        <td class="center">@php $img=DB::table('postmeta')->where('post_id',$item->product_id)->where('meta_key','attached_file')->first(); @endphp <img width="50px" height="50px" src="{{asset('backend/products/'.$img->meta_value)}}"></td>
                        <td class="center">@php $sku=DB::table('postmeta')->where('post_id',$item->product_id)->where('meta_key','_sku')->first(); @endphp {{$sku->meta_value}}</td>
                        <td class="left strong">{{$item->order_item_name}}</td>
                        <td class="left">@php $category=DB::table('term_relationships')
                            ->where('object_id',$item->product_id)
                            ->where('taxonomy','product_cat')
                            ->join('term_taxonomy','term_relationships.term_taxonomy_id','=','term_taxonomy.term_taxonomy_id')
                            ->join('terms','terms.term_id','=','term_taxonomy.term_id')
                            ->select('terms.name as cat_name')
                            ->first(); @endphp @if(isset($category)) {{$category->cat_name}} @else @php $category=''; @endphp @endif</td>
                        <td class="right">{{$item->total_qty}} @php $quantity_total+=$item->total_qty; @endphp</td>
                        <td class="right">@php $cost=DB::table('postmeta')->where('post_id',$item->product_id)->where('meta_key','product_stock')->first(); @endphp {{$cost->meta_value}}tk</td>
                        <td class="right">@php $price=DB::table('postmeta')->where('post_id',$item->product_id)->where('meta_key','sale_price')->first(); @endphp {{$price->meta_value}}tk</td>
                </tr>   
                @endif 
               @endforeach
              </tbody>
               <tfoot>
                    <tr>
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$quantity_total}}</td>
                    </tr>
                </tfoot>
            </table>
             </div> <div class="row">
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
  </div>
@endsection