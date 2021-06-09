
<!DOCTYPE html>
<html>
<head>
  <title>Product Sku</title>
  <style>
@media print {
  body {
    margin: 0;
     page-break-inside: avoid;
  }
}
  .col{
    width:20%;
    border: 1px solid #000000;
    float: left;
 overflow: auto;
    margin-left: 2px;
  }
  h3{
    text-align: center;
  }
  .bar_code{
      text-align: center;
      padding: 10px 0;;
  }
  li{
    list-style: none;
    font-size: 14px;
  }
.page-break {
    page-break-after: always;
}
  </style>
</head>
<body>
<?php $i=0; ?>
    @if($allAttribute->count()>0)
     @foreach($allAttribute as $item_product)
         @php $att_name=DB::table('product_attibutes')
         ->where('product_parent',$item_product->post_id)
         ->where('post_id',$id)
         ->get(); 
          @endphp
          <div class="col">
             <h3>Bigshot</h3>
             <ul>
              <li>Price: {{number_format($price->meta_value)}} tk </li>
              <li>
               {{$cate_name->name}}-{{$name->post_title}}
               @foreach($att_name as $att)
                {{ucfirst($att->term)}} <br>
               @endforeach
              </li>
              <li>
              SKU-{{$sku->meta_value}}
              </li>
             </ul>
            <br>  
            <div class="bar_code">
                <?php echo '<img width="120px"  src="data:image/png;base64,'.DNS1D::getBarcodePNG($id, 'C39+',3,33,array(1,1,1)) . '" alt="barcode"   />'; ?>
            </div>
          </div>
          <?php $i++; ?>
              <?php
                    if( $i % 5 == 0 ){ 
                  echo '<div class="page-break"></div>'; 
              }
          ?>  
      @endforeach 
        @else 
        
          <div class="col">
             <h3>Bigshot</h3>
             <ul>
              <li>Price: {{number_format($price->meta_value)}} tk </li>
              <li>
               {{$cate_name->name}}-{{$name->post_title}}
              </li>
              <li>
              SKU-{{$sku->meta_value}}
              </li>
             </ul>
            <br>  
            <div class="bar_code">
                <?php echo '<img width="120px"  src="data:image/png;base64,'.DNS1D::getBarcodePNG($id, 'C39+',3,33,array(1,1,1)) . '" alt="barcode"   />'; ?>
            </div>
          </div>
      @endif 
</body>
</html>
