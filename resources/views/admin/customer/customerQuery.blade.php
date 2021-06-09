@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Query</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Customer Query</li>
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
                <h3 class="card-title">Customer Query</h3>
              </div>
              <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped table">
                  <thead class="bg-success">                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Customer Name</th>
                      <th>Customer Query</th>
                      <!-- <th>Replay</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($customerQuerys as $key=> $cuQ)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>@php 
                      $c_name=DB::table('usermeta')->where('user_id',$cuQ->post_author)
                      ->where('meta_key','first_name')->first(); 
                        $l_name=DB::table('usermeta')->where('user_id',$cuQ->post_author)
                      ->where('meta_key','last_name')->first(); 
                      @endphp 
                      @if(isset($c_name)) @php $name=$c_name->meta_value; @endphp
                      @else @php $name="Guest"; @endphp @endif 
                       @if(isset($l_name)) @php $lname=$l_name->meta_value; @endphp
                      @else @php $lname="Guest"; @endphp @endif 
                      {{$name}}     {{$lname}}
                      </td>
                      <td>{{$cuQ->post_title}}</td>
                      <!-- <td>{{$cuQ->post_excerpt}}</td> -->
                      <td><a href="{{route('customer.queryReplay',$cuQ->ID)}}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Edit</a></td>
                    </tr>
                    @endforeach
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