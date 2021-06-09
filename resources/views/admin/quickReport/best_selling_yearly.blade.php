@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          <h3 class="mb-3" style="text-align:center;font-weight:bold;">Yearly Best Sell Item List</h3>
        <div class="row mb-2">
          <div class="col-sm-6">
 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Top 10 Best Selling Items</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <!-- <div class="s002">
        <div class="d-flex font-weight-bold justify-content-center h2 mb-3">Search Best Sell Items</div>
            <div class="d-flex justify-content-center">
              <form class="form-inline" method="post" action="{{route('best.selling.search')}}" >
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
            </div> -->
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
                </tr>
              </thead>
              <tbody>
			    @php $total_qty=0; $total_cost=0; $total_sale=0; @endphp
                @foreach($order as $key=>$item)
                <tr>
                  <td class="center">{{++$key}}</td>
                  <td class="center">
                  @php 
                  $sku=DB::table('postmeta')
                  ->where('post_id',$item->product_parent)
                  ->where('meta_key','_sku')
                  ->first();  
                  @endphp 

                  @if(isset($sku)) 
                    {{$sku->meta_value}}
                  @endif
                  </td>
                  <td class="left strong">{{$item->order_item_name}}</td>
                  <td class="left">
                    @php 

                    $category=DB::table('term_relationships')
                    ->where('object_id',$item->product_parent)
                    ->where('taxonomy','product_cat')
                    ->join('term_taxonomy','term_relationships.term_taxonomy_id','=','term_taxonomy.term_id')
                    ->join('terms','terms.term_id','=','term_taxonomy.term_id')
                    ->select('terms.name as cat_name')
                    ->first(); 
                    @endphp 

                    @if(isset($category)) 
                    {{$category->cat_name}} 
                    @else 
                    @php $category=''; 
                    @endphp 
                    @endif
                  
                  </td>
                  <td class="right">{{$item->total_qty}}  @php $total_qty+=$item->total_qty; @endphp</td>
                  <td class="right">
                  @php 
                   $cost=DB::table('postmeta')
                  ->where('post_id',$item->product_parent)
                  ->where('meta_key','product_stock')
                  ->first(); 
                  @endphp 
                  @if(isset($cost)) 
                    {{number_format($cost->meta_value)}}  @php $total_cost+=$cost->meta_value; @endphp tk
                  @endif
                </td>
                  <td class="right">
                    @php 
                    $price=DB::table('postmeta')
                    ->where('post_id',$item->product_parent)
                    ->where('meta_key','sale_price')
                    ->first();
                    @endphp 
                    @if(isset($price)) 
                    {{number_format($price->meta_value)}} tk @php $total_sale+=$price->meta_value; @endphp
                    @endif
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

                  <td>{{number_format($total_cost)}} tk</td>
                  <td>{{number_format($total_sale)}} tk</td>
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