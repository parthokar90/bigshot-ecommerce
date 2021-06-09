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
            <li class="breadcrumb-item active">Lower Stock</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <div class="s002">
      <form method="post" action="{{route('stock.sku.search.lower')}}">
        @csrf
        <fieldset>
          <legend class="text-center"><b>Lower Stock List</b></legend>
        </fieldset>
       
      </form>

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
                  <th>Items</th>
                  <th class="center">Quantity</th>
                  <th class="center">Alert Quantity</th>
                  <th class="center">Action</th>
                </tr>
              </thead>
              <tbody>

              <!-- default product start -->
              @php $alert_quantity=0; $i=0; $j=0; @endphp  
              @foreach($d_pro as $dp) 
                @foreach($dp->productMeta as $dmeta) 
                   @if($dmeta->meta_key=='alert_qty') @php $alert_quantity=$dmeta->meta_value; @endphp @endif
                @endforeach
                @php 
                 $low_product_default=DB::SELECT("SELECT * FROM `postmeta` WHERE `meta_key` LIKE 'default_qty' AND post_id=$dp->post_id AND meta_value<=$alert_quantity");
                @endphp

                @foreach($low_product_default as $low)
                   
                              <tr>
                                <td class="center">@php $name=DB::table('posts')->where('ID',$low->post_id)->first(); @endphp {{$name->post_title}}</td>
                                <td class="left strong">@php $qty=DB::table('postmeta')->where('post_id',$low->post_id)->where('meta_key','default_qty')->first(); @endphp {{$qty->meta_value}}</td>
                                <td class="left strong">{{$alert_quantity}}</td>
                                <td><a href="{{route('product.edit',$low->post_id)}}" class="btn btn-success mt-2">  <i class="fas fa-edit"></i> Edit</a></td>
                              </tr>
                              @php $i++; @endphp
                @endforeach
              @endforeach
              <!-- default product end -->



                <!-- attribute product start -->
              @php $alert_quantity=0; @endphp  
              @foreach($a_pro as $dp) 
                @foreach($dp->productMeta as $dmeta) 
                   @if($dmeta->meta_key=='attribute_low_stock') @php $alert_quantity=$dmeta->meta_value;  @endphp @endif
                @endforeach
                @php 
                 $low_product_att=DB::SELECT("SELECT * FROM `postmeta` WHERE `meta_key` LIKE 'attribute_stock' AND post_id=$dp->post_id AND meta_value<=$alert_quantity");
                @endphp

                @foreach($low_product_att as $low)
                     @php $j++; @endphp
                              <tr>
                                <td class="center">@php 
                                  $parent=DB::table('posts')
                                  ->where('ID',$low->post_id)
                                  ->select('post_parent')
                                  ->first(); 
                                  $name=DB::table('posts')->where('ID',$parent->post_parent)->first(); 
                                  @endphp @if(isset($name)) {{$name->post_title}} @endif
                                
                                     @php 
                                        $lists=DB::table('postmeta')
                                        ->where('post_id',$low->post_id)
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

                                <td class="left strong">
                                  @php 
                                  $qty=DB::table('postmeta')
                                  ->where('post_id',$low->post_id)
                                  ->where('meta_key','attribute_stock')
                                  ->first(); 
                                  @endphp {{$qty->meta_value}}</td>

                                <td class="left strong">{{$alert_quantity}}</td>
                                <td><a href="{{route('product.edit',$parent->post_parent)}}" class="btn btn-success mt-2">  <i class="fas fa-edit"></i> Edit</a></td>
                                </td>
                              </tr>
                @endforeach
              @endforeach
              <!-- attribute product end -->
                    
                              
         
                            
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
           
        
        
            </div>
        </div>
  </section>
</div>
@endsection
