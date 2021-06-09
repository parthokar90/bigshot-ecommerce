@extends('front.layouts.front_master')
@section('content')
<div id="content" class="container p-0 mb-2">
<div class="container">
</div>
   <h4 class="text-center">Customer Support</h4>
 <!-- d-flex start -->
   <div class="d-flex flex-wrap">
     <div class="col-md-3" style="padding: 0px;"></div>
        <div class="col-md-6 col-12" style="padding: 0px;">
          <div class="form-group">
            <label>Select Options</label>
            <select class="form-control" id="select_type">
                <option>Select</option>
                <option value="1">General enquiries</option>
                <option value="2">Request cancel or return</option>
            </select>
        </div>
        </div>
       <div class="col-md-3" style="padding: 0px;"></div>
     </div>
  <!-- d-flex end -->

        <!-- general form start -->
        <div class="mb-2" style="display:none;" id="g_form">
        <div class="d-flex flex-wrap">
           <div class="col-md-3"></div>
           <div class="col-md-6 col-12 border">
              <h4 class="text-center mt-2">General Enquiries Form</h4>
                 <form action=" {{route('genarelQuiry')}} " method="POST">
                        @csrf
                        <div class="form-group">
                          <label class=" control-label">Name</label>
                          <div class="">
                            <input class="form-control" type="text" name="" placeholder="Name" value="{{auth()->user()->name}} {{auth()->user()->last_name}}" readonly>
                          </div>
                        </div>
                          <div class="form-group">
                          <label class=" control-label">Email</label>
                          <div class="">
                            <input class="form-control" type="text" name="email" placeholder="Email" value="{{auth()->user()->email}}" readonly>
                          </div>
                        </div>
                          <div class="form-group">
                          <label class=" control-label">Subject</label>
                          <div class="">
                            <input class="form-control" type="text" name="subject" placeholder="Subject" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class=" control-label">Your Message</label>
                          <div class="">
                            <textarea class="form-control"  type="text" name="message" autocomplete="off" placeholder="Your Message" required></textarea>
                          </div>
                        </div>
                          @if($admin_reply->count()>0)
                              <div class="border pl-2 pr-2 text-justify mb-2">
                                <h6>Admin Reply</h6>
                                  <span>
                                    @foreach($admin_reply as $key=>$reply)
                                      {{++$key}}:  {{$reply->post_excerpt}}<br> 
                                    @endforeach 
                                  </span>
                              </div>
                          @endif 
                        <div class="form-group" style="text-align: center;">
                            <button style="background:#00B0F0!important;" type="submit" class="btn btn-info">Submit</button>
                        </div>
                      </form>
                  </div>
                 <div class="col-md-3"></div>
              </div>
           </div>
        <!-- general form end -->


        <!-- order form type select -->
              <div style="display:none; text-align:center;" id="order_form_type">
                <div class="d-flex flex-wrap">
                 <div class="col-md-3 col-3"></div>
                 <div class="col-md-6 col-6">
                    <div class="form-group">
                      <input type="radio" id="full_orders" name="order_type" value="full">
                      <label for="full_orders">Full order</label><br> 
                      <input type="radio" id="partial_orders" name="order_type" value="partial">
                      <label for="partial_orders">Partial order</label><br>
                    </div>
                 </div>
                 <div class="col-md-3 col-3"></div>
                </div>
             </div>
        <!-- order form type select end -->



        
         <!-- partial order form start -->
              <div id="partial_order_form" style="display: none;">
                    <div class="d-flex flex-wrap">
                     <div class="col-md-3" style="padding: 0px;"></div>
                     <div class="col-md-6 col-12" style="padding: 0px;">   
                       <h5>Partial order cancel</h5>
                      <form method="POST" action="{{route('s_cancel')}}" target="_blank">
                                @csrf
                                <input type="hidden" name="cancel_option" value="partials">
                                <div id="order_id" class="form-group">
                                  <label>Select Order Id <span style="color:red">*</span> </label>
                                  <select id="pc" class="form-control" name="customer_order_id">
                                    <option value="">Chose Order Id</option>
                                    @foreach($order_list as $single_order)
                                      <option value="{{$single_order->order_id}}">{{$single_order->order_id}}</option>
                                    @endforeach 
                                  </select>
                            </div>
                       </form>
                     </div>
                     <div class="col-md-3" style="padding: 0px;"></div>
                  </div>                  
               </div>                  
        <!-- partial order form end -->

        <!-- full order form start -->
            <div id="full_order_form" style="display: none;">
                <div class="d-flex flex-wrap">
                     <div class="col-md-3" style="padding: 0px;"></div>
                     <div class="col-md-6 col-12" style="padding: 0px;">
                             <form method="POST" action="{{route('s_cancel')}}" id="full_order_form" class="border">
                                @csrf
                                <h5 class="text-center mt-2">Full order cancel</h5>
                                <input type="hidden" name="cancel_option" value="full">
                                <div id="order_id" class="form-group mt-3 ml-3 mr-3">
                                  <select id="customer_order_id" class="form-control" name="customer_order_id">
                                    <option value="">Chose Order Id</option>
                                    @foreach($order_list as $single_order)
                                      <option value="{{$single_order->order_id}}">{{$single_order->order_id}}</option>
                                    @endforeach 
                                  </select>
                                </div>
                                <div class="red">
                                  <div class="form-group mt-3 ml-3 mr-3">
                                    <label class=" control-label">
                                    </label>
                                    <textarea class="form-control" type="text" name="c_reason"  placeholder="Reason for Cancellation" required></textarea>
                                  </div>
                                </div>                          
                              <div style="text-align:center">
                                 <button style="background:#00B0F0!important;" type="submit" class="btn btn-primary mb-2">Submit</button>
                              </div>
                            </form>
                            </div>
                            <div class="col-md-3" style="padding: 0px;"></div>
                        </div>
                   </div>
              <!-- full order form end -->

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  @include('error_message.message')
<script>
  $("#select_type").change(function(){
     var select_val=$("#select_type").val();
       if(select_val==1){
          $("#g_form").show();
          $("#order_form_type").hide();
           $("#full_order_form").hide();
            $("#partial_order_form").hide();
            $("input:radio").attr("checked", false);
       }
      if(select_val==2){
          $("#g_form").hide();
          $("#order_form_type").show();
           $("#full_order_form").hide();
            $("#partial_order_form").hide();
       }
  });
   $("#full_orders, #partial_orders").change(function () {
        if ($("#full_orders").is(":checked")) {
            $("#full_order_form").show();
            $("#partial_order_form").hide();
        }
        if ($("#partial_orders").is(":checked")) {
             $("#full_order_form").hide();
             $("#partial_order_form").show();
        }
    });    

 $('#pc').on('change', function(){
    $(this).closest('form').submit();
    $('#pc').prop('selectedIndex', 0);
 });
</script>

</div>      
@endsection