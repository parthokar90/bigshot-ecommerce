@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Query Replay</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Customer Query Replay</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        @include('admin.includes.messages')
        <div class="row">
           
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer Query Replay</h3>
              </div>
              <div class="card-body">
               <form role="form" method="POST" action="{{route('query.replay')}}" >
                <input type="hidden" name="id" value="{{$query->ID}}">
              {{csrf_field()}}
              <div class="card-body">
                <div class="form-group">
                  <label for="brandName">Subject: </label>
                  {{$query->post_title}}
                </div> 

                 <div class="form-group">
                  <label for="brandName">Query: </label>
                  {{$query->post_content}}
                </div>

                <div class="form-group">
                  <label for="replay">Reply: </label>
                  <textarea class="form-control" id="replay" cols="30" rows="10" name="post_excerpt">{{$query->post_excerpt}}</textarea>
                  
                </div>
              
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
              </div>
            </form>
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