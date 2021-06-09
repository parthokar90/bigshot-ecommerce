@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Category List</li>
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
        <div class="col-md-5">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{isset($category)?'Edit Category':'Add Category'}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if(isset($category))
            <form role="form" method="POST" action="{{route('category.update',$category->term_id)}}" >
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="card-body">
                <div class="form-group">
                  <label for="categoryName">Caegory Name</label>
                  <input type="text" name="categoryName" class="form-control" value="{{$category->name}}" id="categoryName" placeholder="Enter Category Name">
                </div>  

                 <label for="term_group_level">Type</label>
                    <select name="term_group" class="form-control" id="term_group_edit">
                      <option value="0">0</option>
                      @foreach($all_term_groups as $trg)
                      <option {{isset($term_groups->term_id) && $trg->term_id==$term_groups->term_id?'selected':''}} value="{{$trg->term_id}}">{{$trg->name}}</option>
                      @endforeach
                    </select>

                    <label for="term_group_level">Group</label>
                    <select name="group" class="form-control" id="group_edit">
                      <option value="0">0</option>
                      @if(isset($groups->term_id))
                      <option selected value="{{$groups->term_id}}">{{$groups->name}}</option>
                      @endif
                    </select>



                  <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                    <div class="form-group">
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="active"  value="1" {{$category->status==1?'checked':''}}  name="status">
                        <label for="active" class="custom-control-label">Active</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" {{$category->status==0?'checked':''}} value="0" id="inactive" name="status" >
                        <label for="inactive" class="custom-control-label">Inactive</label>
                      </div>                    
                    </div>
                  </div>                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Update</button>
                </div>
              </form>
              @else
              <form role="form" method="POST" action="{{route('category.store')}}" >
                {{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="categoryName">Name</label>
                    <input type="text" name="categoryName" class="form-control" id="categoryName" placeholder="Enter Category Name">
                  </div>     


                    <label for="term_group_level">Type</label>
                    <select name="term_group" class="form-control" id="term_group_add">
                      <option value="0">0</option>
                      @foreach($term_groups as $trg)
                      <option value="{{$trg->term_id}}">{{$trg->name}}</option>
                      @endforeach
                    </select>

                    <label for="term_group_level">Group</label>
                    <select name="group" class="form-control" id="group">
                      <option value="0">0</option>                   
                    </select>
                 

                  <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                    <div class="form-group">
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="active" value="1" checked name="status">
                        <label for="active" class="custom-control-label">Active</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" value="0" id="inactive" name="status" >
                        <label for="inactive" class="custom-control-label">Inactive</label>
                      </div>                    
                    </div>
                  </div>                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Add</button>
                </div>
              </form>
              @endif
            </div>     
          </div>  
          <div class="col-md-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Categories</h3>
                <form method="get" action="{{route('category.index')}}"> 
                  <div class="d-flex justify-content-center">

                    <div>

                      <input type="text" name="category" class="form-control" placeholder="Search Category" autocomplete="off">
                    </div>
                    <div>

                      <button class="btn btn-success " type="submit"><i class="fa fd-search"></i> Search</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if($categories->count()==0) No Data Found @endif
                <table class="table table-bordered table-striped">
                  <thead class="bg-info">                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Category Name</th>
                      <th>Status</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                    $i=1;
                    @endphp
                    @foreach($categories as $value)
                    @if($value->status==1)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$value->name}}</td>
                      <td>Active</td>
                      <td>
                        <a href="{{route('category.edit',$value->term_id)}}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                      </td>
                    </tr>
                    @else 
                    <tr style="background: #db8192;">
                      <td>{{$i}}</td>
                      <td>{{$value->name}}</td>
                      <td>Inactive</td>
                      <td>
                        <a href="{{route('category.edit',$value->term_id)}}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                      </td>
                    </tr>
                    @endif 
                    @php 
                    $i++;
                    @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-center">            
                {{$categories->links()}}                  
              </div>  
            </div>
            <!-- /.card -->


          </div>


        </div>
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
  $('#term_group_add').on('change',function() {
    var value= $(this).val();
    if(value !=0){
       $.ajax({
        type: "GET",
        url: "{{url('admin/category/getType/')}}" + "/" + value,
        dataType: "json",
        success: function(response) {
        
          var schema_one = '';
          schema_one += '<option value="0">0</option>';
          $.each(response, function(i, item) {
            schema_one += '<option value="' + item.term_id + '">' + item.name + '</option>';
          });
          $('#group').html(schema_one);
        },
        error: function(xhr, ajaxOptions, thrownError) {          
          
        }
      })
    }
    else{
        var schema_one = '';
       schema_one += '<option value="0">0</option>';
        $('#group').html(schema_one);
    }

  });

  $('#term_group_edit').on('change',function() {
    var value= $(this).val();
    if(value !=0){
       $.ajax({
        type: "GET",
        url: "{{url('admin/category/getType/')}}" + "/" + value,
        dataType: "json",
        success: function(response) {
        
          var schema_one = '';
          schema_one += '<option value="0">0</option>';
          $.each(response, function(i, item) {
            schema_one += '<option value="' + item.term_id + '">' + item.name + '</option>';
          });
          $('#group_edit').html(schema_one);
        },
        error: function(xhr, ajaxOptions, thrownError) {          
          
        }
      })
    }
    else{
        var schema_one = '';
       schema_one += '<option value="0">0</option>';
        $('#group_edit').html(schema_one);
    }

  });
</script>
@endsection