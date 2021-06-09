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
       
    <div class="d-flex font-weight-bold justify-content-center h2 mb-3">Stock List</div>
      <div class="d-flex justify-content-center mb-3">
        <form class="form-inline" method="post" action="{{route('stock.sku.search')}}" >
          @csrf() 
          <div class="form-group mb-2">
            <label for="depart" class="mr-2">Sku</label>
            <input required type="text" class="form-control" name="product_sku" placeholder="Enter sku" autocomplete="off" />
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
                                    <th>Sku</th>
                                    <th>Items</th>
                                    <th class="right">Varient</th>
                                    <th class="center">Qty</th>
                                    <th class="right">Cost</th>
                                    <th class="right">Sale Price</th>
                                    <th class="right">Status</th>
                                    <th class="right">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                    @php $product_total_qty=0; $qty=0; $i=0; $price=0; $sprice=0; $sku=''; $total_sell_price=0; $total_cost=0; $img='';
                                @endphp
                            @foreach($products as $pro)
                               @php 
                               $img=DB::table('postmeta')->where('post_id',$pro->post_id)->where('meta_key','attached_file')->first(); 
                               $qty=DB::table('postmeta')->where('post_id',$pro->post_id)->where('meta_key','default_qty')->sum('meta_value'); 
                               $cost=DB::table('postmeta')->where('post_id',$pro->post_id)->where('meta_key','product_stock')->sum('meta_value'); 
                               $sale_price=DB::table('postmeta')->where('post_id',$pro->post_id)->where('meta_key','sale_price')->sum('meta_value'); 
                               $pro_title=DB::table('posts')->where('ID',$pro->post_id)->where('post_type','product')->first(); 
                               $skuu=DB::table('postmeta')->where('post_id',$pro->post_id)->where('meta_key','_sku')->first(); 
                               @endphp
                                <tr>
                                    <td class="center"><img width="50px" height="50px" src="{{asset('backend/products/'.$img->meta_value)}}"></br> {{$skuu->meta_value}} </td>
                                    <td class="left">{{$pro_title->post_title}}</td>
                                        <td class="right">
                                        <!-- show product attribute with current stock  -->
                                         @php 
                                        $lists=DB::table('posts')
                                        ->where('post_type','product_varient')
                                        ->where('post_parent',$pro->post_id)
                                        ->where('meta_key','attribute')
                                        ->join('postmeta','posts.ID','=','postmeta.post_id')
                                        ->select('meta_value','post_id')
                                        ->get();
                                         @endphp
                                            <table class="table table-responsive">
                                                            <tbody>
                                                            @php $i=0; @endphp 
                                                            @foreach($lists as $a) 
                                                                @php 
                                                                $i++;
                                                                $attribute=json_decode($a->meta_value);
                                                                @endphp
                                                                    <tr>
                                                                    <td>
                                                                        @foreach($attribute as $att)
                                                                        <b> {{$att->taxonomy}}</b> :
                                                                        {{$att->term}}
                                                                    
                                                                        @php $stock=DB::table('postmeta')->where('post_id',$a->post_id)->where('meta_key','attribute_stock')->first(); @endphp       
                                                                        @endforeach
                                                                    </td>
                                                                    <td>{{$stock->meta_value}}</td>
                                                                        <input type="hidden" name="post_id[]" value="{{$a->post_id}}">
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                       </table>
                                        <!-- show product attribute with current stock  -->

                                    </td>
                                    <td class="right">
                                        @if($i>0) 
                                        @php $qty=DB::table('posts')
                                        ->where('post_type','product_varient')
                                        ->where('post_parent',$pro->post_id)
                                        ->where('meta_key','attribute_stock')
                                        ->join('postmeta','posts.ID','=','postmeta.post_id')
                                        ->sum('meta_value'); @endphp @php $main_qty=$qty; @endphp  @else @php $main_qty=$qty; @endphp @endif {{$main_qty}} @php $product_total_qty+=$main_qty; @endphp
                                    </td>
                                    <td class="right">{{number_format($total_cost+=$cost)}} tk</td>
                                    <td class="right">{{number_format($total_sell_price+=$sale_price)}} tk</td>
                                    <td class="right">@if($main_qty>0) In Stock @else Out of stock @endif</td>
                                    <td class="right">
                                          <a href="{{route('stock.print.sticker',$pro->post_id)}}" class="btn btn-info"> <i
                                                class="fas fa-print"></i> Print </a> <br>
                                        <a href="{{route('product.edit',$pro->post_id)}}" class="btn btn-success mt-2 mb-2">
                                            <i class="fas fa-edit"></i> Edit</a><br>
                                    </td>
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
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="box bg-primary">
                        <!-- <i class="fa fa-lemon ml-1"></i> -->

                        <h3 class="text-center">{{$product_total_qty}}</h3>

                        <p class="lead text-center font-weight-bold">Total Stock </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box bg-success">
                        <!-- <i class="fa fa-user ml-1"></i> -->


                        <h3 class="text-center">{{number_format($total_cost)}}</h3>

                        <p class="lead text-center font-weight-bold">Total Cost</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box bg-info">
                        <!-- <i class="fa fa-handshake ml-1"></i> -->


                        <h3 class="text-center">{{number_format($total_sell_price)}}</h3>

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