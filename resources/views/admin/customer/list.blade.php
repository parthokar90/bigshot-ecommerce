@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Customer List</li>
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
                <h3 class="card-title">Customer List</h3>
              </div>
              <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped table">
                  <thead class="bg-success">                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Customer Name</th>
                      <th>Customer Email</th>
                      <th>Customer Mobile</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
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
  <script type="text/javascript">
    var table = $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('customer.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'meta_value', name: 'meta_value'},
            {data: 'status', name: 'status'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
</script>
@endsection