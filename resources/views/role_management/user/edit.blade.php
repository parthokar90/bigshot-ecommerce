@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">User List</li>
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
                  <h3 class="card-title">{{isset($category)?'Edit Category':'Edit User'}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
           
                <form role="form" method="POST" action="{{route('user.update',$user->id)}}" >
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  {{csrf_field()}}
                  <div class="card-body">
                   <div class="form-group">
                      <label for="categoryName">User Name</label>
                      <input type="text" name="name" class="form-control" value="{{$user->name}}" id="categoryName" placeholder="Enter User Name" autocomplete="off" required>
                    </div> 

                      <!-- <div class="form-group">
                      <label for="categoryName">Email</label>
                      <input type="text" name="email" class="form-control" value="" id="categoryName" placeholder="Enter Email" autocomplete="off" required>
                    </div>  -->

                      <div class="form-group">
                      <label for="categoryName">Password</label>
                      <input type="password" name="password" class="form-control" value="" id="categoryName" placeholder="Enter Password" autocomplete="off">
                    </div> 

                    <div class="form-group">
                      <label for="categoryName">Role</label>
                      <select class="form-control" required autocomplete="off" name="role_id">
                         @foreach($role as $roles)
                               <option value="{{$roles->id}}" @if($roles->id == $user->role_id)
                               selected='selected' @endif>{{ $roles->name }}</option>
                         @endforeach
                      </select>
                    </div>  
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                  </div>
                </form>
              </div>     
        </div>  
          <div class="col-md-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User List</h3>
                 <!-- <form method="get" action="{{route('category.index')}}"> 
                    <input type="text" name="category" class="form-control" placeholder="Search Category" autocomplete="off">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fd-search"></i> Search</button>
                 </form> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if($data->count()==0) No Data Found @endif
                <table class="table table-bordered table-striped">
                  <thead class="bg-info">                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                    $i=1;
                    @endphp
                   @foreach($data as $value)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->email}}</td>
                      <td>{{$value->role_name->name}}</td>
                      <td>{{$value->status==1?'Active':'Inactive'}}</td>
                      <td>
                        <a href="{{route('user.edit',$value->id)}}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
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
                {{$data->links()}}                  
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