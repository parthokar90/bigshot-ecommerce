@extends('front.layouts.front_master')
@section('content')
<style>
    table tr td, th{
        font-size: 0.8em;
    }
    .table td, .table th {
    padding: .25rem;
}
    .pending{
      color:darkblue
    }
    .processing{
       color: lightblue;
    }
    .dispatch{
      color:orange;
    }
    .delivered{
      color:green;
    }
    .cancel{
      color:red;
    }
</style>
<!-- Page Content  -->
<div class="container p-0">
    @include('admin.includes.messages')
    <h4 class="text-center mb-3">My Order List</h4>
    <div class=""> 
    <!-- main header area start -->
     @php $item_id=0; $current_status=''; @endphp
    @foreach($shop_order as $key=>$order)
    <div class="d-flex flex-wrap justify-content-center" >
    <div class="d-flex flex-wrap col-md-6 " style="background:#e7e7e7;font-size:10px;padding:10px 0px;font-weight:bold;">
         <div class="col-md-3 col-3">
             <span>Order Placed</span><br>
             {{date('d-m-Y',strtotime($order->post_date))}}
          </div>
         <div class="col-md-3 col-3">
            @php $current_status=$order->post_status; @endphp
            @if($current_status=='on-hold') 
              <span class="pending">Pending</span>
              @elseif($current_status=='processing')
              <span class="processing">Processing</span>
               @elseif($current_status=='dispatch')
              <span class="dispatch">Dispatch</span>
               @elseif($current_status=='delivered')
              <span class="delivered">Delivered</span>
               @else
              <span class="cancel">Cancelled</span>
            @endif
              <br>
              {{date('d-m-Y',strtotime($order->post_modified))}}
         </div>
         <div class="col-md-3 col-3">
            @php 
             $modified_date=date('Y-m-d',strtotime($order->post_modified));
             $date = new DateTime(date($order->post_modified));
             $date->modify('+7 day');
             $seven_days=$date->format('Y-m-d');
             @endphp 
           @if($order->post_status=='delivered' && $modified_date> $seven_days)
              @else
              <a title="view invoice" href="{{route('customer_ordere_cancel',$order->ID)}}">
                  <span>Cancel/Return?</span>
              </a>
           @endif  
         </div>
         <div class="col-md-3 col-3">
            <a title="view invoice" href="{{route('customer_ordere_edit',$order->ID)}}"> Details</i></a> 
         </div>
    </div>
    </div>

    <!-- item list area start -->
      @php $qty=0; $cancel_qty=0; @endphp  
      @foreach($order->orderItem as $item)
        <div class="d-flex flex-wrap mt-3 mb-3 justify-content-center">
         <div class="d-flex flex-wrap col-md-6 p-0 m-0">
            <div class="col-md-3 col-3">
                  <!-- default image and sku -->
                      @php 
                       $d_img=DB::table('postmeta')
                       ->where('post_id',$item->product_id) 
                       ->where('meta_key','attached_file')
                       ->first(); 
                        $d_sku=DB::table('postmeta')
                       ->where('post_id',$item->product_id) 
                       ->where('meta_key','_sku')
                       ->first();
                       @endphp
                   
                       @if(isset($d_img))
                        <img width="35px" height="35px" src="{{asset('backend/products/'.$d_img->meta_value)}}">
                       @endif  <br>
                         @if(isset($d_sku))
                        {{$d_sku->meta_value}}
                       @endif
                   <!-- default image and sku   -->

                   <!-- attribute sku and image -->
                       @php 
                        $a_img=DB::table('posts')
                       ->where('ID',$item->product_id) 
                       ->where('meta_key','attached_file')
                       ->join('postmeta','postmeta.post_id','=','posts.post_parent')
                       ->first(); 
                        $a_sku=DB::table('posts')
                       ->where('ID',$item->product_id) 
                       ->where('meta_key','_sku')
                       ->join('postmeta','postmeta.post_id','=','posts.post_parent')
                       ->first(); 
                        @endphp
                    
                        @if(isset($a_img))
                          <img width="35px" height="35px" src="{{asset('backend/products/'.$a_img->meta_value)}}">
                        @endif<br> 
                        @if(isset($a_sku))
                          {{$a_sku->meta_value}}
                        @endif
                   <!-- attribute sku and image -->
            </div>
            <div class="col-md-3 col-3">
                {{$item->order_item_name}}
                   @php 
                   $list_att=DB::table('postmeta')->where('post_id',$item->product_id)
                   ->where('meta_key','attribute')->get(); 
                   @endphp
                  @foreach($list_att as $a)
                                  @php $data_att=json_decode($a->meta_value); @endphp 
                         @foreach($data_att as $da)
                              {{strtoupper($da->term)}}
                         @endforeach 
                 @endforeach 
            </div>
            <div class="col-md-3 col-3">
                @foreach($item->orderMeta as $meta)
                      @if($meta->meta_key=='cancel_quantity')
                          @php $cancel_qty=$meta->meta_value; @endphp
                       @endif 
                       @if($meta->meta_key=='_qty')
                         {{$meta->meta_value}} pcs
                      @endif
                @endforeach 
            </div>
            <div class="col-md-3 col-3">
                
            </div>
               </div>
        </div>
       @endforeach 
    <!-- item list area end -->

    @endforeach 
    <!-- main header area end -->
    </div> 
      {{$shop_order->links()}}
 
</div>
@endsection