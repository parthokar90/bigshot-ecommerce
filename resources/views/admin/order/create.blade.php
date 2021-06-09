@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;" id="app">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add New Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Add Product</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('admin.includes.messages')
      <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="row">
      
        <div class="col-md-9">
          <div class="form-group">
            <input type="text" name="post_title" placeholder="Product Name" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Product Description</label>
            <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
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
                      <label for="regular_price" class="col-sm-2 col-form-label">Regular Price (৳ )</label>
                      <div class="col-sm-10">
                        <input type="text" name="regular_price" class="form-control" id="regular_price" placeholder="Regular Price">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="sale_price" class="col-sm-2 col-form-label">Sale Price (৳ )</label>
                      <div class="col-sm-10">
                        <input type="text" name="sale_price" class="form-control" id="sale_price" placeholder="Sale Price">
                      </div>
                    </div>
                  </div>

                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                  <div class="col-md-12 mt-3">
                    <div class="form-group row">
                      <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                      <div class="col-sm-10">
                        <select name="stock_status" class="form-control" id="stock">
                          <option value="instock">In Stock</option>
                          <option value="outstock">Out of Stock</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                  <div class="form-group row mt-3">
                    <label for="weight" class="col-sm-2 col-form-label">Weight (kg)</label>
                    <div class="col-sm-10">
                     <input type="text" name="weight" class="form-control" id="weight">
                   </div>
                 </div>
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Dimensions (cm)</label>
                  <div class="col-sm-10 d-flex flex-row">
                    <input type="text" name="length" class="form-control" id="" placeholder="Length" style="width: 30%">
                    <input type="text" name="width" class="form-control" id="" placeholder="Width" style="width: 30%">
                    <input type="text" name="height" class="form-control" id="" placeholder="Height" style="width: 30%">
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
              <div class="form-group row mt-3" >
                <div class="col-md-12" id="finalValue">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="form-group">
            <label for="">Product short Description</label>
            <textarea name="post_excerpt" id="" cols="30" rows="10" class="form-control"></textarea>
          </div>
    </div>

    <div class="col-md-3">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Publish</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body d-flex flex-row text-center" style="display: block;">
          <input type="text" style="width: 30px" name="day" id="" value="<?php echo date('d')?>" >
          <input type="text" style="width: 30px" name="month" id="" value="<?php echo date('m')?>" >
          <input type="text" style="width: 50px" name="year" id="" value="<?php echo date('Y')?>" >
          <input type="text" style="width: 30px" name="HH" id="" value="<?php echo date('H')?>" >
          <input type="text" style="width: 30px" name="min" id="" value="<?php echo date('i')?>" >

        </div>
        <div class="card-footer">
          <button type="submit" value="draft" name="dreft" class="btn btn-warning">Draft</button>
          <button type="submit" value="submit" name="submit" class="btn btn-primary">Publish</button>
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
         <div class="custom-control custom-checkbox">
          <input class="custom-control-input" name="category[]" type="checkbox" id="{{$category->term_id}}" value="{{$category->term_id}}">
          <label for="{{$category->term_id}}" class="custom-control-label"> {{$category->name}}</label>
        </div>
        @endforeach
      </div>
    </div>
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Product Tags</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body" style="display: block;height:250px;overflow-x:scroll">
       @foreach($tags as $tag)
       <div class="custom-control custom-checkbox">
        <input class="custom-control-input" name="tag[]" type="checkbox" id="{{$tag->term_id}}" value="{{$tag->term_id}}">
        <label for="{{$tag->term_id}}" class="custom-control-label"> {{$tag->name}}</label>
      </div>
      @endforeach
    </div>
    <!-- /.card-body -->
  </div>
  {{-- brand --}}
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Product Brand</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body" style="display: block;height:250px;overflow-x:scroll">
      @foreach ($brands as $brand)
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="{{$brand->term_id}}" value="{{$brand->term_id}}" name="product_brand">
        <label for="{{$brand->term_id}}" class="custom-control-label"> {{$brand->name}}</label>
      </div>
      @endforeach
    </div>
  </div>
  {{-- product image --}}
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Product Image</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body" style="display: block;">
     <input type="file" name="product_image" id="" class="form-control">
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
    <input type="file" name="galleryImage[]" id="" class="form-control" multiple>
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
  $(document).ready(function(){
    $("#attributeAdd").on('click',function(){

     var id = $("#attributes").val();
     $.ajax({
      type: "GET",
      url:"{{url('admin/product/arttibuteValue/')}}"+"/"+id,
      dataType:"json",
      success:function(response){
        console.log(response);
        $('#attribut-value').show();
        var schema_one = '';
        $.each(response, function (i, item) {            
          schema_one += '<option value="'+item.term_taxonomy_id+'">'+item.name+'</option>';
        });
        $('#valueAttribute').html(schema_one);
      },
      error:function(xhr, ajaxOptions, thrownError){
        $("#grade_scale_div").hide();
        $('#schema_id_one').html('');
      }
    })   
   });
    $('#valueAttributeBtn').on('click',function(){
     var id = $("#valueAttribute").val();
     var text = $("#valueAttribute :selected").text();
     console.log(id);
     console.log(text);
     var text='<input id="remove_'+id+'"  type="hidden" onclick="closeThis('+id+')" name="valueName[]" value="'+id+'" ><span style="margin-right:10px" class="btn btn-primary closeButton">'+text+'</span>';

     $('#finalValue').append(text);
   });

  });


  function closeThis(info){
    $('#remove_'+info).remove();
  }
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