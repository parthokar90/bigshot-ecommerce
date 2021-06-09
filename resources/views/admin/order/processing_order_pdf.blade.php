<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
        }
    </style>
</head>

<body>

    <h2>Processing Order</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="center">Oder Id</th>
                <th>Name</th>
                <th class="right">Address</th>
                <th class="right">Mobile</th>
                <th class="right">Amount</th>
            </tr>
        </thead>

        <tbody>
            @php $first_name=''; $last_name=''; $address=''; $phone=''; $subtotal=0; $total_amount=0; @endphp
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
                <td>{{$name}} {{$last_name}}</td>
                <td class="right">{{$address_one}}</td>
                <td class="right">{{$phone}}</td>
                <td class="right">{{$sub=$subtotal}}</td>
                <!-- <td class="right">hello</td> -->
            </tr>
            @php $total_amount+=$sub; @endphp
            @endforeach
        </tbody>
    </table>



</body>

</html>