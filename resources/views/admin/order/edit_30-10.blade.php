@extends('admin.layouts.master')
@section('content')
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
      <form action="{{route('update.order.status')}}" method="POST">
        {{ csrf_field() }}

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
                    <form>
                      <div class="form-group">
                        <label for="dateCreated">Date created:</label>
                        <input type="text" class="form-control" id="dateCreated" value="{{date('Y-m-d',strtotime($order->post_date))}}">
                      </div>
                      <div class="form-group">
                        <label for="sattus">Status</label>
                        <select name="status" id="status" class="form-control">
                          @if($order->post_status=='on-hold')
                          <option value="on-hold" selected>Pending</option>
                          <option value="Processing">Processing</option>
                          <option value="Dispatch">Dispatch</option>
                          <option value="Delivered">Delivered</option>
                          <option value="Cancelled">Cancelled</option>
                          <option value="Failed">Reject</option>
                          @elseif($order->post_status=='Processing')
                          <option value="on-hold">Pending</option>
                          <option value="Processing" selected>Processing</option>
                          <option value="Dispatch">Dispatch</option>
                          <option value="Delivered">Delivered</option>
                          <option value="Cancelled">Cancelled</option>
                          <option value="Failed">Reject</option>
                          @elseif($order->post_status=='Dispatch')
                          <option value="on-hold">Pending</option>
                          <option value="Processing">Processing</option>
                          <option value="Dispatch" selected>Dispatch</option>
                          <option value="Delivered">Delivered</option>
                          <option value="Cancelled">Cancelled</option>
                          <option value="Failed">Reject</option>
                          @elseif($order->post_status=='Delivered')
                          <option value="on-hold">Pending</option>
                          <option value="Processing">Processing</option>
                          <option value="Dispatch">Dispatch</option>
                          <option value="Delivered" selected>Delivered</option>
                          <option value="Cancelled">Cancelled</option>
                          <option value="Failed">Reject</option>
                          <option value="Dispatch">Dispatch</option>
                          @elseif($order->post_status=='Cancelled')
                          <option value="on-hold">Pending</option>
                          <option value="Processing">Processing</option>
                          <option value="Dispatch">Dispatch</option>
                          <option value="Delivered">Delivered</option>
                          <option value="Cancelled" selected>Cancelled</option>
                          <option value="Failed">Reject</option>
                          @else
                          <option value="on-hold">Pending</option>
                          <option value="Processing">Processing</option>
                          <option value="Dispatch">Dispatch</option>
                          <option value="Delivered">Delivered</option>
                          <option value="Cancelled">Cancelled</option>
                          <option value="Failed" selected>Reject</option>
                          @endif
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customer">Customer</label>
                        <select name="customer" id="customer" class="form-control">
                          <option value="1">@if(isset($user->name)){{$user->name}} @else Guest @endif</option>
                        </select>
                      </div>

                    </form>
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
                    $grand_total=0;
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
                      <td>{{$items->order_item_name}}</td>
                      <td>{{$subtotal}}</td>
                      <td>{{$qty}}</td>
                      <td>{{$total}}</td>
                    </tr>
                    @php $grand_total+=$total; $total_sub+=$subtotal; @endphp
                    @endforeach
                  </tbody>

                </table>

              </div>
              <div class="card-footer ">
                <div class="d-flex flex-column justify-content-end">
                  <div class="d-flex flex-row justify-content-end">
                    <div> item Sub total:</div>
                    <div> $ {{$total_sub}}</div>
                  </div>
                  <div class="d-flex flex-row justify-content-end">
                    <div> Order Total: </div>
                    <div> $ {{$grand_total}}</div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-3">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Order Action</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- <div class="card-body d-flex flex-row text-center" style="display: block;">
           <select name="" class="form-control" id="">
             <option value="">Choose an action</option>
             <option value="">Email</option>
             <option value="">Resend</option>
             <option value="">Regenarate</option>
           </select>

          </div> -->
              <div class="card-footer">
                <button type="submit" value="draft" name="dreft" class="btn text-danger">Move to trash</button>
                <button type="submit" value="submit" name="submit" class="btn btn-primary">Update</button>
              </div>
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