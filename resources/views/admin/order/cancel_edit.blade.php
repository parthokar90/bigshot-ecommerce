@extends('admin.layouts.master')
@section('content')
<style>
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
<div class="content-wrapper" style="min-height: 1203.6px;" id="app">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Edit Order</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('admin.includes.messages')
      <div class="row">
        <input type="hidden" name="id" value="{{$id}}">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header bg-dark">
              @php $order_sub_total=0; $skuu=''; $address=''; $mobile_no=''; $check_out=''; $customer_ip=''; $shipping_address='';$shipping_city=''; $zip=''; $district=''; @endphp
              @foreach($order_info as $info)
              @if($info->meta_key=='phone')
              @php $mobile_no=$info->meta_value; @endphp
              @endif
              @if($info->meta_key=='address_one')
              @php $address=$info->meta_value; @endphp
              @endif

              @if($info->meta_key=='zip')
              @php $zip=$info->meta_value; @endphp
              @endif

              @if($info->meta_key=='district')
                @php $district=$info->meta_value; @endphp
              @endif

              @if($info->meta_key=='_sku')
              @php $sku=$info->meta_value; @endphp
              @endif
              @if($info->meta_key=='payment_method')
              @php $check_out=$info->meta_value; @endphp
              @endif
              @if($info->meta_key=='_customer_ip_address')
              @php $customer_ip=$info->meta_value; @endphp
              @endif

              @if($info->meta_key=='address_two')
              @php $shipping_address=$info->meta_value; @endphp
              @endif

              @if($info->meta_key=='city')
              @php $shipping_city=$info->meta_value; @endphp
              @endif


              @if($info->meta_key=='_customer_user')
              @php $customer=$info->meta_value; $user=DB::table('users')->where('id',$customer)->first();  @endphp
              @endif
              @endforeach
              <h3 class="card-title" style="width: 100%">Order #{{$id}} details </h3>

              <h3 class="card-title">Payment via {{$check_out}}</h3>

            </div>
            <div class="card-body d-flex justify-content-between flex-row " style="display: block;">
              <div class="genarel">
                <div class="font-weight-bold">Genarel</div>
                <div class="mt-3">

                  <div class="form-group">
                    <label for="dateCreated">Date created:</label>
                    {{date('Y-m-d',strtotime($order->post_date))}}<br>
                   <label for="">Status:</label>
                    @php $current_status=$order->post_status; @endphp
                      @if($current_status=='dispatch_complete')
                        Dispatch Complete 
                      @elseif($current_status=='on-hold') 
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
                  </div>
                </div>
              </div>
              <div>
                <div class="font-weight-bold">Customer Details</div>
                <div class="mt-3">
                  @if(isset($user->name)){{$user->name}} @else Guest @endif <br>
                  {{$address}}
                </div>
                <div class="font-weight-bold">Email Address</div>
                <div> @if(isset($user->email)){{$user->email}} @endif</div>

                <div class="font-weight-bold mt-2">Phone</div>
                <div>{{$mobile_no}}</div>
              </div>
              <div>
                <div class="font-weight-bold">Shipping  Address:</div>
                <div class="mt-3">
                   @php 
                    $user_district=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_district')->first();
                    $user_city=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_city')->first();
                    $user_zip=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_zip')->first();
                   @endphp

                   @if(isset($user_district))
                   District: {{$user_district->meta_value}}<br>
                   City: {{$user_city->meta_value}}<br>
                   Zip: {{$user_zip->meta_value}}
                   @endif 
                
                </div>
              </div>

            </div>
          </div>
     
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title" style="width: 100%">Item Info</h3>
              </div>

              <div class="card-body d-flex justify-content-between flex-row " style="display: block;">
                <table class="table table-striped">
                  <thead class="thead-light">
                    <tr> 
                      <th scope="col">#</th>
                      <th scope="col">Image</th>
                      <th  scope="col">Item</th>
                      <th scope="col">Details</th>
                      <th scope="col">Price</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Total</th>



                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $pr=0;
                    $subtotal=0;
                    $qty=0;
                    $total=0;
                    $grandTotal=0;
                    $grandLinetotal=0;
                    $total_sub=0;
                    $att=0;
                    @endphp
                    @foreach($products as $key=>$items)
                    @foreach($items->orderMeta as $value)
                    @php
                    if($value->meta_key=='_line_subtotal'){
                    $subtotal=$value->meta_value;
                    }
                    if($value->meta_key=='_qty'){
                    $qty=$value->meta_value;
                    }
                    if($value->meta_key=='_line_total'){
                    $total=$value->meta_value;
                    }
                     if($value->meta_key=='attribute_parent'){
                       $att=$value->meta_value;
                    }
                    @endphp
                    @endforeach
                    
                    <tr>
                      <th scope="row">{{++$key}}</th>
                      <th scope="row">
                        @php
                        $image=DB::table('postmeta')
                        ->where('post_id',$items->product_parent)
                        ->where('meta_key','attached_file')        
                        ->first(); 
                        @endphp
                        @if(isset( $image))
                        <img width="50px" height="50px" src="{{asset('backend/products/'.$image->meta_value)}}">
                        @endif 
                       </th>
                      <td>{{$items->order_item_name}} <br>
                       @php 
                       $skuu=DB::table('postmeta')->where('post_id',$items->product_parent)->where('meta_key','_sku')->first(); 
                       @endphp 
                       @if(isset($skuu))
                       {{$skuu->meta_value}}
                       @endif 
                       </td>
                      <td>
                        <table class="table">
                          <tbody>
                             @php 
                                $list_att=DB::table('postmeta')->where('post_id',$att)
                                ->where('meta_key','attribute')->get(); 
                             @endphp
                             @foreach($list_att as $a)
                              @php $data_att=json_decode($a->meta_value); @endphp 
                                  @foreach($data_att as $da)
                                    <tr>
                                      <td>{{$da->taxonomy}}:</td>
                                      <td>{{$da->term}}</td>
                                    </tr>
                                @endforeach 
                             @endforeach 
                          </tbody>
                        </table>
                      </td>
                      <td>
                      @php 
                       $p=DB::table('postmeta')->where('post_id',$items->product_parent)->where('meta_key','sale_price')->first(); 
                       @endphp 
                       @if(isset($p))
                       {{number_format($p->meta_value)}} @php $pr=$p->meta_value; @endphp
                       @endif 
                      </td>
                       
                      <td>

                        {{$qty}} pcs
                      <form method="post" action="{{route('update.order.quantity.admin')}}">
                            @csrf 
                        <input style="width:70px" type="number" name="qty" max="{{$qty}}" min="1"  value=""> 
                           <input type="hidden" name="product_id" value="{{$items->product_id}}">
                           <input type="hidden" name="product_price" value="{{$pr}}">
                      <input type="hidden" name="att_id" value="{{$att}}">
                      <input type="hidden" name="order_id" value="{{$id}}">
                      <input type="hidden" name="order_item_id" value="{{$value->order_item_id}}">
                      <input type="hidden" name="total" value="{{$subtotal}}">
                         <button type="submit" class="btn btn-success"><i class="fa fa-times"></i></button>
                          </form>
                       </td>
                 
                      <td>{{number_format($subtotal)}} tk @php $order_sub_total+=$subtotal; @endphp</td>
             
                    

                    </tr>
                     
                    @php
                    $grandTotal+=$subtotal;
                     $grandLinetotal +=$subtotal; 
                      @endphp
              
                    @endforeach
                       
                  </tbody>
                </table>
              </div>
              
      





              <div class="card-footer ">
                <div class="d-flex flex-column justify-content-end">

                  <div class="d-flex flex-row justify-content-end" style="font-size: 16px;">
                    <div class="font-weight-bold">Sub-Total: </div>
                    <div class="ml-1">             
                       {{number_format($order_sub_total)}} tk
                      </div>
                  </div>

                  <div class="d-flex flex-row justify-content-end" style="font-size: 16px;">
                    <div class="font-weight-bold"> Delivery Charge: </div>
                    <div class="ml-1">   
                                       
                       {{isset($delivery_charge)?number_format( $charge=$delivery_charge->meta_value):''}} tk
                      </div>
                  </div>
                      <div class="d-flex flex-row justify-content-end" style="font-size: 16px;">
                    <div class="font-weight-bold"> Coupon: </div>
                    <div class="ml-1">                    
                       {{isset($coupon)?number_format($coupon->meta_value):''}} tk
                      </div>
                  </div>
                  <div class="d-flex flex-row justify-content-end" style="font-size: 16px;">
                    <div class="font-weight-bold"> Order Total: </div>
                    @if(isset($coupon)) @php $c=$coupon->meta_value; @endphp @else @php $c=0; @endphp   @endif
                    <div class="ml-1">  {{number_format($grandLinetotal+$charge-$c)}} tk</div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 text-center">
                    <a href="{{ url()->previous() }}"  class="btn btn-success mb-2"> Back</a>
               </div> 
         
  
        </div>
      </div>
      <!-- /.card-body -->
    </div>
</div>
</div>

<!-- /.col -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{asset('assets/admin/js/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script type="text/javascript">
  tinymce.init({
    selector: 'textarea',
    height: 400,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
    content_css: '//www.tiny.cloud/css/codepen.min.css'
  });
</script>
@endsection