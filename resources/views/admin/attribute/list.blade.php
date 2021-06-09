@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Attribute List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Attribute List</li>
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
                  <h3 class="card-title">{{isset($attribute)?'Edit Attribute':'Add Attribute'}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if(isset($attribute))
                <form role="form" method="POST" action="{{route('attribute.update',$attribute->attribute_id)}}" >
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="attributeName">Attribute Name</label>
                      <input type="text" name="attribute_name" class="form-control" value="{{$attribute->attribute_name}}" id="attributeName" placeholder="Enter attribute Name">
                    </div>                   
                    <div class="form-group">
                      <label for="exampleInputFile">Status</label>
                      <div class="form-group">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="active"  value="1" {{$attribute->status==1?'checked':''}}  name="status">
                          <label for="active" class="custom-control-label">Active</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" {{$attribute->status==0?'checked':''}} value="0" id="inactive" name="status" >
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
                <form role="form" method="POST" action="{{route('attribute.store')}}" >
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="attribute_name">Attribute Name</label>
                      <input type="text" name="attribute_name" class="form-control" id="attribute_name" placeholder="Enter Attribute Name">
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
                <h3 class="card-title">Attributes</h3>
                <form method="get" action="{{route('attribute.index')}}"> 
                    <input type="text" name="attribute" class="form-control" placeholder="Search Attribute" autocomplete="off">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fd-search"></i> Search</button>
                 </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @if($attributes->count()==0) No Data Found @endif
                <table class="table table-bordered table-striped">
                          <thead class="bg-info">                
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Attribute Name</th>
                      <th>Attribute Type</th>
                      <th>Status</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                    $i=1;
                    @endphp
                   @foreach($attributes as $value)
                  @if($value->status==1)
                     <tr>
                      <td>{{$i}}</td>
                      <td>{{ucfirst($value->attribute_name)}}</td>
                      <td>{{$value->attribute_type}}</td>
                      <td>{{$value->status==1?'Active':'Inactive'}}</td>
                      <td>
                        <a href="{{route('attribute.edit',$value->attribute_id)}}" class="btn btn-primary"> <i class="fa fa-edit"></i></a>
                        <a href="{{route('attribute.attributeValue',$value->attribute_id)}}" title="Attibute Value" class="btn btn-success"> <i class="fa fa-cog"></i> </a>
                      </td>
                    </tr>
                    @else 
                   <tr style="background: #db8192;">
                      <td>{{$i}}</td>
                      <td>{{ucfirst($value->attribute_name)}}</td>
                      <td>{{$value->attribute_type}}</td>
                      <td>{{$value->status==1?'Active':'Inactive'}}</td>
                      <td>
                        <a href="{{route('attribute.edit',$value->attribute_id)}}" class="btn btn-primary"> <i class="fa fa-edit"></i></a>
                        <a href="{{route('attribute.attributeValue',$value->attribute_id)}}" title="Attibute Value" class="btn btn-success"> <i class="fa fa-cog"></i> </a>
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
                {{$attributes->links()}}                  
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