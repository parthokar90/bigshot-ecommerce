@extends('admin.layouts.master')
@section('content')
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
              <li class="breadcrumb-item active">Search Category wise stock List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="s002">




        <form method="get" action="{{route('women.stock')}}">
          @csrf 
        <div class="inner-form ml-5">
          <div class="input-field second-wrap">
    

          </div>
          <div class="input-field fifth-wrap">
   
          </div>
          </form>




           
 
 
    <div class="d-flex font-weight-bold justify-content-center h2 mb-3">Search Category wise stock List</div>
      <div class="d-flex justify-content-center mb-3">
        <form class="form-inline" method="get" action="{{route('women.stock')}}" >
          @csrf() 
          <div class="form-group mb-2">
            <label for="depart" class="mr-2">Chose Category</label>
               <select class="form-control js-example-basic-single" name="cat_id" required>
                @foreach($categories as $cat)
                  <option value="{{$cat->ac_id}}">{{$cat->name}}</option>
                @endforeach   
            </select>
          </div>

          <button type="submit" class="btn btn-primary mb-2">SEARCH</button>
        </form>
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
                  <!-- <th>SKU</th> -->
                  <th>Items</th>
                  <th>Attribute</th>
                  <!-- <th class="right">Categories</th> -->
                  <th class="center">Quantity</th>
                  <th class="right">Cost</th>
                  <th class="right">Sale Price</th>
                  <th class="right">Status</th>
                  <!-- <th class="right">Action</th> -->
                  </tr>
                </thead>

                <tbody>
                  @php $costs=0; $qty=0;$price=0;$tot_qty=0;$tot_cost=0; $tot_price=0; @endphp
                  @foreach($cat_pro as $pro)
                  @php $product_info=DB::table('postmeta')->where('post_id',$pro->ID)->get(); @endphp
                  @foreach($product_info as $info)
                   @if($info->meta_key=='default_qty') @php $qty=$info->meta_value; @endphp  @endif 
                   @if($info->meta_key=='sale_price') @php $price=$info->meta_value; @endphp  @endif 
                   @if($info->meta_key=='product_stock') @php $costs=$info->meta_value; @endphp  @endif 
                  @endforeach
                      <tr>
                        <!-- <td class="center">rrr</td> -->
                        <td class="left strong">{{$pro->post_title}}</td>
                        <td class="left strong">
                            @php 
                                        $lists=DB::table('posts')
                                        ->where('post_type','product_varient')
                                        ->where('post_parent',$pro->ID)
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
                        </td>
                        <!-- <td class="left">Women</td> -->
                        <td class="right">
                          @if($i>0) 
                                        @php $qty=DB::table('posts')
                                        ->where('post_type','product_varient')
                                        ->where('post_parent',$pro->ID)
                                        ->where('meta_key','attribute_stock')
                                        ->join('postmeta','posts.ID','=','postmeta.post_id')
                                        ->sum('meta_value'); @endphp @php $main_qty=$qty; @endphp  @else @php $main_qty=$qty; @endphp @endif {{$main_qty}} @php $main_qty; @endphp
                        </td>
                        <td class="right">{{number_format($cost=$costs)}} tk</td>
                        <td class="right">{{number_format($price)}} tk</td>
                        <td class="right">@if($main_qty>0) In stock @else Out of stock @endif</td>
                        @php $tot_qty+=$qty; $tot_cost+=$cost; $tot_price+=$price; @endphp
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
                  <h3 class="text-center">{{$tot_qty}}</h3>
                  <p class="lead text-center font-weight-bold">Total Stock </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box bg-success">
                  <!-- <i class="fa fa-user ml-1"></i> -->
                  <h3 class="text-center">{{number_format($tot_cost)}} tk</h3>
                  <p class="lead text-center font-weight-bold">Total Cost</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box bg-info">
                  <!-- <i class="fa fa-handshake ml-1"></i> -->
                  <h3 class="text-center">{{number_format($tot_price)}} tk</h3>
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



