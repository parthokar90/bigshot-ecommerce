@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <section class="content-header">
    <div class="container-fluid">



<div class="card-body">
       <h1 class="mb-3" style="text-align:center;font-weight:bold;">Reject Item Quantity</h1>
  
  </div>

      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Reject</li>
          </ol>
        </div>
      </div>
    </div>
    <div class="s002">
    </div>
  </section>
  <section class="content">
    <div class="container">
      <div class="card">
        <div class="card-body">
              @include('admin.includes.messages')
          <form role="form" class="form-inline text-center" method="get" action="{{route('order.reject')}}">
            <div class="form-group  mx-sm-3 col-sm-6">
              <input type="text" name="sku" style="width: 100%" class="form-control" id="sku" placeholder="Scan/search" required>
            </div>
            <div class="form-group  mx-sm-3">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Search</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    @php $a_stock=0;$d_stock=0; $i=0; $tott_stock=0; $stock=0; @endphp
    <form role="form" method="POST" action="{{route('reject.update')}}" enctype="multipart/form-data">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <div class="row mb-4">
            </div>
            {{csrf_field()}}
            <div class="card-body">

              <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                @if(isset($meta_info))
                <tbody>
                  <tr>
                    <td><img width="50px" height="50px" src="{{asset('backend/products/'.$img->meta_value)}}">
                     </br>{{$meta_info->meta_value}} </br> </td>
                    <td>
                      @if(isset($relationShips))
                        {{$relationShips->name}}
                      @endif
                    </td>
                    <td>
                       @if($lists->count()>0)
                          <table class="table table-responsive">
                                  <tbody>
                                          @php $i=0; @endphp 
                                           @foreach($lists as $a) 
                                            @php 
                                            $i++;
                                            $attribute=json_decode($a->meta_value);
                                            @endphp
                                        @foreach($attribute as $att)
                                         @php $stockk=DB::table('postmeta')->where('post_id',$a->post_id)->where('meta_key','attribute_stock')->first(); @endphp       
                                        @endforeach
                                        @if($stockk->meta_value>0)
                                            <tr>
                                             <td>
                                              @foreach($attribute as $att)
                                              <b> {{$att->taxonomy}}</b> :
                                              {{$att->term}}
                                              @php $stock=DB::table('postmeta')->where('post_id',$a->post_id)->where('meta_key','attribute_stock')->first(); @endphp       
                                              @endforeach
                                             </td>
                                             <td>Qty: {{$stock->meta_value}} <input style="width:70px" max="{{$stock->meta_value}}" min="0" step="1"  type="number" name="stock[]"></td>
                                             <input type="hidden" name="post_id[]" value="{{$a->post_id}}">
                                             </tr>
                                             @endif 
                  
                                            @endforeach
                                     </tbody>
                            </table>
                      <!-- show product attribute with current stock  -->
                      @else 
                      @php $stock=DB::table('postmeta')->where('post_id',$meta_info->post_id)->where('meta_key','default_qty')->first(); @endphp 
                      @if($stock->meta_value>0)
                      <input style="width:70px" max="{{$stock->meta_value}}" min="0" step="1"  type="number" name="stock[]"> 
                      <br>Qty: {{ $stock->meta_value}}  
                      <input type="hidden" name="post_id[]" value="{{$meta_info->post_id}}">
       
                      @endif 
                       
                      @endif 
                    </td>
                  </tr>
                </tbody>
                @endif
              </table>
            
            @if(isset($stock->meta_value)>0)
              <div class="text-center mt-3"><button  class="btn btn-info btn-lg" type="submit">Submit</button></div>
              @endif 
        
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
</div>
@endsection
@section('js')
@endsection