@extends('front.layouts.front_master')

@section('content')
    
        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
        <div class="row">
          <div class="col-md-12">
            <div class="container" style="border: 1px solid;">
              <img src="{{asset('assets/front/images/bonus.png')}}" width="1110" height="180">
              <div>
                <h2 class="text-center mt-2">Your Stamps</h2>
                <p class="text-center">You are only 2 stamps away from claiming your discount!</p>
                <div class="text-center"><a href="/rewards">View your latest coupon in Rewards →</a></div>
              </div>
              <div>
                <section>
                  
                  <div class="row py-5">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 mb-3">
                      <img class="img-thumbnail" src="{{asset('assets/front/images/day1.png')}}">
                      <p class="text-center">Day 1</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 mb-3">
                      <img class="img-thumbnail" src="{{asset('assets/front/images/day1.png')}}">
                      <p class="text-center">Day 2</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 mb-3">
                      <img class="img-thumbnail" src="{{asset('assets/front/images/day1.png')}}">
                      <p class="text-center">Day 3</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 mb-3">
                      <img class="img-thumbnail" src="{{asset('assets/front/images/day1.png')}}">
                      <p class="text-center">Day 4</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 mb-3">
                      <img class="img-thumbnail" src="{{asset('assets/front/images/day1.png')}}">
                      <p class="text-center">Day 5</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 mb-3">
                      <img class="img-thumbnail" src="{{asset('assets/front/images/day1.png')}}">
                      <p class="text-center">Day 6</p>
                    </div>
                  </div><!-- e row -->
</section><!-- e section -->
              </div>
            </div>
          </div>

        </div>
      

        
      </div>
    </div>
@endsection
