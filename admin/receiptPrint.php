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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    <style type="text/css">
    *{
     font-size: 16px;
     font-family: verdana;
    }
   
  td.description,
  th.description {
      width: 55px;
      max-width: 55px;
  }

  td.price,
  th.price {
      width: 40px;
      max-width: 40px;
      word-break: break-all;
  }

  td.amount,
  th.amount {
      width: 40px;
      max-width: 40px;
      word-break: break-all;
  }

    .logo{
     max-width: inherit;
     width: inherit;
    }
    td {
      border: none;
  }
  tr.spaceUnder>td {
    padding-bottom: 1em;
  }
 </style>
</head><body style="text-align:center">
<div class="receipt">
<p align="center"><strong><img class="logo" src="../assets/images/print-logo.jpg" height="100" width="150"></strong></p>
<p>'.$email_address.'</p>
<p>'.$contact_number.'</p>
<p> Receipt #: '.$random.'</p>
<p> Customer: '.$name.'</p>
<p>   '.$today.' </p>
<h3 style="text-align:center">RECEIPT</h3>
<table style="text-align:center;border-collapse: collapse;margin-left:auto;margin-right:auto;">
  <thead>
    <tr>
      <th class="description"><h4><b>Description</b></h4></th>
      <th class="price"><h4><b>Unit Price X Qty</b></h4></th>
      <th class="amount"><h4><b>Amount</b></h4></th>
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
      <td class="description" style="text-align:center">  '.$order[$i][1].' </td>
      <td class="price" style="text-align:center">  '.$order[$i][2].' X '.$order[$i][3].' </td>
      <td class="amount" style="text-align:center">  '.number_format($subtotal,2).' </td>
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
 <td>=============</td>
 <td>=============</td>
 <td>=============</td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Items Count:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.count($order).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Discount:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($total_discount,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Sub Total:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($subtotal,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>VAT(16%):</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($vat,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Total:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($total,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Paid ('.$mode.'):</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($paid,2).'</b></td>
 </tr>
 <tr class="spaceUnder">
 <td style="text-align:center"><b>Change:</b></td>
 <td style="text-align:center"></td>
 <td style="text-align:center"><b>'.number_format($change,2).'</b></td>
 </tr>
 </tbody>
</table>
<br>
<p>You were served by: '.$_SESSION["user"].'</p>
<p>Thank You!</p> 
</div>
</body></html>';

echo $pdf;
 }
 ?> 