@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Brand List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Brand List</li>
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
              <h3 class="card-title">{{isset($brand)?'Edit Brand':'Add Brand'}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if(isset($brand))
            <form role="form" method="POST" action="{{route('brand.update',$brand->term_id)}}" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="card-body">
                <div class="form-group">
                  <label for="brandName">Brand Name</label>
                  <input type="text" name="brandName" class="form-control" value="{{$brand->name}}" id="brandName" placeholder="Enter Brand Name">
                </div>
                <div class="form-group">
                  <label for="image">Brand Image</label>
                  <input type="file" name="image" class="form-control" id="image">
                  @if($brand->image)
                  <img src="{{asset('assets/admin/brand/'.$brand->image)}}" alt="" style="height: 50px;width:50px">
                  <input type="hidden" name="oldImage" value="{{$brand->image}}">
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Status</label>
                  <div class="form-group">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="active" value="1" {{$brand->status==1?'checked':''}} name="status">
                      <label for="active" class="custom-control-label">Active</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" {{$brand->status==0?'checked':''}} value="0" id="inactive" name="status">
                      <label for="inactive" class="custom-control-label">Inactive</label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
              </div>
            </form>
            @else
            <form role="form" method="POST" action="{{route('brand.store')}}" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="card-body">
                <div class="form-group">
                  <label for="brandName">Brand Name</label>
                  <input type="text" name="brandName" class="form-control" id="brandName" placeholder="Enter Brand Name">
                </div>
                <div class="form-group">
                  <label for="image">Brand Image</label>
                  <input type="file" name="image" class="form-control" id="image">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Status</label>
                  <div class="form-group">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="active" value="1" checked name="status">
                      <label for="active" class="custom-control-label">Active</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="0" id="inactive" name="status">
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
              <h3 class="card-title">Brands</h3>
              <form method="get" action="{{route('brand.index')}}">
                <input type="text" name="brand" class="form-control" placeholder="Search Brand" autocomplete="off">
                <button class="btn btn-primary btn-sm" type="submit"><i class="fa fd-search"></i>
                  Search</button>
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if($brands->count()==0) No Data Found @endif
              <table class="table table-bordered table-striped">
                <thead class="bg-danger">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Image</th>
                    <th>Brand Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i=1;
                  @endphp
                  @foreach($brands as $value)
                  <tr>
                    <td>{{$i}}</td>
                    <td>
                      @if($value->image)
                      <img src="{{asset('/assets/admin/brand/'.$value->image)}}" style="height: 50px;width:50px" alt="">
                      @else
                      <img src="{{asset('assets/admin/default/no-image.jpg')}}" style="height: 50px;width:50px" alt="">
                      @endif
                    </td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->status==1?'Active':'Inactive'}}</td>
                    <td>
                      <a href="{{route('brand.edit',$value->term_id)}}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Edit</a>
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
              {{$brands->links()}}
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