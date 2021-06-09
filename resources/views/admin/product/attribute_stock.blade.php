@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;" id="app">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Update Product Stock</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Update Product Stock</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('admin.includes.messages')
        <div class="row">
          <div class="col-md-12">
              <form method="get" action="{{route('attribute_stock')}}">
                <div class="form-group">
                <label>Select Sku</label>
                <select class="form-control" name="sku" required>
                     @foreach($sku_list as $list)
                       <option value="{{$list->meta_value}}">{{$list->meta_value}}</option>
                     @endforeach
                </select>
                <button type="submit" class="btn btn-success mt-2">Search</button>
               </form>
            </div>
          <form method="post" action="{{route('attribute_stock_update')}}">
           @csrf 
           <div class="col-md-12">

  
             <table class="table table-responsive">
                <thead>
                    <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
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
                          <td><input type="text" class="form-control" name="stock[]" value="{{$stock->meta_value}}" autocomplete="off"></td>
                            <input type="hidden" name="post_id[]" value="{{$a->post_id}}">
                      </tr>
                       @endforeach
                  </tbody>
                </table>
            </div>
            @if($i>0)
            <button type="submit" class="btn btn-success"> Update Stock</button>
            @endif
          </form>
         </div>
        </div>  
    </div>
</section>
<!-- /.content -->
</div>
@endsection

