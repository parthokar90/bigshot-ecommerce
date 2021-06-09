@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      @include('admin.includes.messages')
      <div class="row mb-2">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Stock</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <div class="s002">
      <form method="post" action="{{route('stock.sku.search.sold')}}">
        @csrf
        <fieldset>
          <legend>Sold Out Stock List year ({{date('Y')}})</legend>
        </fieldset>
       
      </form>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="box bg-primary">
            <!-- <i class="fa fa-lemon ml-1"></i> -->

            <h3 class="text-center">{{$total_stock}}</h3>

            <p class="lead text-center font-weight-bold">Total Stock </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box bg-success">
            <!-- <i class="fa fa-user ml-1"></i> -->


            <h3 class="text-center">
              @php $total_cost=0; $total_sale_price=0; $qty=0; $i=0; $price=0; $sprice=0; $sku=''; $total_sell_price=0; $cost=0; @endphp
              @foreach($pro as $pros)
              @php
              $total_cost+=DB::table('postmeta')
              ->where('post_id',$pros->ID)
              ->where('meta_key', 'product_stock')
              ->sum('meta_value');
              $total_sale_price+=DB::table('postmeta')
              ->where('post_id',$pros->ID)
              ->where('meta_key', 'sale_price')
              ->sum('meta_value');
              @endphp
              @endforeach
              {{$total_cost}}
            </h3>

            <p class="lead text-center font-weight-bold">Total Cost</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box bg-info">
            <!-- <i class="fa fa-handshake ml-1"></i> -->


            <h3 class="text-center">{{$total_sale_price}}</h3>

            <p class="lead text-center font-weight-bold">Total Sell Price</p>
          </div>
        </div>
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
                  <th>#</th>
                  <th>SKU</th>
                  <th>Items</th>
                  <th class="right">Categories</th>
                  <th class="center">Quantity</th>
                  <th class="right">Cost</th>
                  <th class="right">Sale Price</th>
                  <th class="right">Status</th>
                  <th class="right">Action</th>
                </tr>
              </thead>

              <tbody>
                @php $total_cost=0; $total_sale_price=0; $qty=0; $i=0; $price=0; $sprice=0; $sku=''; $total_sell_price=0; $cost=0; @endphp
                @foreach($products as $item)
                @php $product_info=DB::table('postmeta')->where('post_id',$item->ID)->get();
                @endphp
                @foreach($product_info as $info)
                @if($info->meta_key=='qty')
                @php $qty=$info->meta_value; @endphp
                @endif
                @if($info->meta_key=='sale_price')
                @php $price=$info->meta_value; @endphp
                @endif
                @if($info->meta_key=='product_stock')
                @php $cost=$info->meta_value; @endphp
                @endif
                @if($info->meta_key=='stock_status')
                @php $status=$info->meta_value; @endphp
                @endif
                  @if($info->meta_key=='attached_file')
                @php $img=$info->meta_value; @endphp
                @endif
                @if($info->meta_key=='_sku')
                @php $sku=$info->meta_value; @endphp
                @endif
                @endforeach
                @php $i++
                @endphp
                <tr>
                  <td class="center">{{$i}} </td>
                  <td class="center"><img width="50px" height="50px" src="{{asset('backend/products/'.$img)}}"></br>  {{ $sku ? $sku : 'No SKU Found' }}</td>
                  <td class="left strong">{{$item->post_title}}</td>
                  <td class="left">@php $category=DB::table('term_relationships')
                    ->where('object_id',$item->ID)
                    ->where('taxonomy','product_cat')
                    ->join('term_taxonomy','term_relationships.term_taxonomy_id','=','term_taxonomy.term_taxonomy_id')
                    ->join('terms','terms.term_id','=','term_taxonomy.term_id')
                    ->select('terms.name as cat_name')
                    ->first(); @endphp @if(isset($category)) {{$category->cat_name}} @else @php $category=''; @endphp @endif</td>
                  <td class="right">{{$qty}}</td>
                  <td class="right">{{$cost}}tk</td>
                  <td class="right">{{$price}}tk</td>
                  <td class="right">Out Of Stock </br>{{date('d-M-Y',strtotime($item->post_date))}}</td>
                  <td class="right">
                    <i class="fas fa-print"><a href="{{route('stock.print.sticker',$item->ID)}}">Print</a></i><br>
                    <i class="fas fa-edit"><a href="{{route('product.edit',$item->ID)}}">Edit</a></i><br>
                    <i class="fas fa-trash-alt"><a onclick="return confirm('are you sure??')" href="{{route('stock.deleted',$item->ID)}}">Delete</a></i><br>
                  </td>
                </tr>
                @php @endphp
                @endforeach
              </tbody>
            </table>
            {{$products->links()}}
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
        <div class="col-md-4">
          <div class="box bg-primary">
            <!-- <i class="fa fa-lemon ml-1"></i> -->

            <h3 class="text-center">{{$total_stock}}</h3>

            <p class="lead text-center font-weight-bold">Total Stock </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box bg-success">
            <!-- <i class="fa fa-user ml-1"></i> -->


            <h3 class="text-center">
              @foreach($pro as $pros)
              @php
              $total_cost+=DB::table('postmeta')
              ->where('post_id',$pros->ID)
              ->where('meta_key', 'product_stock')
              ->sum('meta_value');
              $total_sale_price+=DB::table('postmeta')
              ->where('post_id',$pros->ID)
              ->where('meta_key', 'sale_price')
              ->sum('meta_value');
              @endphp
              @endforeach
              {{$total_cost}}
            </h3>

            <p class="lead text-center font-weight-bold">Total Cost</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box bg-info">
            <!-- <i class="fa fa-handshake ml-1"></i> -->


            <h3 class="text-center">{{$total_sale_price}}</h3>

            <p class="lead text-center font-weight-bold">Total Sell Price</p>
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