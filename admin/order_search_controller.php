<?php
require('../config.php');
require_once '../core/init.php';
$Sales = new Sales();
$value = $_POST['value'];
$frame = $_POST['frame'];
$duration = '';
$time = array("3days", "1week", "2weeks", "1month", "2months", "alltime");
$limit = array(">= DATE_SUB( CURDATE(), INTERVAL 3 DAY)",
               ">= DATE_SUB( CURDATE(), INTERVAL 1 WEEK)", 
               ">= DATE_SUB( CURDATE(), INTERVAL 2 WEEK)", 
               ">= DATE_SUB( CURDATE(), INTERVAL 1 MONTH)", 
               ">= DATE_SUB( CURDATE(), INTERVAL 2 MONTH)", 
               "<= CURDATE()");
for ($i = 0; $i <= 6; $i++) {
    if($_POST['frame'] == $time[$i])
    {
        $duration = $limit[$i];
    }
}
$statement = "SELECT orders.id AS id, orders.Order_id AS order_id,customers.Name AS Name,orders.Customer_type as type,orders.Walk_in_name as new_name, Number,stock.Name AS name, orders.Quantity AS Quantity,orders.Discount as Discount,Debt,MPesa,Cash,Fine,Balance,Delivery_time,Returned,Banked,Slip_Number,Invoice_Number,Banked_By,orders.Created_at as created_at FROM orders INNER JOIN customers ON orders.Customer_id=customers.id INNER JOIN stock ON orders.Stock_id=stock.id  WHERE ";
$nums = str_replace("-", "", $value);
$nums2 = str_replace("/", "", $nums);
if(is_numeric($nums2)){
    $date = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
    $statement .= "DATE(Delivery_time) = '$date' AND DATE(Delivery_time) $duration ORDER BY orders.id ASC;";
} 
elseif (empty($value)){
  $statement .= "DATE(Delivery_time) = CURRENT_DATE() AND DATE(Delivery_time) $duration ORDER BY orders.id ASC;";
}
else{
    $statement .= "customers.Name LIKE '%$value%' AND DATE(Delivery_time) $duration ORDER BY orders.id ASC;";
}

