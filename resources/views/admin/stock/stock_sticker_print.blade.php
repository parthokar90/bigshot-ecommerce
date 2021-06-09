<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sku Sticker</title>
</head>
<body>
    <style>
        li{
            list-style: none;
            margin-left: 8px;
        }
    </style>
        @php $price=0; $sku=0; $color=''; @endphp
        @foreach($product as $info)
        @if($info->meta_key=='sale_price') @php $price=$info->meta_value; @endphp @endif
        @if($info->meta_key=='_sku') @php $sku=$info->meta_value; @endphp @endif
        @endforeach
        <div style="border:1px solid #000000;text-align:left;width:300px">
            <h3 style="text-align: center;">BIG SHOT</h3>
            <li>{{$pro_name->post_title}}</li>
            <li> Price: {{number_format($price)}} tk</li>
              <li>Category: {{$category->cat_name}}<li> 

              </br>
              </br>
                @foreach($taxo as $attribute)
                 {{$attribute}}
                @endforeach
                <li>SKU-{{$sku}}</li><br> <br><br>
                <div style="margin-top:5px;margin-left:5px">
                 <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($id, 'C39+', 3, 33, array(1, 1, 1)) . '" alt="barcode"   />'; ?>
                </div> 
                <br> <br><br>
        </div>
    
    
</body>
</html>