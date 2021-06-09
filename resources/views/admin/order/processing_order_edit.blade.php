@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            @include('admin.includes.messages')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Processing Order Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Processing Order Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container">

            <div class="card">

                <div class="card-body">


                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">Oder Id</th>
                                    <th>Name</th>
                                    <th class="right">Address</th>
                                    <th class="right">Mobile</th>
                                    <th class="right">Amount</th>
                                    <!-- <th class="right">Comments</th> -->
                                    <th class="right">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $name=''; $last_name=''; $address=''; $phone=''; $subtotal=0; $total_amount=0; @endphp
                                @foreach($order as $orders)
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
                                @endforeach
                                <tr>
                                    <td class="center">{{$orders->ID}} Date:{{date('d-m-Y',strtotime($orders->post_date))}}</td>
                                    <form method="post" action="{{route('process.order.update')}}">
                                        @csrf
                                        <td><input type="text" name="first_name" value="{{$name}}">
                                            <input type="text" name="last_name" value="{{$last_name}}"></td>
                                        <td class="right"><textarea class="form-control" name="address" cols="5" rows="5">{{$address_one}}</textarea> </td>
                                        <td class="right">{{$phone}}</td>
                                        <td class="right">{{$sub=$subtotal}}</td>
                                        <input type="hidden" name="order_id" value="{{$orders->ID}}">
                                        <td class="right">
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </td>
                                    </form>
                                    <!-- <td class="right">hello</td> -->
                                </tr>
                                @php $total_amount+=$sub; @endphp
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
    </section>
    <!-- /.row -->
</div><!-- /.container-fluid -->

<!-- /.content -->
<!--  </div> -->
@endsection

@section('js')

@endsection