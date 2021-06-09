
@extends('front.layouts.front_master')
@section('content')
<!-- Page Content  -->
<div class="container">
      @include('admin.includes.messages')
   <h4 class="text-center">My Orders List</h4>

    <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="center">Id</th>
                <th class="center">Date</th>
                <th class="right">Item</th>
                <th class="right">Quantity</th>
                <th class="right">Status</th>
                <th class="right">Action</th>
                <!-- <th class="right">Comments</th> -->
              </tr>
            </thead>
            <tbody>

                 @php $id=0; $qty=0; @endphp
                 @foreach($shop_order as $key=>$order)
                   <tr>
                     <td>{{$order->ID}}</td>
                     <td>Order placed: {{date('d-M-Y',strtotime($order->post_date))}}</td>
                     <td>
                      @foreach($order->orderItem as $item)
                      
                      @foreach($item->orderMeta as $meta)
                        @if($meta->meta_key=='_product_id')
                           @php $id=$meta->meta_value; @endphp
                        @endif
                      @endforeach
                       <table class="table">
                        <tbody>
                          <tr>
                            <td style="border: 0px solid #ffffff;">
                              {{$item->order_item_name}}<br> 
                               @php $product_sku=DB::table('postmeta')->where('post_id',$id)->where('meta_key','_sku')->first(); @endphp
                              {{$product_sku->meta_value}}
                            </td>
                            <td style="border: 0px solid #ffffff;">
                               @php $product_img=DB::table('postmeta')->where('post_id',$id)->where('meta_key','attached_file')->first(); @endphp
                              <img width="50px" height="50px" src="{{asset('backend/products/'.$product_img->meta_value)}}">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                        @endforeach
                     </td>


                     <td>
                        @foreach($order->orderItem as $item)
                        @foreach($item->orderMeta as $meta)
                        @if($meta->meta_key=='_qty')
                          @php $qty=$meta->meta_value; @endphp
                        @endif
                        @endforeach
                       <table class="table">
                        <tbody>
                          <tr>
                            <td style="border: 0px solid #ffffff;">{{$qty}}</td>
                            <td style="border: 0px solid #ffffff;">Pc's</td>
                          </tr>
                        </tbody>
                      </table>
                        @endforeach
                     </td>
                     <td>{{$order->post_status}}</td>
                     <td>
                        <a title="view invoice" class="btn btn-success btn-sm" href="{{route('customer_ordere_edit',$order->ID)}}"><i class="fa fa-eye"></i></a>
                        @if($order->post_status=='cancel')
                          @else 
                        <a title="cancel or return order" class="btn btn-danger btn-sm" href="{{route('customer_ordere_cancel',$order->ID)}}"><i class="fa fa-times"></i></a>
                        @endif 
                     </td>
                   </tr>  
                  @endforeach
            </tbody>
      </table>
  {{$shop_order->links()}}
</div>
</div>
@endsection