@extends('front.layouts.front_master')
@section('content')
  <style>
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 30px;
          margin-bottom: 10px;
          text-align: center;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:16px;
          margin: 0;
          padding: 15px;
        }
      .checkmark {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: 56px;
          }
      .cardd {
        background: white;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
      }
    </style>
    <div id="content">
      <div class="row">
        <div class="col-md-12">
          <div class="container">
              <div class="cardd mb-5 mt-5">
                <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                  <i class="checkmark">✓</i>
                </div>
                  <h1>Success</h1> 
                  <p>Thanking you to shop with BiGshot. Your order has successfully placed. You will
                      receive your parcel within # Dhaka Metro 1-3 working days # Bangladesh wide 2-5 working days.
                      You can find the update your order in your account under order history
                      @if(Auth::check())
                      <a  style="text-decoration: none;" href="{{url('order-list')}}"> Your order details</a></p>
                      @endif 
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection