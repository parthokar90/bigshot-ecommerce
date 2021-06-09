@extends('front.layouts.front_master')
@section('content')
<style>
    table tr td{
        font-size: 0.8em;
    }
    .table td, .table th{
        padding: 10px 5px
    }
    ::placeholder{
        font-size: 12px;
    }
    @media (max-width: 767px) {
    .productChanQty{
        padding: 0px;
        min-width: 20px;
    }
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
<div class="container p-0">
   <div style="text-align:center"><a class="btn btn-success btn-sm" href="{{route('order-list.index')}}"><i class="fas fa-arrow-left"></i> Back to list</a></div>   
    <h6 class="text-center" style="color:#00b0f0;">Select item you want to cancel or return</h6>
       <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
    <div class="table-responsive" style="border:1px solid;padding:0px solid;">
        <table class="table">
            <thead>
                <tr style="background:#e7e7e7">
                    <td>Order placed<br> 
                        {{date('d-m-Y',strtotime($order->post_date))}}</td>
                    <td>  @php $current_status=$order->post_status; @endphp
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
                      @endif<br>
                        {{date('d-m-Y',strtotime($order->post_modified))}}
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                 @php $qty=0; $cancel_qty=0; $acq=0; @endphp  
            @foreach($order_item as $item)
                <tr style="padding:0px;">
                    <td style="border:none">
                      @php 
                       $d_img=DB::table('postmeta')
                       ->where('post_id',$item->product_id) 
                       ->where('meta_key','attached_file')
                       ->first(); 
                       $a_img=DB::table('posts')
                       ->where('ID',$item->product_id) 
                       ->where('meta_key','attached_file')
                       ->join('postmeta','postmeta.post_id','=','posts.post_parent')
                       ->first(); 
                        $d_sku=DB::table('postmeta')
                       ->where('post_id',$item->product_id) 
                       ->where('meta_key','_sku')
                       ->first();
                         $a_sku=DB::table('posts')
                       ->where('ID',$item->product_id) 
                       ->where('meta_key','_sku')
                       ->join('postmeta','postmeta.post_id','=','posts.post_parent')
                       ->first();
                       @endphp
                       @if(isset($d_img))
                        <img width="50px" height="50px" src="{{asset('backend/products/'.$d_img->meta_value)}}">
                       @endif</br>
                       @if(isset($d_sku))
                       <span class="ml-1"> {{$d_sku->meta_value}}</span>
                       @endif 
                  
                        @if(isset($a_img))
                        <img width="50px" height="50px" src="{{asset('backend/products/'.$a_img->meta_value)}}">
                       @endif</br> 
                        @if(isset($a_sku))
                          <span class="ml-1">{{$a_sku->meta_value}}</span>
                       @endif
                   
                    </td>
                       @foreach($item->orderMeta as $meta)
                                       @if($meta->meta_key=='cancel_quantity')
                                         @php $cancel_qty=$meta->meta_value; @endphp
                                        @endif 
                                        @if($meta->meta_key=='_qty')
                                          @php $acq=$meta->meta_value; @endphp
                                        @endif
                        @endforeach 

                    <td style="border:0px solid #ffffff">
                        {{$item->order_item_name}} 
                            @php 
                                $list_att=DB::table('postmeta')->where('post_id',$item->product_id)
                                ->where('meta_key','attribute')->get(); 
                                @endphp
                                  @foreach($list_att as $a)
                                  @php $data_att=json_decode($a->meta_value); @endphp 
                                  @foreach($data_att as $da)
                                   {{ucfirst($da->term)}}
                                    @endforeach 
                                  @endforeach 

                                  Qty: {{$acq}}
                        </td>
                        <form method="post" action="{{route('customer_order_cancel_item')}}">
                            @csrf 
                            <td style="border:0px solid #ffffff"> 
                                   @if($acq>0)
                                    <select style="width:100%;"  name="request_qty" id="request_qty" class="form-control productChanQty">
                                        @for($i=1;$i<=$acq;$i++)
                                        <option value="{{$i}}" class="p-0">{{$i}}</option>
                                        @endfor
                                    </select>
                                    @endif 
                                    <input type="hidden" class="form-control" name="cancel_item_id" value="{{$item->order_item_id}}">
                                    <input type="hidden" class="form-control" name="cancel_product_id" value="{{$item->product_id}}">
                                    <input type="hidden" class="form-control" name="cancel_order_id" value="{{$item->order_id}}">
                        
                            </td>
                            <td style="border:0px solid #ffffff"> 
                              @if($acq>0)   
                            <button style="font-size: 10px;" onclick="return confirm('Are you sure want to cancel this item??')" class="btn btn-danger btn-sm mt-2"><span style="color:white"> <i class="fa fa-times"></i> </span></button>
                            @endif 
                            </td>
                           @php 
                           $tot_qty=DB::table('order_itemmeta')
                           ->where('order_id',$item->order_id) 
                           ->where('meta_key','_qty')
                           ->sum('meta_value'); 
                            $tot_qty_cancel=DB::table('order_itemmeta')
                           ->where('order_id',$item->order_id) 
                           ->where('meta_key','cancel_quantity')
                           ->sum('meta_value'); 
                           $acc_qty=$tot_qty-$tot_qty_cancel;
                           @endphp
                             <input type="hidden" name="stock_order_qty" value="{{$acc_qty}}">
                        </form>
            </tr>
            @endforeach 
            </tbody>
        </table>
@if($order->post_status=='cancelled')
 @else 
    <form method="post" action="{{route('customer_order_cancel_item_full')}}">
        @csrf 

        <div class="form-group">
            <textarea cols="2" rows="2" class="form-control" name="reason" placeholder="Reason for return/cancel" autocomplete="off" required></textarea>
        </div>
        <input type="hidden" name="o_id" value="{{$order->ID}}">
       <div style="text-align:center"> <button style="background:#00b0f0;" onclick="return confirm('Are you sure want to cancel full order??')" class="btn btn-info mb-3"><span style="color:white">Submit</span></button></div> 
    </form>  
    @endif 
    </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
@include('error_message.message')
@endsection