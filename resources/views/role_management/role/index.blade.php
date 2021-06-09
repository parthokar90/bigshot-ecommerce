@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Role List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Role List</li>
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
                  <h3 class="card-title">{{isset($category)?'Edit Category':'Add Role'}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
           
                <form role="form" method="POST" action="{{route('role.store')}}" >
                  {{csrf_field()}}
                  <div class="card-body">
                   <div class="form-group">
                      <label for="categoryName">Role</label>
                      <input type="text" name="name" class="form-control" value="" id="categoryName" placeholder="Enter Role Name" autocomplete="off" required>
                    </div>  

                      <div class="form-group">
                         <label for="categoryName">Select Permission</label></br>
                          @foreach($permission as $permissions)
                          <label class="checkbox-inline">
                            <input type="checkbox" id="example" class="allChecked"  style="padding: 0px 5px;" name="page_id[]"  value="{{$permissions->id}}"> {{$permissions->name}}
                          </label>
                          @endforeach 
                     </div> 
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Add</button>
                  </div>
                </form>
      
              </div>     
        </div>  
          <div class="col-md-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Role List</h3>
                 <!-- <form method="get" action="{{route('category.index')}}"> 
                    <input type="text" name="category" class="form-control" placeholder="Search Category" autocomplete="off">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fd-search"></i> Search</button>
                 </form> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if($user->count()==0) No Data Found @endif
                <table class="table table-bordered table-striped">
                  <thead class="bg-info">                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                    $i=1;
                    @endphp
                   @foreach($user as $value)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->status==1?'Active':'Inactive'}}</td>
                      <td>
                        <a href="{{route('role.edit',$value->id)}}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                      </td>
                    </tr>
                    @php 
                    $i++;
                    @endphp
                   @endforeach
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-center">            
                {{$user->links()}}                  
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