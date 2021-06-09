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
              <li class="breadcrumb-item active">Send Parcel List</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="s002">
   <div class="container">
         @include('admin.includes.messages')
   </div>

    <div class="d-flex font-weight-bold justify-content-center h2 mb-3">Search Send Parcel List</div>
      <div class="d-flex justify-content-center mb-3">
        <form class="form-inline" method="post" action="{{route('send.parcel.search')}}" >
          @csrf() 
          <div class="form-group mb-2">
            <label for="depart" class="mr-2">Order Id</label>
            <input required type="text" class="form-control" name="order_id" placeholder="Scanner or Order Id" />
          </div>
 
          <button type="submit" class="btn btn-primary mb-2">SEARCH</button>
        </form>
      </div>
    </div>
    </section>
 </div>
@endsection
@section('js')
@endsection