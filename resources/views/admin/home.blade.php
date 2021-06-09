@extends('admin.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">

         

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{$total_sales}}</h3>
              <p>Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->

          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$total_delivered}}
              </h3>
              <p>Delivered</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$total_cancelled}}</h3>
              <p>Cancel</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{number_format($total_sale_amount)}}</h3>
              <p>Sales Amount</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>

        <div class="col-md-12 text-center">
          {{date('Y-m-01')}} To {{date('Y-m-t')}}
          @if($start=='' && $end=='')
          <input type="hidden" id="start_date" value="{{date('Y-m-01')}}">
          <input type="hidden" id="end_date" value="{{date('Y-m-t')}}">
          @else
          <input type="hidden" id="start_date" value="{{$start}}">
          <input type="hidden" id="end_date" value="{{$end}}">
          @endif
        </div>
          <div class="d-flex justify-content-center">
            <form class="form-inline" method="get" action="{{route('admin.home')}}" >
              @csrf() 
              <div class="form-group mb-2">
                <label for="depart" class="mr-3 ml-3"> Start Date </label>
                <input class="form-control datepicker" name="start" value="{{date('Y-m-01')}}" id="depart" type="date"/>
              </div>
              <div class="form-group mx-sm-3 mb-2">
                <label for="return" class="mr-2"> End Date </label>
                <input class="form-control datepicker" name="end" value="{{date('Y-m-t')}}" id="return" type="date"/>
              </div>
              <button type="submit" class="btn btn-primary mb-2">SEARCH</button>
            </form>
          </div>
        <div class="col-md-12 mt-5">
          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
  
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <script>
    window.onload = function() {
      var start = $("#start_date").val();
      var end = $("#end_date").val();
      var to = "To";

      var delivery = $("#delivery_date").val();
      var cancel = $("#cancel_date").val();
      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
          text: "Monthly Report of Sales Delivere & Cancelled--" + start + to + end
        },
        axisY: {
          title: ""
        },
        data: [{
          type: "column",
          legendMarkerColor: "grey",
          legendText: "",
          dataPoints: [

            {
              y: {{$total_sale_amount_date_wise}},
              label: "Sales"
            },
            {
              y: {{$total_delivery_amount_date_wise}},
              label: "Delivered"
            },
            {
              y: {{$total_cancel_amount_date_wise}},
              label: "Cancelled"
            },

          ]
        }]
      });
      chart.render();
    }
  </script>

  @endsection