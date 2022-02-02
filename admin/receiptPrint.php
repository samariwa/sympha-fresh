<?php
 session_start();
 require('../config.php');
 require_once "../functions.php";
 $name = $_POST['customer'];
 $order = json_decode($_POST['order']);
 $random = generateRandomString();
 $today = date("l, F d, Y h:i A", time());
 $pdf = '';
 if ($time == '') {
    $pdf .= '<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    <style type="text/css">
    td {
      border: none;
  }
  tr.spaceUnder>td {
    padding-bottom: 1em;
  }
 </style>
</head><body style="text-align:center">
<p align="center"><strong><img src="../assets/images/print-logo.jpg" height="100" width="150"></strong></p>
<?php
?>
<?php
?>
<p> Receipt #: '.$random.'</p>
<p> Customer: '.$name.'</p>
<p>   '.$today.' </p>
<div class="row">
<div class="col-md-12">
<h3 style="text-align:center">RECEIPT</h3>
<table style="text-align:center;border-collapse: collapse;margin-left:auto;margin-right:auto;">
  <thead>
    <tr>
      <th scope="col" width="25%""><h4><b>Qty</b></h4></th>
      <th scope="col" width="25%""><h4><b>Description</b></h4></th>
      <th scope="col" width="25%""><h4><b>Unit Price</b></h4></th>
      
      <th scope="col" width="25%""><h4><b>Amount</b></h4></th>
    </tr>
  </thead>
  <tbody >';
        $total = 0;
        $total_discount = 0;
        for ($i = 0; $i < count($order); $i++) {
         $subtotal = $order[$i][2] * $order[$i][3];
         $total += $subtotal;
         $total_discount += $order[$i][4] * $order[$i][3];
   $pdf .= '<tr height="40px">
      <td scope="row" style="text-align:center">  '.$order[$i][3].' </td>
      <td style="text-align:center">  '.$order[$i][1].' </td>
      <td style="text-align:center">  '.$order[$i][2].' </td>
      <td style="text-align:center">  '.number_format($subtotal,2).' </td>
    </tr>';
    }
    $paid = $_POST['paid'];
    $total -= $total_discount;
    $change = $paid - $total;
    $mode = '';
    if($_POST['mode'] == 0)
    {
      $mode = 'Cash';
    }
    else{
      $mode = 'M-Pesa';
    }
    $vat = 0.16 * $total;
    $subtotal = $total - $vat;
 $pdf .=  '
 <tr class="spaceUnder">
 <td>================</td>
 <td>================</td>
 <td>================</td>
 <td>================</td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Items Count:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.count($order).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Discount:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($total_discount,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Sub Total:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($subtotal,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>VAT(16%):</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($vat,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Total:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($total,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Paid ('.$mode.'):</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($paid,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Change:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($change,2).'</b></td>
 </tr>
 </tbody>
</table>
</div>
</div>
<br>
<p>You were served by: '.$_SESSION["user"].'</p>
<p>Thank You!</p> 
</body></html>';

echo $pdf;
 }

 ?> 