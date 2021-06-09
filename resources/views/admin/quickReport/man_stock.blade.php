@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Man Stock List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Man Stock</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Man Stock</h3>
              </div>

              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead class="bg-success">                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <!-- <td>
                        <a href="" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                      </td> -->
                    </tr>
                   
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-center">            
                                  
              </div>  
            </div>
          
          </div>
        

          </div>

        </div>
      
      </div>
    </section>

  </div>
@endsection