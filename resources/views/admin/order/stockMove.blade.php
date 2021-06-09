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

</section>
<!-- Main content -->
<section class="content">
  <div class="container">
    <div class="card">

      <div class="card-body">
           <h3 class="mb-3" style="text-align:center;font-weight:bold;">Stock Item List</h3>
        <div class="table-responsive-sm">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>SKU</th>
                <th>Items</th>
                <th class="center">Quantity</th>
                <th class="right">Cost</th>
                <th class="right">Sale Price</th>
                <th class="right">Action</th>
              </tr>
            </thead>

            <tbody>
              @php $img=''; $sku=''; $qty=0; $cost=0; $sale_price=0; $total_stock=0; $total_cost=0; $total_sale_price=0; @endphp
              @foreach($default as $d)
              @foreach($d->productMeta as $meta)
               @if($meta->meta_key=='attached_file') @php $img=$meta->meta_value; @endphp @endif
               @if($meta->meta_key=='_sku') @php $sku=$meta->meta_value; @endphp @endif
               @if($meta->meta_key=='default_qty') @php $qty=$meta->meta_value; @endphp @endif
               @if($meta->meta_key=='product_stock') @php $cost=$meta->meta_value; @endphp @endif
               @if($meta->meta_key=='sale_price') @php $sale_price=$meta->meta_value; @endphp @endif
              @endforeach
              <tr>
                <td class="center"><img width="50px" height="50px" src="{{asset('backend/products/'.$img)}}"></br> {{$sku}}</td>
                <td class="left strong">{{$d->post_title}}</td>
                <td class="left">{{$qty}} @php $total_stock+=$qty; @endphp</td>
                  <td class="right">{{number_format($cost)}} tk @php $total_cost+=$cost; @endphp</td>
                  <td class="right">{{number_format($sale_price)}} tk @php $total_sale_price+=$sale_price; @endphp</td>
                  <td class="right">
                    <a href="{{route('product.edit',$d->ID)}}" class="btn btn-success mt-2 mb-2"> <i class="fas fa-edit"></i> Edit</a><br>
                  </td>
                </tr>
                @endforeach 

                @php $parent=0; $namee=''; $imgg=''; $skuu=0; $qtyy=0; $costt=0; $sale_pricee=0; $total_stockk=0; $total_costt=0; $total_sale_pricee=0; @endphp
                @foreach($attribute as $a)
                @php 
                  $parent=DB::table('posts')->where('ID',$a->ID)->select('post_parent')->first(); 
                  $namee=DB::table('posts')->where('ID',$parent->post_parent)->first(); 
                  $imgg=DB::table('postmeta')->where('post_id',$parent->post_parent)->where('meta_key','attached_file')->first(); 
                  $skuu=DB::table('postmeta')->where('post_id',$parent->post_parent)->where('meta_key','_sku')->first(); 
                  $qtyy=DB::table('postmeta')->where('post_id',$a->ID)->where('meta_key','attribute_stock')->first(); 
                  $costt=DB::table('postmeta')->where('post_id',$parent->post_parent)->where('meta_key','product_stock')->first(); 
                  $sale_pricee=DB::table('postmeta')->where('post_id',$parent->post_parent)->where('meta_key','sale_price')->first(); 
                @endphp
                 <tr>
                <td class="center"><img width="50px" height="50px" src="{{asset('backend/products/'.$imgg->meta_value)}}"></br> {{$skuu->meta_value}}</td>
                <td class="left strong">
                  {{$namee->post_title}} 
                   @php 
                   $lists=DB::table('postmeta')
                   ->where('post_id',$a->ID)
                   ->where('meta_key','attribute')
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
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                       </table>
                </td>
                <td class="left">{{$qtyy->meta_value}} @php $total_stockk+=$qtyy->meta_value; @endphp</td>
                  <td class="right">{{number_format($costt->meta_value)}} tk @php $total_costt+=$costt->meta_value; @endphp</td>
                  <td class="right">{{number_format($sale_pricee->meta_value)}} tk @php $total_sale_pricee+=$sale_pricee->meta_value; @endphp</td>
                  <td class="right">
                    <a href="{{route('product.edit',$parent->post_parent)}}" class="btn btn-success mt-2 mb-2"> <i class="fas fa-edit"></i> Edit</a><br>
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
            <h3 class="text-center">{{$total_stock+$total_stockk}}</h3>

            <p class="lead text-center font-weight-bold">Total Stock </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box bg-success">
            <!-- <i class="fa fa-user ml-1"></i> -->


            <h3 class="text-center">{{number_format($total_cost+$total_costt)}} tk</h3>

            <p class="lead text-center font-weight-bold">Total Cost</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box bg-info">
            <!-- <i class="fa fa-handshake ml-1"></i> -->


            <h3 class="text-center">{{number_format($total_sale_price+$total_sale_pricee)}} tk</h3>

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