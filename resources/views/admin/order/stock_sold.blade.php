@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
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
    </div>
    <div class="s002">
      <form method="post" action="{{route('stock.sku.search.sold')}}">
        @csrf
        <fieldset>
          <legend class="text-center">Sold Out Stock List</legend>
        </fieldset>
      </form>
    </div>

 @php $total_sale_ii=0; $total_sale_jj=0; $total_cost_ii=0; $total_cost_jj=0; $ii=0;$jj=0; @endphp
 @foreach($default_product as $dpro) 
                     @php 
                      $cost=DB::table('postmeta')
                      ->where('post_id',$dpro->post_id)
                      ->where('meta_key','product_stock')
                      ->first(); 
                      $sale_price=DB::table('postmeta')
                      ->where('post_id',$dpro->post_id)
                      ->where('meta_key','sale_price')
                      ->first(); 
                   @endphp
 @php $ii++; $total_sale_ii+=$sale_price->meta_value; $total_cost_ii+=$cost->meta_value; @endphp
 @endforeach 

 @foreach($attribute_product as $apro) 
    @php 
                     $parent_id=DB::table('posts')
                    ->where('ID',$apro->post_id)
                    ->select('post_parent')->first();
                      $cost=DB::table('postmeta')
                      ->where('post_id',$parent_id->post_parent)
                      ->where('meta_key','product_stock')
                      ->first(); 
                      $sale_price=DB::table('postmeta')
                      ->where('post_id',$parent_id->post_parent)
                      ->where('meta_key','sale_price')
                      ->first();
                    @endphp
 @php $jj++; $total_sale_jj+=$sale_price->meta_value; $total_cost_jj+=$cost->meta_value; @endphp
 @endforeach 



    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="box bg-primary">
            <h3 class="text-center">{{$ii+$jj}}</h3>
            <p class="lead text-center font-weight-bold">Total Sold Out </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box bg-success">
            <h3 class="text-center">
                  {{number_format($total_cost_ii+$total_cost_jj)}} tk
            </h3>
            <p class="lead text-center font-weight-bold">Total Cost</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box bg-info">
            <h3 class="text-center">{{number_format($total_sale_ii+$total_sale_jj)}} tk</h3>
            <p class="lead text-center font-weight-bold">Total Sell Price</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive-sm">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>SKU</th>
                  <th>Items</th>
                  <th class="center">Quantity</th>
                  <th class="right">Cost</th>
                  <th class="right">Sale Price</th>
                  <th class="right">Status</th>
                  <th class="right">Action</th>
                </tr>
              </thead>

              <tbody>
                @php $total_sale_i=0; $total_sale_j=0; $total_cost_i=0; $total_cost_j=0; $i=0;$j=0; @endphp
          
                @foreach($default_product as $dpro) 
                   @php 
                      $name=DB::table('posts')->where('ID',$dpro->post_id)->select('post_title')->first(); 
                      $img=DB::table('postmeta')
                      ->where('post_id',$dpro->post_id)
                      ->where('meta_key','attached_file')
                      ->first(); 
                       $sku=DB::table('postmeta')
                      ->where('post_id',$dpro->post_id)
                      ->where('meta_key','_sku')
                      ->first(); 
                      $cost=DB::table('postmeta')
                      ->where('post_id',$dpro->post_id)
                      ->where('meta_key','product_stock')
                      ->first(); 
                      $sale_price=DB::table('postmeta')
                      ->where('post_id',$dpro->post_id)
                      ->where('meta_key','sale_price')
                      ->first(); 
                   @endphp
                      <tr>

                      <td class="center"><img width="50px" height="50px" src="{{asset('backend/products/'.$img->meta_value)}}"></br>  Sku: {{$sku->meta_value}}</td>
                      <td class="left strong">{{$name->post_title}}</td>
                 
                      <td class="right">0</td>
                      <td class="right">{{number_format($cost->meta_value)}} tk</td>
                      <td class="right">{{number_format($sale_price->meta_value)}} tk</td>
                      <td class="right">Out Of Stock</td>
                      <td class="right">

                       <a href="{{route('product.edit',$dpro->post_id)}}" class="btn btn-success mt-2">  <i class="fas fa-edit"></i> Edit</a><br>
                      </td>
                    </tr>
                    @php $i++; $total_sale_i+=$sale_price->meta_value; $total_cost_i+=$cost->meta_value; @endphp
                @endforeach

                 @foreach($attribute_product as $apro) 
                    @php 
                     $parent_id=DB::table('posts')
                    ->where('ID',$apro->post_id)
                    ->select('post_parent')->first();
                     $name=DB::table('posts')->where('ID',$parent_id->post_parent)->select('post_title')->first();
                       $img=DB::table('postmeta')
                      ->where('post_id',$parent_id->post_parent)
                      ->where('meta_key','attached_file')
                      ->first(); 
                        $sku=DB::table('postmeta')
                      ->where('post_id',$parent_id->post_parent)
                      ->where('meta_key','_sku')
                      ->first(); 
                      $cost=DB::table('postmeta')
                      ->where('post_id',$parent_id->post_parent)
                      ->where('meta_key','product_stock')
                      ->first(); 
                      $sale_price=DB::table('postmeta')
                      ->where('post_id',$parent_id->post_parent)
                      ->where('meta_key','sale_price')
                      ->first();
                    @endphp
                      <tr>
                      <td class="center"><img width="50px" height="50px" src="{{asset('backend/products/'.$img->meta_value)}}"></br>  Sku: {{$sku->meta_value}}</td>
                      <td class="left strong">{{$name->post_title}}
                           @php 
                          $lists=DB::table('postmeta')
                          ->where('post_id',$apro->post_id)
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
                
                      <td class="right">0</td>
                      <td class="right">{{number_format($cost->meta_value)}} tk</td>
                      <td class="right">{{number_format($sale_price->meta_value)}} tk</td>
                      <td class="right">Out Of Stock</td>
                      <td class="right">
        


             
                        <a href="{{route('product.edit',$parent_id->post_parent)}}" class="btn btn-success mt-2"><i class="fas fa-edit"></i> Edit</a><br>

                      </td>
                    </tr>
                   @php $j++; $total_sale_j+=$sale_price->meta_value; $total_cost_j+=$cost->meta_value; @endphp
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

