@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;" id="app">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('product.index')}}">Products</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('admin.includes.messages')
      <form action="{{route('product.update',$product->ID)}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="row">

          <div class="col-md-9">
            <div class="form-group">
              <input type="text" name="post_title" value="{{$product->post_title}}" placeholder="Product Name" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Product Description</label>
              <textarea name="post_content" id="" cols="30" rows="10" class="form-control">{{$product->post_content}}</textarea>
            </div>
            <div class="row form-group">
              <div class="col-md-3 ">
                <div class="nav flex-column nav-pills bg-white" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">General</a>
                  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Inventory</a>
                  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Shipping</a>
                  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Attribute</a>
                </div>
              </div>
              <div class="col-md-9 bg-white">
                <div class="tab-content " id="v-pills-tabContent">
                  <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="col-md-12 mt-3">
                      <div class="form-group row">
                        <label for="regular_price" class="col-sm-2 col-form-label">Sku</label>
                        <div class="col-sm-10">
                          <input type="text" readonly name="product_sku" class="form-control" id="regular_price" value="@if(isset($sku->meta_value)){{$sku->meta_value}} @else 0 @endif" placeholder="Sku">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="regular_price" class="col-sm-2 col-form-label">Regular Price (৳ )</label>
                        <div class="col-sm-10">
                          @if(isset($regular_price->meta_value)) @php $rp=(int) $regular_price->meta_value; @endphp @else @php $rp=(int) 0; @endphp @endif
                          <input type="number" name="regular_price" class="form-control" value="{{$rp}}" id="regular_price" placeholder="Regular Price">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="sale_price" class="col-sm-2 col-form-label">Current Price (৳ )</label>
                        <div class="col-sm-10">
                           @if(isset($sale_price->meta_value)) @php $sp=(int) $sale_price->meta_value; @endphp @else @php $sp=(int) 0; @endphp @endif
                          <input type="number" name="sale_price" value="{{$sp}}" class="form-control" id="sale_price" placeholder="Sale Price">
                        </div>
                      </div>

                      <div class="form-group row">
                         <label for="stock" class="col-sm-2 col-form-label" style="font-size:13px">Purchase Price (৳)</label>
                        <div class="col-sm-10">
                           @if(isset($stock->meta_value)) @php $pp=(int) $stock->meta_value; @endphp @else @php $pp=(int) 0; @endphp @endif
                          <input type="number" name="product_stock" value="{{$pp}}" class="form-control" id="stock" placeholder="Cost" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="col-md-12 mt-3">
                      <div class="form-group row">
                      
                        <div class="col-sm-8">
                        
                        </div>
                      </div>
                      @if($allAttribute->count()>0)
                   


                      <table class="table table-responsive">
                          <thead>
                              <tr>
                              <th>Attribute</th>
                              <th>Stock</th>
                              <th>Low stock threshold</th>
                              </tr>
                          </thead>
                          <tbody>
                            @php $i=0; @endphp 
                            @foreach($allAttribute as $a) 
                              @php 
                              $i++;
                              $attribute=json_decode($a->meta_value);
                              @endphp
                                  <tr>
                                    <td>
                                      @foreach($attribute as $att)
                                      <b> {{strtoupper($att->taxonomy)}}</b> :
                                      {{strtoupper($att->term)}}
                                    
                                      @php 
                                         $stock=DB::table('postmeta')->where('post_id',$a->post_id)->where('meta_key','attribute_stock')->first();
                                         $llow_stock=DB::table('postmeta')->where('post_id',$a->post_id)->where('meta_key','attribute_low_stock')->first();
                                       @endphp       
                                      @endforeach
                                      @if(isset($llow_stock)) @php $llow_stock=$llow_stock->meta_value; @endphp @endif
                                  </td>
                                    <td><input type="number" class="form-control" name="stock[]" value="{{$stock->meta_value}}" autocomplete="off"></td>
                                    <td> <input type="number" class="form-control" name="low_stock[]" value="{{$llow_stock}}" autocomplete="off"></td>
                                      <input type="hidden" name="post_id[]" value="{{$a->post_id}}">
                                </tr>
                                @endforeach
                                @if(isset($stock)) 
                                  <input type="hidden" class="form-control" name="a_stock" value="{{$stock->meta_value}}" autocomplete="off">
                                  <input type="hidden" class="form-control" name="l_stock" value="{{$llow_stock}}" autocomplete="off">
                                @endif
                              
                            </tbody>
                          </table>
                          @else 
                          <div class="form-group row" id="stockQualityDiv">
                            <label for="stockQuality" class="col-sm-4 col-form-label">Stock Quantity</label>
                            <div class="col-sm-8">
                              @php $qtyy=0; @endphp
                              @if(isset($qty)) @php $qtyy=$qty->meta_value; @endphp @endif
                              <input type="number" class="form-control" value="{{$qtyy}}" name="stockQuality" id="stockQuality">
                            </div>
                          </div> 


                        <div class="form-group row" id="lowStockThresholdDiv">
                        <label for="lowStockThreshold" class="col-sm-4 col-form-label">Low stock threshold
                        </label>
                        <div class="col-sm-8">
                          @php $al_qty=0; @endphp
                          @if(isset($alert_qty)) @php $al_qty=$alert_qty->meta_value; @endphp @endif
                          <input type="number" class="form-control" value="{{$al_qty}}" name="lowStockThreshold" id="lowStockThreshold">
                        </div>
                       </div>

                     <div class="form-group row">
                        <label for="stock" class="col-sm-4 col-form-label">Stock</label>
                        <div class="col-sm-8">
                          <select name="stock_status" class="form-control" id="stock">
                            <option value="instock">In Stock</option>
                            <option value="outstock">Out of Stock</option>
                          </select>
                        </div>
                      </div>


                       @endif
                    


                    </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <div class="form-group row mt-3">
                      <label for="weight" class="col-sm-2 col-form-label">Weight (kg)</label>
                      <div class="col-sm-10">
                        <input type="text" value="@if(isset($weight->meta_value))  {{$weight->meta_value}} @else  @endif" name="weight" class="form-control" id="weight">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Dimensions (cm)</label>
                      <div class="col-sm-10 d-flex flex-row">
                        <input type="text" name="length" value="@if(isset($length->meta_value))  {{$length->meta_value}} @else  @endif" class="form-control" id="" placeholder="Length" style="width: 30%">
                        <input type="text" name="width" value="@if(isset($width->meta_value))  {{$width->meta_value}} @else  @endif" class="form-control" id="" placeholder="Width" style="width: 30%">
                        <input type="text" name="height" value="@if(isset($height->meta_value))  {{$height->meta_value}} @else  @endif" class="form-control" id="" placeholder="Height" style="width: 30%">
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <div class="form-group row mt-3">
                      <label for="attributes" class="col-sm-2 col-form-label">Attribute</label>
                      <div class="col-sm-8">
                        <select name="attributes" id="attributes" class="form-control">
                          @foreach($attributes as $value)
                          <option value="{{$value->attribute_id}}">{{ucfirst($value->attribute_name)}}</option>
                          @endforeach
                        </select>
                      </div>
                      <input type="button" class="btn btn-info" value="Add" id="attributeAdd">
                    </div>
                    <div class="form-group row mt-3" id="attribut-value">
                      <label for="selectAttributes" class="col-sm-2 col-form-label">Value</label>
                      <div class="col-sm-8">
                        <select name="" id="valueAttribute" class="form-control"></select>
                      </div>
                      <input type="button" class="btn btn-success" value="Add" id="valueAttributeBtn">
                    </div>
                    <button id="add_attribute" type="button" class="btn btn-success">Add Varient</button>
                    <div class="form-group row mt-3">
                      <div class="col-md-12" id="finalValue">
                        <!-- @foreach($allAttribute as $a)
                           <input type="hidden" name="att_default[]" value="{{$a->meta_value}}">
                             @php $data=json_decode($a->meta_value);  @endphp
                             @foreach($data as $att) 
                               <input type="hidden" onclick="closeThis('1')" name="valueName[]" value="{{$att->term_id}}">
                               <span style="margin-right:10px" class="btn btn-primary closeButton">{{$att->term}}</span>
                             @endforeach
                        @endforeach  -->

                           <table class="table table-responsive">
                                <tbody>
                                  @php $att_statuss=''; @endphp
                                   @foreach($allAttribute as $a)
                                     <input type="hidden" name="att_default[]" value="{{$a->meta_value}}">
                                     @php $data=json_decode($a->meta_value); $current_status=DB::table('postmeta')->where('post_id',$a->post_id)->where('meta_key','att_status')->first(); @endphp

                                       
                                        <tr>
                                            <td style="border: 0px solid #ffffff;">
                                              <input  type="hidden" name="attribute_id" value="{{$a->post_id}}"> 
                                              @if(isset($current_status)) @php $att_statuss=$current_status->meta_value; @endphp @endif
                                              @if($att_statuss==1)
                                              @php $status=0; @endphp
                                             <a href="{{url('att/status/'.$a->post_id.'/'.$status.'/'.$product->ID)}}" class="btn btn-danger btn-sm">X</a> <span style="color:green">Active</span>  
                                              @else 
                                              @php $status=1; @endphp
                                             <a href="{{url('att/status/'.$a->post_id.'/'.$status.'/'.$product->ID)}}" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a> <span style="color:red">Inactive</span> 
                                              @endif 
                                               @foreach($data as $att)
                                                <input type="hidden" onclick="closeThis('1')" name="valueName[]" value="{{$att->term_id}}">
                                             <b>{{strtoupper($att->taxonomy)}}</b> :
                                             {{strtoupper($att->term)}} 
                                   
                                             @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                             </table>




                      </div>
                       <div style="display:none"  class="col-md-12" id="finalValuetemp"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="">Product short Description</label>
              <textarea name="post_excerpt" id="" cols="30" rows="10" class="form-control">{{$product->post_excerpt}}</textarea>
            </div>
          </div>

          <div class="col-md-3">

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Product Status</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" >               
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" name="status" {{$product->post_status=='publish'?'checked':''}} type="radio" id="active" value="publish">
                  <label for="active" class="custom-control-label"> Publish</label>
                </div> 
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" name="status" {{$product->post_status=='unpublish'?'checked':''}}  type="radio" id="inactive" value="unpublish">
                  <label for="inactive" class="custom-control-label"> Unpublish</label>
                </div>
               
              </div>
              <!-- /.card-body -->
            </div>

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Publish</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body d-flex flex-row text-center" style="display: block;">
                @php
                $date=$product->post_date;
                $day=date('d',strtotime($date));
                $month=date('m',strtotime($date));
                $year=date('Y',strtotime($date));
                $hours=date('H',strtotime($date));
                $min=date('i',strtotime($date));
                @endphp
                <input type="text" style="width: 30px" name="day" id="" value="{{$day}}">
                <input type="text" style="width: 30px" name="month" id="" value="{{$month}}">
                <input type="text" style="width: 50px" name="year" id="" value="{{$year}}">
                <input type="text" style="width: 30px" name="HH" id="" value="{{$hours}}">
                <input type="text" style="width: 30px" name="min" id="" value="{{$min}}">

              </div>
              <div class="card-footer">

                <button type="submit" value="submit" name="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Product Category</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;height:250px;overflow-x:scroll">
                @foreach($categories as $category)
                @php
                $check=in_array($category->name,$nameTaxonomy);
                @endphp
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" {{($check==true)?'checked':''}} name="category[]" type="radio" id="{{$category->term_id}}" value="{{$category->term_id}}">
                  <label for="{{$category->term_id}}" class="custom-control-label"> {{$category->name}}</label>
                </div>
                @endforeach
              </div>
            </div>
      
            {{-- brand --}}

            {{-- product image --}}
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Product Image</h3> <br><br> <span style="color:red"> (Width:268px and Height:306px)
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                @if(isset($image->meta_value)) @php $img=$image->meta_value; @endphp @else @php $img=''; @endphp @endif
                <img src="{{asset('backend/products/').'/'.$img}}" style="width:100px;height:100px" />
                <input type="hidden" name="oldImage" value="{{$img}}">
                <input type="file" name="product_image" id="" class="form-control mt-3">
              </div>
            </div>



            {{-- product Gallary --}}
              <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Product Gallery</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                 <div class="row">
                    @foreach($gallery_images as $g) 
                      <div class="col-md-3">
                         <img src="{{asset('backend/products/').'/'.$g->meta_value}}" style="width:50px;height:50px" />
                         <a class="btn btn-danger btn-sm" href="{{route('gallery_delete',$g->meta_id)}}"><i class="fa fa-trash"></i></a>
                      </div>
                    @endforeach
                    <input type="file" name="gallery_image[]" id="" class="form-control mt-3" multiple>
                 </div>
              </div>
            </div>





          </div>
        </div>
      </form>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {

    $("#attributeAdd").on('click', function() {
      var id = $("#attributes").val();
      $.ajax({
        type: "GET",
        url: "{{url('admin/product/arttibuteValue/')}}" + "/" + id,
        dataType: "json",
        success: function(response) {
          console.log(response);
          $('#attribut-value').show();
          var schema_one = '';
          $.each(response, function(i, item) {
            schema_one += '<option value="' + item.term_taxonomy_id + '">' + item.name + '</option>';
          });
          $('#valueAttribute').html(schema_one);
        },
        error: function(xhr, ajaxOptions, thrownError) {
          $("#grade_scale_div").hide();
          $('#schema_id_one').html('');
        }
      })
    });
    $('#valueAttributeBtn').on('click', function() {
      var id = $("#valueAttribute").val();
      var text = $("#valueAttribute :selected").text();
      var text = '<input class="all_att" id="remove_' + id + '"  type="hidden" onclick="closeThis(' + id + ')" name="valueName[]" value="' + id + '" ><span style="margin-right:10px" class="btn btn-primary closeButton">' + text + '</span>';
      var text_two = '<input class="all_att" id="remove_' + id + '"  type="hidden" onclick="closeThis(' + id + ')" name="valueNametemp[]" value="' + id + '" ><span style="margin-right:10px" class="btn btn-primary closeButton">' + text + '</span>';
      $('#finalValue').append(text);
      $('#finalValuetemp').append(text_two);
    });

    $('#manageStock').change(function() {
      if ($(this).is(":checked")) {
        $('#stockQualityDiv').show('slow');
        $('#lowStockThresholdDiv').show('slow');
      } else {
        $('#stockQualityDiv').hide();
        $('#lowStockThresholdDiv').hide();
      }

    });


    function closeThis(info) {
      $('#remove_' + info).remove();
    }

       $("#add_attribute").click(function(){
        var valueNametemp = $('input[name="valueNametemp[]"]').map(function(){return $(this).val();}).get(); 
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
        type: "POST",
        data:{
           valueNametemp:valueNametemp,
          _token: _token
        },
        url: "{{route('attribute_stock_add')}}",
        dataType: "json",
        success: function(response) {
         alert('insert success');
         $(".all_att").attr("name","hello");

            //  $(".all_att").removeClass('all_att');
        },
        error: function(response) {
         console.log(response);
        }
      })
    });


  });
</script>
<script src="{{asset('assets/admin/js/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script type="text/javascript">
  tinymce.init({
    selector: 'textarea',
    height: 400,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
    content_css: '//www.tiny.cloud/css/codepen.min.css'
  });
</script>
@endsection