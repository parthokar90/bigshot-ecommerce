@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Delivery Options</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Delivery Options</li>
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
                  <h3 class="card-title">{{isset($lists)?'Edit Option':'Add Option'}}</h3>
                </div>
                @if(isset($lists))
                <form role="form" method="POST" action="{{route('deliver_option_update',$lists->option_id)}}" >
                  {{ csrf_field() }}
                  <div class="card-body">
                     <div class="form-group">
                      <label for="categoryName">Option Name</label>
                      <input type="text" name="option_name" class="form-control" id="option_name " value="{{$lists->option_name}}" placeholder="Option Name" required>
                    </div>    
                     <div class="form-group">
                      <label for="categoryName">Option Amount</label>
                      <input type="text" name="option_value" class="form-control" id="categoryName" value="{{$lists->option_value}}" placeholder="Enter Option Amount" required>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Update</button>
                  </div>
                </form>
                @else
                <form role="form" method="POST" action="{{route('deliver_option_store')}}" >
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="card-body">
                     <div class="form-group">
                      <label for="categoryName">Option Name</label>
                      <input type="text" name="option_name" class="form-control" id="option_name " value="" placeholder="Option Name" required>
                    </div>    
                     <div class="form-group">
                      <label for="categoryName">Option Amount</label>
                      <input type="text" name="option_value" class="form-control" id="categoryName" value="" placeholder="Enter Option Amount" required>
                    </div>
                  </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Add Option</button>
                  </div>
                </form>
                @endif
              </div>     
           </div>  
          <div class="col-md-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
          
              </div>
              <!-- /.card-header -->
              <div class="card-body">
    
                <table class="table table-bordered table-striped">
                  <thead class="bg-info">                  
                    <tr>
                      <th>Option Name</th>
                      <th>Option Amount</th>
                    </tr>
                  </thead>
                  <tbody>
     
                      <td>@if(isset($lists)){{$lists->option_name}}@endif</td>
                      <td>{{isset($lists)?number_format($lists->option_value):''}} tk</td>
                    </tr>
                  </tbody>
                </table>
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