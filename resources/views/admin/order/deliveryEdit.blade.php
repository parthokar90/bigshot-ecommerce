@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;" id="app">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Delivery Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Edit Delivery Order</li>
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
        <div class="col-md-9">
          <div class="card card-default">
            <div class="card-header">
              @php $address=''; $mobile_no=''; $check_out=''; $customer_ip=''; $shipping_address='';$shipping_city=''; @endphp
              @foreach($order_info as $info)
              @if($info->meta_key=='phone')
              @php $mobile_no=$info->meta_value; @endphp
              @endif
              @if($info->meta_key=='address_one')
              @php $address=$info->meta_value; @endphp
              @endif

              @if($info->meta_key=='_sku')
              @php $sku=$info->meta_value; @endphp
              @endif
              @if($info->meta_key=='_created_via')
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
              @php $customer=$info->meta_value; $user=DB::table('users')->where('id',$customer)->first(); @endphp
              @endif
              @endforeach
              <h3 class="card-title" style="width: 100%">Order #{{$id}} details </h3>

              <h3 class="card-title">Payment via {{$check_out}}. Customer IP: {{$customer_ip}}</h3>

            </div>
            <div class="card-body d-flex justify-content-between flex-row " style="display: block;">
              <div class="genarel">
                <div class="font-weight-bold text-center">Genarel</div>
                <div class="mt-3">

                  <div class="form-group">
                    <label for="dateCreated">Date created:</label>
                    {{date('Y-m-d',strtotime($order->post_date))}}

                  </div>
                    <div class="form-group">
                 <label for=""> Status:</label>
                  {{$order->post_status}}
                  </div>

                </div>
              </div>
              <div>
                <div class="font-weight-bold">Billing</div>
                <div class="mt-3">
                  @if(isset($user->name)){{$user->name}} @endif <br>
                  {{$address}}
                </div>
                <div class="font-weight-bold">Email Address</div>
                <div> @if(isset($user->email)){{$user->email}} @endif</div>

                <div class="font-weight-bold mt-2">Phone</div>
                <div>{{$mobile_no}}</div>
              </div>
              <div>
                <div class="font-weight-bold">Shipping</div>
                <div class="mt-3">
                  Address:{{$shipping_address}}<br>

                  City:{{$shipping_city}} <br>

                </div>
              </div>

            </div>
          </div>
          <form action="{{route('order.deliver.update')}}" method="POST">
            @csrf
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title" style="width: 100%">Item Info</h3>
              </div>
              <div class="card-body d-flex justify-content-between flex-row " style="display: block;">

                <table class="table table-striped">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Item</th>
                      <th scope="col">Cost</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $subtotal=0;
                    $qty=0;
                    $total=0;
                    $grandTotal=0;
                    $grandLinetotal=0;
                    $total_sub=0;
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
                    @endphp
                    @endforeach
                    <tr>
                      <th scope="row">{{++$key}}</th>
                      <td>{{$items->order_item_name}} </td>
                      <td>{{$subtotal/$qty}}</td>
                      <td><input type="number" name="qty[]" value="{{$qty}}"></td>
                      <td>{{$subtotal}}</td>
                      <input type="hidden" name="product_id[]" value="{{$items->product_id}}">
                      <input type="hidden" name="order_id" value="{{$id}}">
                      <input type="hidden" name="order_item_id[]" value="{{$value->order_item_id}}">
                      <input type="hidden" name="total[]" value="{{$subtotal}}">
                    </tr>
                    @php
                    $grandTotal +=$subtotal;
                     $grandLinetotal +=$total; 
                      @endphp
                    @endforeach
                  </tbody>
                </table>

              </div>
              <div class="card-footer ">
                <div class="d-flex flex-column justify-content-end">
                  <div class="d-flex flex-row justify-content-end">
                    <div> item Sub total:</div>
                    <div> $ {{$grandTotal}}</div>
                  </div>
                  <div class="d-flex flex-row justify-content-end">
                    <div> Order Total: </div>
                    <div> $ {{$grandLinetotal}}</div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 text-center">
              <button type="submit" value="submit" name="submit" class="btn btn-primary" >Update</button>
               </div>     
          </form>
        </div>
      </div>



      <!-- /.card-body -->
    </div>



</div>

</div>
</form>
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