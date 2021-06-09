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
            <div class="row">
                <input type="hidden" name="id" value="">
                <div class="col-md-9">
                    <div class="card card-default">
                        <div class="card-header">

                            <h3 class="card-title" style="width: 100%">Order #{{$order->ID}} details </h3>



                        </div>
                        <div class="card-body d-flex justify-content-between flex-row " style="display: block;">
                            <div class="genarel">
                                <div class="font-weight-bold text-center">Genarel</div>
                                <div class="mt-3">

                                    <div class="form-group">
                                        <label for="dateCreated">Date created:</label>
                                        {{date('d-m-Y',strtotime($order->post_date))}}

                                    </div>
                                    <div class="form-group">
                                        <label for=""> Status:</label>
                                        {{$order->post_status}}
                                    </div>

                                </div>
                            </div>
                            @php $name=''; $phone=''; @endphp
                            @foreach($order->productMeta as $meta)
                            @if($meta->meta_key=='first_name') @php $name=$meta->meta_value; @endphp @endif
                            @if($meta->meta_key=='phone') @php $phone=$meta->meta_value; @endphp @endif
                            @endforeach
                            <div>
                                <div class="font-weight-bold">Customer</div>
                                <div class="mt-3">
                                    {{$name}}
                                </div>


                                <div class="font-weight-bold mt-2">Phone</div>
                                <div>{{$phone}}</div>
                            </div>


                        </div>
                    </div>
                    <form action="{{route('dispatch.order.cancel.type')}}" method="POST">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title" style="width: 100%">Item Info</h3>
                            </div>
                            <div class="card-body d-flex justify-content-between flex-row " style="display: block;">
                                <form method="post" action="">
                                    <table class="table table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Order Id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Mobile</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $first_name=''; $last_name=''; $address=''; $phone=''; $subtotal=0; $total_amount=0; @endphp
                                            @foreach($orders_data as $key=>$orders)
                                            @foreach($orders->productMeta as $meta)
                                            @if($meta->meta_key=='first_name') @php $name=$meta->meta_value; @endphp @endif
                                            @if($meta->meta_key=='last_name') @php $last_name=$meta->meta_value; @endphp @endif
                                            @if($meta->meta_key=='address_one') @php $address_one=$meta->meta_value; @endphp @endif
                                            @if($meta->meta_key=='phone') @php $phone=$meta->meta_value; @endphp @endif
                                            @endforeach
                                            @foreach($orders->orderItem as $info)
                                            @foreach($info->orderMeta as $value)
                                            @if($value->meta_key=='_line_subtotal')
                                            @php $subtotal=$value->meta_value; @endphp
                                            @endif
                                            @endforeach
                                            <tr>
                                                <th scope="row"><input type="checkbox" id="" name="partial_cancel" value=""></th>
                                                <td>{{$orders->ID}} Date:{{date('d-m-Y',strtotime($orders->post_date))}} {{$info->order_item_id}}</td>
                                                <td>{{$name}} {{$last_name}}</td>
                                                <td class="right">{{$address_one}}</td>
                                                <td class="right">{{$phone}}</td>
                                                <td class="right">{{$sub=$subtotal}}</td>
                                            </tr>
                                            <input type="hidden" name="order_id" value="{{$orders->ID}}">
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>

                            </div>
                            <!-- <div class="card-footer ">
                                <div class="d-flex flex-column justify-content-end">
                                    <div class="d-flex flex-row justify-content-end">
                                        <div> item Sub total:</div>
                                        <div> 4354</div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                        <div> Order Total: </div>
                                        <div> 43543</div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="col-md-12 text-center">
                                <button type="submit" name="full_order" value="full" name="submit" class="btn btn-primary">Full Order Cancel</button>
                                <button type="submit" name="partial_order" value="partial" name="submit" class="btn btn-primary">Partial Order Cancel</button>
                    </form>
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