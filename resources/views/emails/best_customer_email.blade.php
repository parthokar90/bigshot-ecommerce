@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;" id="app">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Email to Customer</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Email to Customer</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('admin.includes.messages')
      <form action="{{route('best.customer.send.email.data')}}" method="POST">
        {{ csrf_field() }}
        <div class="row">

          <div class="col-md-9">
            <div class="form-group">
                <!-- <label>To <span style="color:red">*</span></label> -->
              <input type="hidden" name="email" value="{{$email}}" class="form-control" required autocomplete="off">
            </div>
             <div class="form-group">
                <label>Subject <span style="color:red">*</span></label>
              <input type="text" name="subject" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Title</label>
              <input type="text" name="title" class="form-control"  autocomplete="off">
            </div>
            <div class="form-group">
              <label for="">Message <span style="color:red">*</span></label>
              <textarea name="message" id="" cols="20" rows="5" class="form-control" autocomplete="off"></textarea>
            </div>
          </div>
         <div class="col-md-12">
           <button type="submit" class="btn btn-success">Send Mail</button>
         </div>
        </div>
      </form>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


@endsection