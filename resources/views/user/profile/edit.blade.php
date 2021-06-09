@extends('front.layouts.front_master')
@section('title') Bigshot | Home @endsection 
@section('content')
<div class="container">
         <h3 class="text-center">Edit Profile</h3>
         @php $f_name='';$l_name=''; $image=''; $address_one=''; $address_two=''; $phone=''; $country='';$state=''; $city=''; $zip=''; @endphp
          @foreach($user_info as $info)
          @if($info->meta_key=='first_name')
          @php $f_name=$info->meta_value; @endphp
          @endif
          @if($info->meta_key=='last_name')
          @php $l_name=$info->meta_value; @endphp
          @endif

          @if($info->meta_key=='address_two')
          @php $address_two=$info->meta_value; @endphp
          @endif
          @if($info->meta_key=='phone')
          @php $phone=$info->meta_value; @endphp
          @endif
          @if($info->meta_key=='country')
          @php $country=$info->meta_value; @endphp
          @endif
          @if($info->meta_key=='state')
          @php $state=$info->meta_value; @endphp
          @endif
          @if($info->meta_key=='city')
          @php $city=$info->meta_value; @endphp
          @endif
          @if($info->meta_key=='zip')
          @php $zip=$info->meta_value; @endphp
          @endif
          @if($info->meta_key=='user_image')
          @php $image=$info->meta_value; @endphp
          @endif
          @endforeach
          <div class="row">
          <div class="col-md-12">
                 <form action="{{route('profile.update',$user->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                         <div class="form-group">
                              <label for="firstName">First name<span class="requiredField">*</span></label>
                              <input type="text" class="form-control" id="firstName" value="{{auth()->user()->name}}" name="first_name" placeholder="First Name" autocomplete="off">
                         </div>
                         <div class="form-group">
                             <label for="lastName">Last name<span class="requiredField">*</span></label>
                             <input type="text" class="form-control" id="lastName" value="{{$l_name}}" name="last_name" placeholder="Last Name" autocomplete="off">
                         </div>
                         <div class="form-group">
                             <label for="address">Address<span class="requiredField"></span></label>
                              <input type="text" class="form-control" id="address" value="{{$address_two}}" name="address_two" placeholder="Address" autocomplete="off">
                         </div>
                         <div class="form-group">
                             <label for="phone">Mobile<span class="requiredField">*</span></label>
                             <input type="text" class="form-control" name="phone" value="{{$phone}}" id="phone" placeholder="Mobile" required autocomplete="off">
                         </div>
                         <!-- <div class="form-group">
                             <label for="zip">Photo</label>
                             @if($image=='')
                               <img width="50px" height="50px" src="{{asset('assets/front/user/user.png')}}"><br>

                             @else 
                                <img width="50px" height="50px" src="{{asset('assets/front/user/'.$image)}}">
                            </br>  </br>
                            @endif 
                                <input type="file" class="form-control" name="user_image" style="padding: 3px;">
                                <input type="hidden" class="form-control" name="d_image" value="{{$image}}">
                         </div> -->
                         <button type="submit" class="btn btn-primary float-left mb-3">Update Information</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