$searchQuery = mysqli_query($connection, $statement)or die($connection->error);
$searchCount = mysqli_num_rows($searchQuery);
if (($searchCount > 0) || (empty($value)))
{
$table = '
<div id="menu" class="tab-pane fade main show active">
<div class="row">
<div class="col-12">
<h6 class="offset-5">Total Number: '.$searchCount.'</h6>
</div>
</div> 
<table id="OrderSearch" class="table table-striped table-hover table-responsive" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
<caption>Filtered Orders</caption>
<thead class="thead-dark">
<tr>
<th scope="col" width="3%">#</th>
<th scope="col"width="15%">Date</th>
<th scope="col" width="15%">Name</th>
<th scope="col" width="19%">Product</th>
<th scope="col"width="3%">Quantity</th>
<th scope="col"width="4%">Cost</th>
<th scope="col"width="4%">Balance</th>
<th scope="col"width="20%"></th>
<th scope="col"width="40%"></th>
</tr>
</thead>
<tbody >';

$count = 0;
foreach($searchQuery as $salesToday){
$count++;
$name = $salesToday['Name'];
if($name == 'Unregistered Customer')
{
$name = $salesToday['new_name'];
}
$cost = $salesToday['Quantity'] * ($Sales->fetchSellingPrice($salesToday['name']) - $salesToday['Discount']);
$balance = ($salesToday['MPesa'] + $salesToday['Cash']) + $salesToday['Debt'] - $salesToday['Quantity'] * $cost + $salesToday['Fine'];
if(($balance > 0 && $balance < 1) || ($balance > -1 && $balance < 0))
{
$balance = 0;
}

$table .= '<tr>
<th scope="row" class="uneditable" id="idToday'.$count.'">'.$salesToday['order_id'].'</th>
<td class="uneditable" id="priceToday'.$salesToday['id'].'">'.date("d/m/Y", strtotime($salesToday['Delivery_time'])).'</td>
<td style = "background-color: '.$Sales->getCustomerBalanceColor($balance).';color: white"class="uneditable" id="nameToday'.$count.'">'.$name.'</td>
<td class="uneditable" id="productToday'.$count.'">'.$salesToday['name'].'</td>
<td ';
 if( $view == 'Software' ){ $table .='class="editable"';  }else{ $table .=' class="uneditable"';  } $table .=' id="qtyToday'.$count.'">'.round($salesToday['Quantity'],2).'</td>
<td class="uneditable" id="costToday'.$salesToday['id'].'">'.round($cost,2).'</td>
<td class="uneditable" id="balanceToday'.$salesToday['id'].'">'.round($balance,2).'</td>
<td>
<button id="'.$salesToday['id'].'" data_id="'.$salesToday['id'].'" data-toggle="modal" data-target="#viewOrderToday'.$salesToday['id'].'" role="dialog" class="btn btn-warning btn-sm active viewOrderToday" role="button" aria-hidden="true" ><i class="fa fa-eye"></i> View Details</button>
<div class="modal fade bd-example-modal-lg" id="viewOrderToday'.$salesToday['id'].'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">'.$name.' - #ORD'.$salesToday['order_id'].' - '.$salesToday['type'].' customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST">
          <div class="row">
            <div class="col-6">
          Customer Tel: '.$salesToday['Number'].'
           </div>
           <div class="col-6">
          Time: '.date('H:i',strtotime($salesToday['created_at'])).'
           </div>
          </div>
          <div class="row">
                <p class="ml-4"><b><i>Order Details</i></b></p>
            </div>
            <div class="row">
              <div class="col-4">
                  <p>Product: <span id="name_Today'.$salesToday['id'].'">'.$salesToday['name'].'</span></p>
              </div>
              <div class="col-4">
                  <label for="qtyToday">Quantity: </label>
                  <input type="number" name="qtyToday" id="qty_Today'.$salesToday['id'].'" class="form-control" style="padding:15px;" placeholder="Product Quantity..." value="'.round($salesToday['Quantity'],2).'" required>
              </div>
              <div class="col-4">
                  <label for="qtyToday">Returned: </label>
                  <input type="number" name="returnedToday" id="returned_Today'.$salesToday['id'].'" class="form-control" style="padding:15px;" placeholder="Returned Quantity..." value="'.round($salesToday['Returned'],2).'" required>
              </div>
            </div>
            <br>
            <div class="row">
                <p class="ml-4"><b><i>Order Cost</i></b></p>
            </div>
            <div class="row">
              <div class="col-3">
                  <p>Unit Price: Ksh. '.round($Sales->fetchSellingPrice($salesToday['name']) ,2).'</p>
              </div>
              <div class="col-3">
              <label for="qtyToday">Discount/Unit (Ksh.): </label>
                 <input type="number" name="discountToday" id="discount_Today'.$salesToday['id'].'" class="form-control" style="padding:15px;" placeholder="Discount given per Unit..." value="'.round($salesToday['Discount'],2).'" required>
              </div>
              <div class="col-3">
                  <p>Fine: '.round($salesToday['Fine'],2).'</p>
              </div>
              <div class="col-3">
                  <p>Net Cost: Ksh. '.round($cost,2).'</p>
              </div>
            </div>
            <br>
            <div class="row">
                <p class="ml-4"><b><i>Order Payments</i></b></p>
            </div>
            <div class="row">
              <div class="col-4">
                  <p>C/F/Debt: Ksh. '.round($salesToday['Debt'],2).'</p>
              </div>
              <div class="col-2">
              <label for="mpesaToday">MPesa (Ksh.): </label>
                 <input type="number" name="mpesaToday" id="mpesa_Today'.$salesToday['id'].'" class="form-control" style="padding:15px;" placeholder="Amount paid in MPesa..." value="'.round($salesToday['MPesa'],2).'" required>
              </div>
              <div class="col-2">
              <label for="cashToday">Cash (Ksh.): </label>
                 <input type="number" name="cashToday" id="cash_Today'.$salesToday['id'].'" class="form-control" style="padding:15px;" placeholder="Amount paid in Cash..." value="'.round($salesToday['Cash'],2).'" required>
              </div>
              <div class="col-4">
                  <p>New Balance: Ksh. '.round($balance,2).'</p>
              </div>
            </div>
            <br>
            <div class="row">
            <label for="dateToday" class="ml-5">Order Expected On: </label>
            <div class="col-10">
                <input type="date" name="dateToday" id="date_Today'.$salesToday['id'].'" class="form-control offset-1" style="padding:15px;" placeholder="Date Expected..." value="'.$salesToday['Delivery_time'].'" required>
           </div>
            </div>
            <br>
            <div class="row">
                <p class="ml-4"><b><i>Invoice Details</i></b></p>
            </div>
            <div class="row">
              <div class="col-10">
              <label for="invoiceToday" class="ml-5">Invoice #: </label>
                <input type="text" name="invoiceToday" id="invoice_Today'.$salesToday['id'].'" class="form-control offset-1" style="padding:15px;" placeholder="Invoice Number..." value="'.$salesToday['Invoice_Number'].'" required>
              </div>
            </div>  
            <br>
            <div class="row">
                <p class="ml-4"><b><i>Banking Details</i></b></p>
            </div>
            <div class="row">
            <div class="col-4">
            <label for="cashToday">Amount Banked (Ksh.): </label>
                <input type="number" name="bankedToday" id="banked_Today'.$salesToday['id'].'" class="form-control" style="padding:15px;" placeholder="Amount banked..." value="'.round($salesToday['Banked'],2).'" required>
              </div>
              <div class="col-4">
              <label for="cashToday">Bank Slip #: </label>
                <input type="text" name="slipToday" id="slip_Today'.$salesToday['id'].'" class="form-control" style="padding:15px;" placeholder="Bank Slip Number..." value="'.$salesToday['Slip_Number'].'" required>
              </div>
              <div class="col-4">
              <label for="cashToday">Banked By: </label>
                <input type="text" name="bankedByToday" id="banked_By_Today'.$salesToday['id'].'" class="form-control" style="padding:15px;" placeholder="Banked By Who?" value="'.$salesToday['Banked_By'].'" required>
              </div>
            </div>  
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" style="margin-right: 50px" onclick="saveOrderToday('.$salesToday['id'].')" id="'.$salesToday['id'].'">Save Changes</button>
        </form>
        </div>
    </div>
  </div>
</div>
</td>
<td>
<div class="dropdown">
  <a class="btn btn-sm btn-light" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
  <img src="bars-icon.svg" alt="icon">&ensp;Options
  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <li><a class="dropdown-item" href="tel:'.$salesToday['Number'].'"><i class="fa fa-phone"></i>&ensp;Call Customer</a></li>
    <li><a class="dropdown-item" href="#" onclick="setAsDelivery('.$salesToday['order_id'].'); return false;">Set as delivery</a></li>
    <li><a class="dropdown-item" href="#" onclick="sendMpesaNotification('.$salesToday['order_id'].', '.$salesToday['Number'].'); return false;" ><i class="fa fa-mobile"></i>&ensp;Push M-Pesa STK Notification</a></li>';

    if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {

    $table .= '<li><a class="dropdown-item" href="#" onclick="fineCustomerToday('.$salesToday['id'].'); return false;"><i class="fa fa-money-bill"></i>&ensp;Fine</a></li>
    <li><a class="dropdown-item" href="#" onclick="deleteOrderToday(this,'.$salesToday['id'].'); return false;"><i class="fa fa-arrow-left"></i>&ensp;Return</a></li>';

    }

    $table .= '<li><a class="dropdown-item" href="#" onclick="cancelOrderToday(this,'.$salesToday['id'].'); return false;"><i class="fa fa-times"></i>&ensp;Cancel</a></li>
  </ul>
</div>
</td>

</tr>';

}
$table .= '</tbody>
</table>
</div>


<ul class="nav nav-tabs">
<li class="active"><a data-toggle="tab" class="nav-link salesTab active" href="#menu" style="color: inherit;">Filtered Orders</a></li>
</ul>';
}
else
{
  $table = '<h4 style="display: flex;align-items: center;justify-content: center;top: 50%;left: 50%;margin-bottom:180px;margin-top:180px;">Order not found</h4>';
}
echo $table;



  

  
