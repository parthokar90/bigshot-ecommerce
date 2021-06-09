<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bigshot | Admin | @yield('title',isset($title) ? $title : 'Dashboard')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" type="image/png" href="{{asset('assets/common/images/logo.png')}}">
  <!-- <link rel = "icon" href ="" type = "image/x-icon">  -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @yield('css')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
</head>