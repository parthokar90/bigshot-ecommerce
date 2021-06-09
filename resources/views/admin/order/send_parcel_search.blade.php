@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Send Parcel List</li>
          </ol>
        </div>
      </div>
    </div>
    <div class="s002">
     <div class="d-flex font-weight-bold justify-content-center h2 mb-3">Search Send Parcel List</div>
     <div class="d-flex justify-content-center mb-3">
      <form class="form-inline" method="post" action="{{route('send.parcel.search')}}" >
        @csrf()          
        @foreach($checkId as $value)
        <input type="hidden" name="checkid[]" value="{{$value}}">
        @endforeach
        <div class="form-group mb-2">
          <label for="depart" class="mr-2">Order Id</label>
          <input required type="text" class="form-control" name="order_id" placeholder="Scanner or Order Id" />
        </div>
        <button type="submit" class="btn btn-primary mb-2">SEARCH</button>
      </form>
    </div>
  </div>
</section>
<section class="content" >
  <div class="container">
         @include('admin.includes.messages')

    <div class="card">
      <div class="card-body">
        <form method="post" action="{{route('parcel_print')}}" enctype="multipart/form-data">
          @csrf 

          <div class="table-responsive-sm">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="center">Oder Id</th>
                  <th>Cust.Info</th>
                  <th class="text-center">Items Details</th>
                  <th class="right">Delivery Charge</th>
                  <th class="right">Coupon</th>
                  <th class="right">Amount</th>
                  <th class="right">Action</th>
                </tr>
              </thead>
              <tbody>
                @php $total_parcels=0; $to_items_parcel=0; $tot_parcel=0; $to_amount_charge=0; $att=0; $q=0;$s=0; $att=0; $total_parcel=0; $product=''; $qty=0; $subtotal=0; $grandTotal=0; $mobile_no=''; $address=''; $sku=''; $customer=''; $first_name=''; $last_name=''; @endphp
                @foreach($orders as $key=>$item)
                 @php $total_parcels=++$key; @endphp
                @foreach($item->productMeta as $info) 
                @if($info->meta_key=='phone')
                @php $mobile_no=$info->meta_value; @endphp
                @endif 
                @if($info->meta_key=='address_one')
                @php $address=$info->meta_value; @endphp
                @endif  
                @if($info->meta_key=='first_name')
                @php $first_name=$info->meta_value; @endphp
                @endif 
                @if($info->meta_key=='last_name')
                @php $last_name=$info->meta_value;
                $lineItem=0;
                @endphp
                @endif 
                @endforeach
                <tr>
                  <td class="left">{{$item->ID}} <input type="hidden" name="order[]" value="{{$item->ID}}"></td>
                  <td class="left">{{$first_name}} {{$last_name}}<br>{{$address}} <br>{{$mobile_no}}</td>
                  <td class="left">
                   <table style="width:100%">
                    <tr>
                      <th>Name</th>
                      <th>Details</th>
                      <th>Qty</th>
                      <th>Amount</th>
                    </tr>
                    <input type="hidden" class="totalItem" name="totalItem[]" value="{{count($item->orderItem)}}">
                    @foreach($item->orderItem as $meta)

                    <tr>
                      <td >{{$meta->order_item_name}}</td>
                      <td style="font-size: .65rem;width:40%" >
                       @foreach($meta->orderMeta as $value)
                       @if($value->meta_key=='attribute_parent')
                       @php $att=$value->meta_value; @endphp
                       @endif 
                       @endforeach
                       @php 
                       $list_att=DB::table('postmeta')->where('post_id',$att)
                       ->where('meta_key','attribute')->get(); 
                       @endphp
                       @foreach($list_att as $a)
                       @php $data_att=json_decode($a->meta_value); @endphp 
                       @foreach($data_att as $da)
                       {{strtoupper($da->taxonomy)}} : {{strtoupper($da->term)}}
                     </br>
                     @endforeach 
                     @endforeach 
                   </td>
                   <td >
                     @foreach($meta->orderMeta as $value)
                     @if($value->meta_key=='_qty')
                     @php $q=$value->meta_value; @endphp
                     @endif 

                     @if($value->meta_key=='attribute_parent')
                     @php $att=$value->meta_value; @endphp
                     @endif 

                     @endforeach
                     {{$q}} @php $tot_parcel+=$q;
                     $lineItem +=$q;
                     @endphp
                   </td>
                   <td >
                     @foreach($meta->orderMeta as $value)
                     @if($value->meta_key=='_line_subtotal')
                     @php $s=$value->meta_value; @endphp
                     @endif 
                     @endforeach
                     {{number_format($s)}} 

                   </td>
                 </tr>

                 @php $to_items_parcel++; @endphp
                 @endforeach
               </table>
             </td>
             
             <td class="left">
              <input type="hidden" class="totalLineItem" name="totalLineItem[]" value="{{$lineItem}}">
              @php $delivery=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery)) @php $charge=$delivery->meta_value; @endphp @else @php $charge=0; @endphp @endif {{$charge}}
            </td>
            <td class="left">
             @php $coupon=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','coupon_taka')->first(); @endphp @if(isset($coupon)) @php $c=$coupon->meta_value; @endphp @else @php $c=0; @endphp @endif {{number_format($c)}}
             @php $total_order=DB::table('order_itemmeta')->where('order_id',$item->ID)->where('meta_key','_line_subtotal')->sum('meta_value'); @endphp 
           </td>
           <td class="left">{{number_format($total_order+$charge-$c)}} tk</td>
           <!-- <td class="right"><a onclick="return confirm('are you sure?')" class="btn btn-danger btn-sm" href="{{route('send.parcel.search.remove',$item->ID)}}"><i class="text-white fa fa-times"></i>con</td> -->
             <td class="right"><a onclick="return confirm('are you sure?')" class="btn btn-danger btn-sm btn-remove" ><i class="text-white fa fa-times"></i> </td> 

             </tr>
             @endforeach 
           </tbody>
         </table>
       </div>
       <div class="row">
        <div class="col-lg-4 col-sm-5">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    @if($orders->count()>0)
    <div class="col-md-3">
     <input type="text" class="form-control" name="delivery_company" placeholder="Delivery Company" autocomplete="off" required>
   </div>

   <div class="col-md-3">   
    <button type="button" class="btn btn-danger">            
     {{$total_order_processing}}
     Processing
   </button>
 </div>
 <div class="col-md-3">          
   <button type="button" class="btn btn-success">            
     <span id="totalItemParcel"> {{$total_parcels}}</span>

     Total  Percel
   </button>
 </div>

<div class="col-md-3">
  <button onclick="return confirm('Do you want to Submit?')" class="btn btn-primary" type="submit">Submit & Print</button>
</div>
@endif 
</div>  
</form>     
</div>
</section>
</div>
@endsection
@section('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
  $( document ).ready(function() {

   $("body").on("click", ".btn-remove", function(){
    var info=$('#totalItemParcel').text();
    var removeItem= $(this).closest('tr').find('.totalItem').val();
    info=parseInt(info)-parseInt(removeItem);  
    $('#totalItemParcel').text(info);

    var totalQty=$('#totalQty').text();
    var lineItem= $(this).closest('tr').find('.totalLineItem').val();

    var newItem=parseInt(totalQty)-parseInt(lineItem);  
    $('#totalQty').text(newItem);

    $(this).parents('tr').remove();
  });
 });
  
</script>

@endsection