<!DOCTYPE html>
<html>

<head>
   
    <style>
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 140mm;
            background: #FFF;
            min-height: 600px;
            border: 2px solid #000000;
        }
        table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}


    </style>
</head>

<body>

    <div id="invoice-POS">
        <div class="info">
            <h4>Oder placed: 01-06-2020</h4>
            <h4>Order Number: 0000000</h4>
        </div>
           
        <div style="width: 100%;">
                <h4>Ship To: </h4>
                <p> Riaz Howlader<br>
                    House 15, Sector –10</br>
                    Road –4, Uttara-Dhaka.</br>
                    Phone : 017167474747</br>
                </p>  
        </div>
      
       <div style="width: 100%; float: left;">
           <h4>Payment Method: Cash</h4>
           <table>
              <tr>
                <th colspan="4" style="background-color: #dddddd;">Items in Order</th>
                
              </tr>
              <tr>
                <td>Picture</td>
                <td>long tunic</td>
                <td>2 pcs</td>
                <td>2000 Tk</td>
              </tr>
              <tr>
                <td>Picture</td>
                <td>long tunic</td>
                <td>2 pcs</td>
                <td>1000 Tk</td>
              </tr>
              <tr style="background-color: #dddddd;">
                <td colspan="2">Sub Total</td>
                
                <td >2 pcs</td>
                <td>3000 Tk</td>
              </tr>
              <tr>
                <td colspan="3">Delivery Charge</td>
                
                <td>120 Tk</td>
              </tr>
              <tr style="background-color: #dddddd;">
                <td colspan="3">Order Total</td>
                
                <td>3120 Tk</td>
              </tr>


            </table>
       </div>

    </div>

</body>

</html>