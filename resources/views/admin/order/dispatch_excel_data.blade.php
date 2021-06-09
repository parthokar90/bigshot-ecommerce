<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dispatch Excel Report</title>
</head>
<body>

<div>
    <table>
        <tbody>
        <tr><td></td><td colspan="10" align="center"><h1>BiGshot Clothing</h1></td></tr>
        <tr><td></td><td colspan="10" align="center"><b>House 15/1, Road 4, Block A, Section 10, Mirpur, Dhaka.</b></td></tr>
        <tr><td></td><td colspan="10" align="center"><b>Mobile: 0000000000000</b></td></tr>
        </tbody>
    </table>

    <table style="width:100%;border: 1px solid black;border-collapse: collapse;">
        <tr>
          <th colspan="2" align="center">Order Id</th>
          <th colspan="2" align="center">Order Date</th>
          <th colspan="2" align="center">Name</th> 
          <th colspan="2" align="center">Mobile</th>
          <th colspan="2" align="center">Address</th>
          <th colspan="2" align="center">Amount</th>
        </tr>
        @php $order_tot_amount=0; $total_taka=0; $total_order_amount=0; $amount=0; @endphp
          @foreach($data as $row)
      @foreach($row->productMeta as $user_info) 
        @if($user_info->meta_key=='first_name') @php $name=$user_info->meta_value; @endphp @endif
        @if($user_info->meta_key=='last_name') @php $lname=$user_info->meta_value; @endphp @endif
        @if($user_info->meta_key=='phone') @php $mobile=$user_info->meta_value; @endphp @endif
        @if($user_info->meta_key=='address_one') @php $address=$user_info->meta_value; @endphp @endif
      @endforeach
        <tr>
          <td colspan="2" align="center">{{ $row->ID}}</td>
          <td colspan="2" align="center">{{date('d-m-Y',strtotime($row->post_date))}}</td>
          <td colspan="2" align="center">{{ $name}} {{ $lname}}</td>
          <td colspan="2" align="center">{{ $mobile}}</td>
          <td colspan="2" align="center">{{ $address}}</td>
          @php $tot=DB::table('order_itemmeta')->where('order_id',$row->ID)->where('meta_key','_line_subtotal')->sum('meta_value'); @endphp 
          @php $delivery=DB::table('order_itemmeta')->where('order_id',$row->ID)->where('meta_key','delivery_charge')->first(); @endphp @if(isset($delivery)) @php $charge=$delivery->meta_value; @endphp @else @php $charge=0; @endphp @endif
          @php $coupon=DB::table('order_itemmeta')->where('order_id',$row->ID)->where('meta_key','coupon_taka')->first(); @endphp @if(isset($coupon)) @php $c=$coupon->meta_value; @endphp @else @php $c=0; @endphp @endif
          <td colspan="2" align="center">{{$total_taka=$tot+$charge-$c}}  @php $total_order_amount+=$total_taka; @endphp</td>
        </tr>
         @endforeach

         <tfoot>
    <tr>
      <td colspan="2"></td>
      <td colspan="2"></td>
      <td colspan="2"></td>
      <td colspan="2"></td>
      <td colspan="2"></td>
      <td colspan="2">Total:{{$total_order_amount}}</td>
      <td></td>
    </tr>
  </tfoot>


      </table>

       

</body>
</html>
