@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Customer Edit</li>
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
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Customer</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('user_update')}}" >
                  {{csrf_field()}}
                  <input type="hidden" name="id" value="{{$user->id}}">
                  <div class="card-body">   
                    <div class="form-group">
                      <label for="exampleInputFile">Status</label>
                      <div class="form-group">
                    
                      <select class="form-control" name="status">
                        @if($user->status==1)
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                        @else 
                        <option value="1">Active</option>
                        <option value="0" selected>Inactive</option>
                        @endif
                      </select>
                     
              
                      </div>
                    </div>                 
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                  </div>
                </form>
              </div>     
              </div>  
              <div class="d-flex justify-content-center">                 
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