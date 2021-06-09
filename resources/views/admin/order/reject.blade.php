@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <section class="content-header">
    <div class="container-fluid">
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
    <form role="form" method="POST" action="{{route('reject.update')}}" enctype="multipart/form-data">
      <div class="container">
        <div class="card">

          <div class="card-body">
            <div class="row mb-4">
            </div>
            {{csrf_field()}}
            <div class="card-body">
              <!-- <div class="form-group">
                  <label for="brandName">Brand Name</label>
                  <input type="text" name="brandName" class="form-control" id="brandName" placeholder="Enter Brand Name">
                </div>
                <div class="form-group">
                  <label for="image">Brand Image</label>
                  <input type="file" name="image" class="form-control" id="image">
                </div> -->
              <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
             
         
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
   
          <div class="offset-md-4 col-md-4">
            <div class="box bg-danger">
             
            </div>
          </div>
          <div class="col-md-4">
            <div class="box">
           
              
    
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