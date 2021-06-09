@extends('front.layouts.front_master')
@section('content')
        <div class="container">
            <!-- header start -->
            <div class="header pt-5" style="background-image: url({{asset('backend/bg.jpg')}});background-size:cover;">
                <div class="d-flex flex-wrap">
                   <div class="col-md-6 col-12">
                    <img src="{{asset('backend/user.png')}}" width="150" height="200" alt="..." class="img-thumbnail rounded-circle">
                     </div>
                       <div class="col-md-6 col-12">
                            <h3 class="text-light text-right mr-5 mt-5 ">{{auth()->user()->name}} {{auth()->user()->last_name}}</h3> 
                    </div>
                </div>
             </div>
        </div>
        <!-- header end-->
        <!-- body start -->
        <!-- body end -->
        <div class="container">
            <table class="table mt-5 border">
                <tbody>
                  <tr>
                    <th scope="row">{{auth()->user()->name}} {{auth()->user()->last_name}}</th>
                    <td>
                        <a href="{{route('profile.edit',auth()->user()->id)}}"><div style="font-size:12px" class="btn btn-secondary btn-sm">Edit Profile?</div></a>
                    </td>
                  </tr>
                    <tr>
                    <th scope="row"> @if(isset( $address)) {{ $address->meta_value}} @endif</th>
                    <td></td>
                  </tr>
                  <tr>
                    <th scope="row">{{auth()->user()->email}}</th>
                    <td></td>
                  </tr>
                  <tr>
                    <th scope="row">@if(isset($mobile)) {{$mobile->meta_value}} @endif</th>
                    <td></td>
                  </tr>
                  <tr>
                    <th scope="row">Password</th>
                    <td> <a href="{{route('password.edit',auth()->user()->id)}}"><div style="font-size:12px" class="btn btn-secondary btn-sm">Change?</div></a></td>
                  </tr>
                  <tr>
                    <td>Account Status</td>
                    <td>@if(auth()->user()->status==1) Active @endif</td>
                  </tr>
                  <tr>
                    <td>
                      <form method="post" action="{{route('deactive_acc')}}">
                        @csrf 
                            <button style="font-size: 9px;" onclick="return confirm('are you sure want to deactive your account?')" type="submit" class="btn btn-danger btn-sm">Deactive Account ?</button>
                      </form>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>
                    <a style="color: #000000;" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form> 
                    </td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
        </div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
@include('error_message.message')
@endsection