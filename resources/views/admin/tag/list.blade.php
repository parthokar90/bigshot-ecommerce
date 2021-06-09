@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tag List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Tag List</li>
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
                  <h3 class="card-title">{{isset($tag)?'Edit Tag':'Add Tag'}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if(isset($tag))
                <form role="form" method="POST" action="{{route('tag.update',$tag->term_id)}}" >
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="tagName">Tag Name</label>
                      <input type="text" name="tagName" class="form-control" value="{{$tag->name}}" id="tagName" placeholder="Enter Tag Name">
                    </div>                   
                    <div class="form-group">
                      <label for="exampleInputFile">Status</label>
                      <div class="form-group">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="active"  value="1" {{$tag->status==1?'checked':''}}  name="status">
                          <label for="active" class="custom-control-label">Active</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" {{$tag->status==0?'checked':''}} value="0" id="inactive" name="status" >
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
                <form role="form" method="POST" action="{{route('tag.store')}}" >
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="tagName">Tag Name</label>
                      <input type="text" name="tagName" class="form-control" id="tagName" placeholder="Enter Tag Name">
                    </div>                   
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
                <h3 class="card-title">Tags</h3>
                <form method="get" action="{{route('tag.index')}}"> 
                    <input type="text" name="tag" class="form-control" placeholder="Search Tag" autocomplete="off">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fd-search"></i> Search</button>
                 </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @if($tags->count()==0) No Data Found @endif
                <table class="table table-bordered table-striped">
                        <thead class="bg-info">                
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Tag Name</th>
                      <th>Status</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                    $i=1;
                    @endphp
                   @foreach($tags as $value)
                    @if($value->status==1)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$value->name}}</td>
                      <td>Active</td>
                      <td>
                        <a href="{{route('tag.edit',$value->term_id)}}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                      </td>
                    </tr>
                    @else 
                     <tr style="background: #db8192;">
                      <td>{{$i}}</td>
                      <td>{{$value->name}}</td>
                      <td>Inactive</td>
                      <td>
                        <a href="{{route('tag.edit',$value->term_id)}}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
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
                {{$tags->links()}}                  
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