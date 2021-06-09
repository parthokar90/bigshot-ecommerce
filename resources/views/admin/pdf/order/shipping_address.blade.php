
<!DOCTYPE html>
<html>
<head>
    <style>
        ul,li{
            list-style: none;
        }
    </style>
</head>
<body>
  <div id="invoice-POS" style="border: 1px solid #000000;width:100%;height:390px;">
        <h2 style="text-align:center">BiGshot Clothing</h2>
        <p style="text-align:center">House 15/1, Road 4, Block A, Section 10, Mirpur, Dhaka</p>
        <p style="text-align:center">Mobile: 0000000000000</p>
       <div style="width:50%;float:left">
        <h4 style="margin-left:20px;">Customer Address</h4>
        <ul>
            <li>Name:     {{$name->meta_value}}</li>
             <li>Address: {{$address->meta_value}}</li>
            <li>Phone: {{$phone->meta_value}}</li>
         </ul>

          <h4 style="margin-left:20px;">Shipping Address</h4>
          @if(isset($user_district))
          <ul>
             <li>District: {{$user_district->meta_value}}</li>
            <li>City:    {{$user_city->meta_value}}</li>
            <li>Zip:     {{$user_zip->meta_value}}</li>
         </ul>
              @endif 
       </div>
      <div style="width:50%;float:left">
         <ul>
             <li>Total Quantity: {{$total_qty}} pcs</li>
            <li>Total Due: {{number_format($total_due)}} tk</li>
         </ul>
        <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($order->ID, 'C39+',3,33,array(1,1,1)) . '" alt="barcode"   />'; ?>
      </div>
  </div>
</body>
</html>
