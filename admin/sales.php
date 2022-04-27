<?php
 include "admin_nav.php";
 include('../queries.php');
 ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
             <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales</span></h1>
                        <h6 class="text-gray-600" style="margin-left: 530px;">Time: <span id="time"></span></h6>
            <button class="btn btn-light btn-md active printSales mr-3" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
          </div>
          <?php
       }
       else{
        ?>
         <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
        <?php
         }
         include "dashboard_tabs.php";
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO' || $view == 'Stores Manager') {
        ?>
      <div class="row">
        <div class="col-2">
      <a href="addOrder.php" class="btn btn-success btn-md active" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;New Order</a>
      </div>
      <div class="col-2">
      <a href="customer_debts.php" class="btn btn-warning btn-md active" role="button" aria-pressed="true">Customer Debts</a>
      <!--<a href="distribution.php" class="btn btn-warning btn-md active" role="button" aria-pressed="true">Distribution</a>-->
    </div>
    <div class="col-2">
      <a href="processOrders.php" class="btn btn-light btn-md active" role="button" aria-pressed="true" >Process Orders</a>
    </div>
    <div class="col-2">
      <a href="receipt.php" class="btn btn-secondary btn-md active" role="button" aria-pressed="true" >Print Recipt</a>
    </div>
    <div class="col-2">
      <a href="gatePass.php" class="btn btn-dark btn-md active" role="button" aria-pressed="true" >Gate Pass</a>
    </div>
    <div class="col-2">
      <a href="returned.php" class="btn btn-info btn-md active" role="button" aria-pressed="true">Returned Goods</a>
    </div>
    </div><br>
     <?php
        }
        else{
        ?>
        <div class="row">
          <div class="col-4">
      <a href="addOrder.php" class="btn btn-success btn-md active ml-3" role="button" aria-pressed="true" ><i class="fa fa-plus-circle"></i>&ensp;New Order</a>
    </div>
      <div class="col-4">
      <a href="customer_debts.php" class="btn btn-warning btn-md active" role="button" aria-pressed="true">Customer Debts</a>
      <!--<a href="extra_sales.php" class="btn btn-primary btn-md active offset-3" role="button" aria-pressed="true" >Extra Sales</a>-->
    </div>
    <div class="col-4">
      <a href="returned.php" class="btn btn-info btn-md active offset-6" role="button" aria-pressed="true">Returned Goods</a>
    </div>
    </div><br>
        <?php
        }
        ?>
          <div class="tab-content">
          <?php
          $name_color = '';
          ?>
          <!--
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////
            <div id="menu1" class="tab-pane fade">
        <?php
       /* $ordersrowcount = mysqli_num_rows($salesListLastMonth);
      ?>
      <div class="row">
         <div class="col-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableLastMonth" class="table table-striped table-hover table-responsive  paginate" style="overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made This Month</caption>
  <thead class="thead-dark">
    <tr>
    <th scope="col" width="3%">#</th>
    <th scope="col"width="10%"></th>
      <th scope="col" width="20%">Name</th>
      <th scope="col"width="10%"></th>
      <th scope="col" width="25%">Product</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Quantity</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Unit Price</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Cost</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="20%"></th>
      <th scope="col"width="10%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($salesListLastMonth as $row){
         $count++;
         $id = $row['id'];
         $order_id = $row['order_id'];
         $name = $row['Name'];
         if($name == 'Unregistered Customer')
         {
           $name = $row['new_name'];
         }
         $cust_type = $row['type'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        $discount = $row['Discount'];
        //MariaDB Only
        //$selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        $selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $fine = $row['Fine'];
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        if(($balance > 0 && $balance < 1) || ($balance > -1 && $balance < 0))
        {
          $balance = 0;
        }
        $delivery_date = $row['Delivery_time'];
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $invoice = $row['Invoice_Number'];
        $banked_by = $row['Banked_By'];
        if ($balance == "0.0" ) {
          $name_color = "#2ECC71";
        }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
          $name_color = "grey";
        }
        if ($balance > "0.0" ) {
          $name_color = "orange";
        }
        if ($balance < "-100.0" ) {
          $name_color = "red";
        }
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idLastMonth<?php echo $count; ?>"><?php echo $order_id; ?></th>
      <td class="uneditable" ></td>
      <td style = "background-color: <?php echo $name_color; ?>;color: white"class="uneditable" id="nameLastMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="productLastMonth<?php echo $count; ?>"><?php echo $product; ?></td>
      <td class="uneditable" ></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyLastMonth<?php echo $count; ?>"><?php echo round($qty,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="priceLastMonth<?php echo $id; ?>"><?php echo round($price,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="costLastMonth<?php echo $id; ?>"><?php echo round($cost,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="balanceLastMonth<?php echo $id; ?>"><?php echo round($balance,2); ?></td>
       <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active fineCustomerLastMonth" onclick="fineCustomerLastMonth(<?php echo $id; ?>)"role="button" aria-pressed="true" >Fine</button>
       </td>
        <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" data-toggle="modal" data-target="#viewOrderLastMonth<?php echo $id; ?>" role="dialog" class="btn btn-warning btn-sm active viewOrderLastMonth" role="button" aria-hidden="true" ><i class="fa fa-eye"></i> View Details</button>
          <div class="modal fade bd-example-modal-lg" id="viewOrderLastMonth<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $name; ?> - #ORD<?php echo $order_id; ?> - <?php echo $cust_type; ?> customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                    Customer Tel: <?php echo $contact; ?>
                    <div class="row">
                          <p class="ml-4"><b><i>Order Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>Product: <span id="name_LastMonth<?php echo $id; ?>"><?php echo $product; ?></span></p>
                        </div>
                        <div class="col-4">
                            <label for="qtyLastMonth">Quantity: </label>
                            <input type="number" name="qtyLastMonth" id="qty_LastMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Product Quantity..." value="<?php echo round($qty,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="qtyLastMonth">Returned: </label>
                            <input type="number" name="returnedLastMonth" id="returned_LastMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Returned Quantity..." value="<?php echo round($returned,2); ?>" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Cost</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-3">
                            <p>Unit Price: Ksh. <?php echo round($price,2); ?></p>
                        </div>
                        <div class="col-3">
                        <label for="qtyLastMonth">Discount/Unit (Ksh.): </label>
                           <input type="number" name="discountLastMonth" id="discount_LastMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Discount given per Unit..." value="<?php echo round($discount,2); ?>" required>
                        </div>
                        <div class="col-3">
                            <p>Fine: <?php echo round($fine,2); ?></p>
                        </div>
                        <div class="col-3">
                            <p>Net Cost: Ksh. <?php echo round($cost,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Payments</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>C/F/Debt: Ksh. <?php echo round($debt,2); ?></p>
                        </div>
                        <div class="col-2">
                        <label for="mpesaLastMonth">MPesa (Ksh.): </label>
                           <input type="number" name="mpesaLastMonth" id="mpesa_LastMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in MPesa..." value="<?php echo round($mpesa,2); ?>" required>
                        </div>
                        <div class="col-2">
                        <label for="cashLastMonth">Cash (Ksh.): </label>
                           <input type="number" name="cashLastMonth" id="cash_LastMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in Cash..." value="<?php echo round($cash,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <p>New Balance: Ksh. <?php echo round($balance,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      <label for="dateLastMonth" class="ml-5">Order Expected On: </label>
                      <div class="col-10">
                          <input type="date" name="dateLastMonth" id="date_LastMonth<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Date Expected..." value="<?php echo $delivery_date; ?>" required>
                     </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Invoice Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-10">
                        <label for="invoiceLastMonth" class="ml-5">Invoice #: </label>
                          <input type="text" name="invoiceLastMonth" id="invoice_LastMonth<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Invoice Number..." value="<?php echo $invoice; ?>" required>
                        </div>
                      </div>  
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Banking Details</i></b></p>
                      </div>
                      <div class="row">
                      <div class="col-4">
                      <label for="cashLastMonth">Amount Banked (Ksh.): </label>
                          <input type="number" name="bankedLastMonth" id="banked_LastMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount banked..." value="<?php echo round($banked,2); ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashLastMonth">Bank Slip #: </label>
                          <input type="text" name="slipLastMonth" id="slip_LastMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Bank Slip Number..." value="<?php echo $slip; ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashLastMonth">Banked By: </label>
                          <input type="text" name="bankedByLastMonth" id="banked_By_LastMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Banked By Who?" value="<?php echo $banked_by; ?>" required>
                        </div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="margin-right: 50px" onclick="saveOrderLastMonth(<?php echo $id; ?>)" id="<?php echo $id; ?>">Save Changes</button>
                  </form>
                  </div>
              </div>
            </div>
          </div>
      </td>
           <td>
           <?php
              if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {
           ?>
              <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-secondary btn-sm active deleteOrderLastMonth" role="button" aria-pressed="true" onclick="deleteOrderLastMonth(this,<?php echo $id; ?>)">Return</button>
          <?php
              }
          ?>  
        </td>
          
    </tr>
    <?php
    }*/
    ?>
  </tbody>
</table>
    </div>
    href="../mpesa_processor.php?phone=<?php #echo $contact; ?>&amount=<?php #echo $cost; ?>"
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
  -->
    <div id="menu2" class="tab-pane fade">
        <?php
        $ordersrowcount = mysqli_num_rows($salesListYesterday);
      ?>
      <div class="row">
         <div class="col-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableYesterday" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made Yesterday</caption>
  <thead class="thead-dark">
    <tr>
    <th scope="col" width="5%">#</th>
    <th scope="col"width="10%"></th>
      <th scope="col" width="15%">Name</th>
      <th scope="col"width="10%"></th>
      <th scope="col" width="25%">Product</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Quantity</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Unit Price</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Cost</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="20%"></th>
      <th scope="col"width="10%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($salesListYesterday as $row){
         $count++;
         $id = $row['id'];
         $order_id = $row['order_id'];
         $name = $row['Name'];
         if($name == 'Unregistered Customer')
         {
           $name = $row['new_name'];
         }
         $cust_type = $row['type'];
        $contact = $row['Number'];
        $product = $row['name'];
        //MariaDB Only
        //$selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        $selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $qty = $row['Quantity'];
        $discount = $row['Discount'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $fine = $row['Fine'];
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        if(($balance > 0 && $balance < 1) || ($balance > -1 && $balance < 0))
        {
          $balance = 0;
        }
        $delivery_date = $row['Delivery_time'];
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $invoice = $row['Invoice_Number'];
        $banked_by = $row['Banked_By'];
        if ($balance == "0.0" ) {
          $name_color = "#2ECC71";
        }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
          $name_color = "grey";
        }
        if ($balance > "0.0" ) {
          $name_color = "orange";
        }
        if ($balance < "-100.0" ) {
          $name_color = "red";
        }
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idYesterday<?php echo $count; ?>"><?php echo $order_id; ?></th>
      <td class="uneditable" ></td>
      <td style = "background-color: <?php echo $name_color; ?>;color: white"class="uneditable" id="nameYesterdayMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="productYesterday<?php echo $count; ?>"><?php echo $product; ?></td>
      <td class="uneditable" ></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyYesterday<?php echo $count; ?>"><?php echo round($qty,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="priceYesterday<?php echo $id; ?>"><?php echo round($price,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="costYesterday<?php echo $id; ?>"><?php echo round($cost,2); ?></td> 
      <td class="uneditable" ></td>
      <td class="uneditable" id="balanceYesterday<?php echo $id; ?>"><?php echo round($balance,2); ?></td>
       <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active fineCustomerYesterday" onclick="fineCustomerYesterday(<?php echo $id; ?>)"role="button" aria-pressed="true" >Fine</button>
      </td>
      <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" data-toggle="modal" data-target="#viewOrderYesterday<?php echo $id; ?>" role="dialog" class="btn btn-warning btn-sm active viewOrderYesterday" role="button" aria-hidden="true" ><i class="fa fa-eye"></i> View Details</button>
          <div class="modal fade bd-example-modal-lg" id="viewOrderYesterday<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $name; ?> - #ORD<?php echo $order_id; ?> - <?php echo $cust_type; ?> customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                    Customer Tel: <?php echo $contact; ?>
                    <div class="row">
                          <p class="ml-4"><b><i>Order Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>Product: <span id="name_Yesterday<?php echo $id; ?>"><?php echo $product; ?></span></p>
                        </div>
                        <div class="col-4">
                            <label for="qtyYesterday">Quantity: </label>
                            <input type="number" name="qtyYesterday" id="qty_Yesterday<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Product Quantity..." value="<?php echo round($qty,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="qtyYesterday">Returned: </label>
                            <input type="number" name="returnedYesterday" id="returned_Yesterday<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Returned Quantity..." value="<?php echo round($returned,2); ?>" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Cost</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-3">
                            <p>Unit Price: Ksh. <?php echo round($price,2); ?></p>
                        </div>
                        <div class="col-3">
                        <label for="qtyYesterday">Discount/Unit (Ksh.): </label>
                           <input type="number" name="discountYesterday" id="discount_Yesterday<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Discount given per Unit..." value="<?php echo round($discount,2); ?>" required>
                        </div>
                        <div class="col-3">
                            <p>Fine: <?php echo round($fine,2); ?></p>
                        </div>
                        <div class="col-3">
                            <p>Net Cost: Ksh. <?php echo round($cost,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Payments</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>C/F/Debt: Ksh. <?php echo round($debt,2); ?></p>
                        </div>
                        <div class="col-2">
                        <label for="mpesaYesterday">MPesa (Ksh.): </label>
                           <input type="number" name="mpesaYesterday" id="mpesa_Yesterday<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in MPesa..." value="<?php echo round($mpesa,2); ?>" required>
                        </div>
                        <div class="col-2">
                        <label for="cashYesterday">Cash (Ksh.): </label>
                           <input type="number" name="cashYesterday" id="cash_Yesterday<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in Cash..." value="<?php echo round($cash,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <p>New Balance: Ksh. <?php echo round($balance,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      <label for="dateYesterday" class="ml-5">Order Expected On: </label>
                      <div class="col-10">
                          <input type="date" name="dateYesterday" id="date_Yesterday<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Date Expected..." value="<?php echo $delivery_date; ?>" required>
                     </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Invoice Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-10">
                        <label for="invoiceYesterday" class="ml-5">Invoice #: </label>
                          <input type="text" name="invoiceYesterday" id="invoice_Yesterday<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Invoice Number..." value="<?php echo $invoice; ?>" required>
                        </div>
                      </div>  
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Banking Details</i></b></p>
                      </div>
                      <div class="row">
                      <div class="col-4">
                      <label for="cashYesterday">Amount Banked (Ksh.): </label>
                          <input type="number" name="bankedYesterday" id="banked_Yesterday<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount banked..." value="<?php echo round($banked,2); ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashYesterday">Bank Slip #: </label>
                          <input type="text" name="slipYesterday" id="slip_Yesterday<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Bank Slip Number..." value="<?php echo $slip; ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashYesterday">Banked By: </label>
                          <input type="text" name="bankedByYesterday" id="banked_By_Yesterday<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Banked By Who?" value="<?php echo $banked_by; ?>" required>
                        </div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="margin-right: 50px" onclick="saveOrderYesterday(<?php echo $id; ?>)" id="<?php echo $id; ?>">Save Changes</button>
                  </form>
                  </div>
              </div>
            </div>
          </div>
          </td>
        <td>
        <?php
           if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {
         ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-secondary btn-sm active deleteOrderYesterday" role="button" aria-pressed="true" onclick="deleteOrderYesterday(this,<?php echo $id; ?>)">Return</button>
          <?php
          }
          ?>  
        </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
    </div>
    <div id="menu3" class="tab-pane fade main show active">
        <?php
        $deliveriesrowcount = mysqli_num_rows($pendingDeliveries);
      ?>
      <h4>Pending Deliveries</h4>
      <div class="row">
         <div class="col-12">
      <h6 class="offset-5">Total Number: <?php echo $deliveriesrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableToday" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Pending Deliveries - Time Limit (<?php echo $delivery_time_limit;?> minutes)</caption>
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="25%">Name</th>
      <th scope="col"width="20%">Time Left</th>
      <th scope="col"width="40%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($pendingDeliveries as $row){
         $count++;
         $id = $row['id'];
         $order_id = $row['order_id'];
        $name = $row['Name'];
        if($name == 'Unregistered Customer')
        {
          $name = $row['new_name'];
        }
        $cust_type = $row['type'];
        $contact = $row['Number'];
        $created_at = $row['created_at'];
        $deliverytime = new DateTime($created_at);
        $deliverytime->add(new DateInterval('PT' . $delivery_time_limit . 'M'));
        $delivery_stamp = $deliverytime->format('Y-m-d H:i');
        $from_time = strtotime(date("Y-m-d H:i:s"));
        $to_time = strtotime($delivery_stamp);
        $time_diff = ($to_time - $from_time) / 60;
        if ($time_diff > 12 ) {
          $name_color = "#2ECC71";
        }
        if (($time_diff > 6) && ($time_diff < 12)) {
          $name_color = "orange";
        }
        if ($time_diff < 6) {
          $name_color = "red";
        }


      ?>
    <tr>
      <th scope="row" class="uneditable" id="idToday<?php echo $count; ?>"><?php echo $order_id; ?></th>
      <td class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $name; ?></td>
      <!--<td><?php //echo $time_diff; ?><td>-->
      <input type="hidden" name="timeLeft" id="time_left<?php echo $order_id; ?>" value="<?php echo round($time_diff,2); ?>">
      <td style = "background-color: <?php echo $name_color; ?>;color: white"><div class="countdown show" data-Date='<?php echo $delivery_stamp; ?>' data-endText="00:00">
        <div class="running">
            <timer class="ml-5">
               <b><span class = "minutes ml-4"></span>:<span class = "seconds"></span></b>
            </timer>
        </div>
        <div class="ended">
            <div class="text">00:00</div>
            <div class = "break"></div>
        </div>
      </td>
      <td>
         <button id="<?php echo $order_id; ?>" data_id="<?php echo $order_id; ?>" class="btn btn-success btn-sm active completeDelivery" onclick="completeDelivery(<?php echo $order_id; ?>, this)"role="button" aria-pressed="true" ><i class="fa fa-check"></i>&ensp;Complete</button>     
         &nbsp;&nbsp;&nbsp;
         <button id="<?php echo $order_id; ?>" data_id="<?php echo $order_id; ?>" data-toggle="modal" data-target="#viewDeliveriesToday<?php echo $order_id; ?>" role="dialog" class="btn btn-primary btn-sm active viewOrderToday" role="button" aria-hidden="true" ><i class="fa fa-eye"></i>&ensp;View Details</button>
          <div class="modal fade bd-example-modal-lg" id="viewDeliveriesToday<?php echo $order_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $name; ?> - #ORD<?php echo $order_id; ?> - <?php echo $cust_type; ?> customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Customer Tel: <?php echo $contact; ?>
                    <div class="row">
                          <p class="ml-4"><b><i>Order Details</i></b></p>
                      </div>
                      <?php
                      $details = mysqli_query($connection,"SELECT o.id as order_id, s.Name as name, o.Quantity as qty, sf.Selling_price as Selling_price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN orders o ON o.Stock_id = s.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN orders o ON o.Stock_id = s.id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND o.Order_id = '$order_id';")or die($connection->error);
                      foreach($details as $row)
                      {
                         $id = $row['order_id'];
                         $product = $row['name'];
                         $quantity = $row['qty'];
                         $sp = $row['Selling_price'];
                         $cost = $quantity * $sp;
                      ?>
                      <div class="row">
                      <div class="col-3">
                            <p><b># <?php echo $id; ?></b></p>
                        </div>
                        <div class="col-3">
                            <p><b>Product:</b><br> <span id="name_Today<?php echo $id; ?>"><?php echo $product; ?></span></p>
                        </div>
                        <div class="col-3">
                            <p><b>Quantity:</b><br> <?php echo round($quantity,2); ?></p>
                        </div>
                        <div class="col-3">
                            <p><b>Cost:</b><br> <?php echo round($cost,2); ?></p>

                        </div>
                      </div><br>
                      <?php
                      }
                      ?>
                      <br> 
                  </div>
              </div>
            </div>
          </div>
          &nbsp;&nbsp;&nbsp;
          <button id="<?php echo $order_id; ?>" data_id="<?php echo $order_id; ?>" class="btn btn-danger btn-sm active deleteDelivery" role="button" aria-pressed="true" onclick="deleteDelivery(<?php echo $order_id; ?>, this)"><i class="fa fa-times"></i>&ensp;Cancel</button>
          </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<h4>Orders</h4>
      <div class="row">
         <div class="col-12">
           <?php
           $ordersrowcount = mysqli_num_rows($salesListToday);
           ?>
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableToday" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made Today</caption>
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="15%">Name</th>
      <th scope="col" width="19%">Product</th>
      <th scope="col"width="3%">Quantity</th>
      <th scope="col"width="13%">Unit Price</th>
      <th scope="col"width="4%">Cost</th>
      <th scope="col"width="4%">Balance</th>
      <th scope="col"width="20%"></th>
      <th scope="col"width="40%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($salesListToday as $row){
         $count++;
         $id = $row['id'];
         $order_id = $row['order_id'];
        $name = $row['Name'];
        if($name == 'Unregistered Customer')
        {
          $name = $row['new_name'];
        }
        $cust_type = $row['type'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        //MariaDB Only
       // $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only 
        $selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $discount = $row['Discount'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $fine = $row['Fine'];
        $time = date ('H:i',strtotime($row['created_at']));
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        if(($balance > 0 && $balance < 1) || ($balance > -1 && $balance < 0))
        {
          $balance = 0;
        }
        $delivery_date = $row['Delivery_time'];
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $invoice = $row['Invoice_Number'];
        $banked_by = $row['Banked_By'];
        if ($balance == "0.0" ) {
          $name_color = "#2ECC71";
        }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
          $name_color = "grey";
        }
        if ($balance > "0.0" ) {
          $name_color = "orange";
        }
        if ($balance < "-100.0" ) {
          $name_color = "red";
        }
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idToday<?php echo $count; ?>"><?php echo $order_id; ?></th>
      <td style = "background-color: <?php echo $name_color; ?>;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" id="productToday<?php echo $count; ?>"><?php echo $product; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyToday<?php echo $count; ?>"><?php echo round($qty,2); ?></td>
      <td class="uneditable" id="priceToday<?php echo $id; ?>"><?php echo round($price,2); ?></td>
      <td class="uneditable" id="costToday<?php echo $id; ?>"><?php echo round($cost,2); ?></td>
      <td class="uneditable" id="balanceToday<?php echo $id; ?>"><?php echo round($balance,2); ?></td>
         <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" data-toggle="modal" data-target="#viewOrderToday<?php echo $id; ?>" role="dialog" class="btn btn-warning btn-sm active viewOrderToday" role="button" aria-hidden="true" ><i class="fa fa-eye"></i> View Details</button>
          <div class="modal fade bd-example-modal-lg" id="viewOrderToday<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $name; ?> - #ORD<?php echo $order_id; ?> - <?php echo $cust_type; ?> customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                    <div class="row">
                      <div class="col-6">
                    Customer Tel: <?php echo $contact; ?>
                     </div>
                     <div class="col-6">
                    Time: <?php echo $time; ?>
                     </div>
                    </div>
                    <div class="row">
                          <p class="ml-4"><b><i>Order Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>Product: <span id="name_Today<?php echo $id; ?>"><?php echo $product; ?></span></p>
                        </div>
                        <div class="col-4">
                            <label for="qtyToday">Quantity: </label>
                            <input type="number" name="qtyToday" id="qty_Today<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Product Quantity..." value="<?php echo round($qty,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="qtyToday">Returned: </label>
                            <input type="number" name="returnedToday" id="returned_Today<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Returned Quantity..." value="<?php echo round($returned,2); ?>" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Cost</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-3">
                            <p>Unit Price: Ksh. <?php echo round($price,2); ?></p>
                        </div>
                        <div class="col-3">
                        <label for="qtyToday">Discount/Unit (Ksh.): </label>
                           <input type="number" name="discountToday" id="discount_Today<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Discount given per Unit..." value="<?php echo round($discount,2); ?>" required>
                        </div>
                        <div class="col-3">
                            <p>Fine: <?php echo round($fine,2); ?></p>
                        </div>
                        <div class="col-3">
                            <p>Net Cost: Ksh. <?php echo round($cost,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Payments</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>C/F/Debt: Ksh. <?php echo round($debt,2); ?></p>
                        </div>
                        <div class="col-2">
                        <label for="mpesaToday">MPesa (Ksh.): </label>
                           <input type="number" name="mpesaToday" id="mpesa_Today<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in MPesa..." value="<?php echo round($mpesa,2); ?>" required>
                        </div>
                        <div class="col-2">
                        <label for="cashToday">Cash (Ksh.): </label>
                           <input type="number" name="cashToday" id="cash_Today<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in Cash..." value="<?php echo round($cash,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <p>New Balance: Ksh. <?php echo round($balance,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      <label for="dateToday" class="ml-5">Order Expected On: </label>
                      <div class="col-10">
                          <input type="date" name="dateToday" id="date_Today<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Date Expected..." value="<?php echo $delivery_date; ?>" required>
                     </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Invoice Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-10">
                        <label for="invoiceToday" class="ml-5">Invoice #: </label>
                          <input type="text" name="invoiceToday" id="invoice_Today<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Invoice Number..." value="<?php echo $invoice; ?>" required>
                        </div>
                      </div>  
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Banking Details</i></b></p>
                      </div>
                      <div class="row">
                      <div class="col-4">
                      <label for="cashToday">Amount Banked (Ksh.): </label>
                          <input type="number" name="bankedToday" id="banked_Today<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount banked..." value="<?php echo round($banked,2); ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashToday">Bank Slip #: </label>
                          <input type="text" name="slipToday" id="slip_Today<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Bank Slip Number..." value="<?php echo $slip; ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashToday">Banked By: </label>
                          <input type="text" name="bankedByToday" id="banked_By_Today<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Banked By Who?" value="<?php echo $banked_by; ?>" required>
                        </div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="margin-right: 50px" onclick="saveOrderToday(<?php echo $id; ?>)" id="<?php echo $id; ?>">Save Changes</button>
                  </form>
                  </div>
              </div>
            </div>
          </div>
         </td>
          <td>
          <div class="dropdown">
            <a class="btn btn-sm btn-light" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bars"></i>&ensp;Options
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="tel:<?php echo $contact; ?>"><i class="fa fa-phone"></i>&ensp;Call Customer</a></li>
              <li><a class="dropdown-item" href="#" onclick="setAsDelivery(<?php echo $order_id; ?>); return false;">Set as delivery</a></li>
              <li><a class="dropdown-item" href="#" onclick="sendMpesaNotification(<?php echo $order_id; ?>, <?php echo $contact; ?>); return false;" ><i class="fa fa-mobile"></i>&ensp;Push M-Pesa STK Notification</a></li>
              <?php
              if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {
              ?>
              <li><a class="dropdown-item" href="#" onclick="fineCustomerToday(<?php echo $id; ?>); return false;"><i class="fa fa-money-bill"></i>&ensp;Fine</a></li>
              <li><a class="dropdown-item" href="#" onclick="deleteOrderToday(this,<?php echo $id; ?>); return false;"><i class="fa fa-arrow-left"></i>&ensp;Return</a></li>
              <?php
              }
              ?>
              <li><a class="dropdown-item" href="#" onclick="cancelOrderToday(this,<?php echo $id; ?>); return false;"><i class="fa fa-times"></i>&ensp;Cancel</a></li>
            </ul>
          </div>
        </td>

    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
    </div>
    <div id="menu4" class="tab-pane fade">
        <?php
        $ordersrowcount = mysqli_num_rows($salesListTomorrow);
      ?>
      <div class="row">
         <div class="col-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableTomorrow" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made For Tomorrow</caption>
  <thead class="thead-dark">
    <tr>
    <th scope="col" width="3%">#</th>
    <th scope="col"width="10%"></th>
      <th scope="col" width="18%">Name</th>
      <th scope="col"width="10%"></th>
      <th scope="col" width="19%">Product</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Quantity</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="13%">Unit Price</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Cost</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="20%"></th>
      <th scope="col"width="10%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($salesListTomorrow as $row){
         $count++;
         $id = $row['id'];
         $order_id = $row['order_id'];
         $name = $row['Name'];
         if($name == 'Unregistered Customer')
         {
           $name = $row['new_name'];
         }
         $cust_type = $row['type'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        $discount = $row['Discount'];
        //MariaDB Only
        //$selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        $selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $fine = $row['Fine'];
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        if(($balance > 0 && $balance < 1) || ($balance > -1 && $balance < 0))
        {
          $balance = 0;
        }
        $delivery_date = $row['Delivery_time'];
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $invoice = $row['Invoice_Number'];
        $banked_by = $row['Banked_By'];
        if ($balance == "0.0" ) {
          $name_color = "#2ECC71";
        }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
          $name_color = "grey";
        }
        if ($balance > "0.0" ) {
          $name_color = "orange";
        }
        if ($balance < "-100.0" ) {
          $name_color = "red";
        }
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idTomorrow<?php echo $count; ?>"><?php echo $order_id; ?></th>
      <td class="uneditable" ></td>
      <td style = "background-color: <?php echo $name_color; ?>;color: white"class="uneditable" id="nameTomorrow<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="productTomorrow<?php echo $count; ?>"><?php echo $product; ?></td>
      <td class="uneditable" ></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyTomorrow<?php echo $count; ?>"><?php echo round($qty,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="priceTomorrow<?php echo $id; ?>"><?php echo round($price,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="costTomorrow<?php echo $id; ?>"><?php echo round($cost,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="balanceTomorrow<?php echo $id; ?>"><?php echo round($balance,2); ?></td>
       <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active fineCustomerTomorrow" onclick="fineCustomerTomorrow(<?php echo $id; ?>)"role="button" aria-pressed="true" >Fine</button>
      </td>
      <td>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" data-toggle="modal" data-target="#viewOrderTomorrow<?php echo $id; ?>" role="dialog" class="btn btn-warning btn-sm active viewOrderTomorrow" role="button" aria-hidden="true" ><i class="fa fa-eye"></i> View Details</button>
          <div class="modal fade bd-example-modal-lg" id="viewOrderTomorrow<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $name; ?> - #ORD<?php echo $order_id; ?> - <?php echo $cust_type; ?> customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                    Customer Tel: <?php echo $contact; ?>
                    <div class="row">
                          <p class="ml-4"><b><i>Order Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>Product: <span id="name_Tomorrow<?php echo $id; ?>"><?php echo $product; ?></span></p>
                        </div>
                        <div class="col-4">
                            <label for="qtyTomorrow">Quantity: </label>
                            <input type="number" name="qtyTomorrow" id="qty_Tomorrow<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Product Quantity..." value="<?php echo round($qty,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="qtyTomorrow">Returned: </label>
                            <input type="number" name="returnedTomorrow" id="returned_Tomorrow<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Returned Quantity..." value="<?php echo round($returned,2); ?>" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Cost</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-3">
                            <p>Unit Price: Ksh. <?php echo round($price,2); ?></p>
                        </div>
                        <div class="col-3">
                        <label for="qtyTomorrow">Discount/Unit (Ksh.): </label>
                           <input type="number" name="discountTomorrow" id="discount_Tomorrow<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Discount given per Unit..." value="<?php echo round($discount,2); ?>" required>
                        </div>
                        <div class="col-3">
                            <p>Fine: <?php echo round($fine,2); ?></p>
                        </div>
                        <div class="col-3">
                            <p>Net Cost: Ksh. <?php echo round($cost,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Payments</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>C/F/Debt: Ksh. <?php echo round($debt,2); ?></p>
                        </div>
                        <div class="col-2">
                        <label for="mpesaTomorrow">MPesa (Ksh.): </label>
                           <input type="number" name="mpesaTomorrow" id="mpesa_Tomorrow<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in MPesa..." value="<?php echo round($mpesa,2); ?>" required>
                        </div>
                        <div class="col-2">
                        <label for="cashTomorrow">Cash (Ksh.): </label>
                           <input type="number" name="cashTomorrow" id="cash_Tomorrow<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in Cash..." value="<?php echo round($cash,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <p>New Balance: Ksh. <?php echo round($balance,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      <label for="dateTomorrow" class="ml-5">Order Expected On: </label>
                      <div class="col-10">
                          <input type="date" name="dateTomorrow" id="date_Tomorrow<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Date Expected..." value="<?php echo $delivery_date; ?>" required>
                     </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Invoice Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-10">
                        <label for="invoiceTomorrow" class="ml-5">Invoice #: </label>
                          <input type="text" name="invoiceTomorrow" id="invoice_Tomorrow<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Invoice Number..." value="<?php echo $invoice; ?>" required>
                        </div>
                      </div>  
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Banking Details</i></b></p>
                      </div>
                      <div class="row">
                      <div class="col-4">
                      <label for="cashTomorrow">Amount Banked (Ksh.): </label>
                          <input type="number" name="bankedTomorrow" id="banked_Tomorrow<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount banked..." value="<?php echo round($banked,2); ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashTomorrow">Bank Slip #: </label>
                          <input type="text" name="slipTomorrow" id="slip_Tomorrow<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Bank Slip Number..." value="<?php echo $slip; ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashTomorrow">Banked By: </label>
                          <input type="text" name="bankedByTomorrow" id="banked_By_Tomorrow<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Banked By Who?" value="<?php echo $banked_by; ?>" required>
                        </div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="margin-right: 50px" onclick="saveOrderTomorrow(<?php echo $id; ?>)" id="<?php echo $id; ?>">Save Changes</button>
                  </form>
                  </div>
              </div>
            </div>
          </div>
      </td>  
        <td>
        <?php
           if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {
        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-secondary btn-sm active deleteOrderTomorrow" role="button" aria-pressed="true" onclick="deleteOrderTomorrow(this,<?php echo $id; ?>)">Return</button>
          <?php
          }
          ?>
        </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
    </div>
    <div id="menu5" class="tab-pane fade">
        <?php
        $ordersrowcount = mysqli_num_rows($salesListNextMonth);
      ?>
      <div class="row">
         <div class="col-12">
      <h6 class="offset-5">Total Number: <?php echo $ordersrowcount; ?></h6>
    </div>
      </div> 
      <table id="salesEditableNextMonth" class="table table-striped table-hover table-responsive  paginate" style="overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made For Coming Month</caption>
  <thead class="thead-dark">
    <tr>
    <th scope="col" width="3%">#</th>
    <th scope="col"width="10%"></th>
      <th scope="col" width="20%">Name</th>
      <th scope="col"width="10%"></th>
      <th scope="col" width="25%">Product</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Quantity</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Unit Price</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Cost</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="5%">Balance</th>
      <th scope="col"width="10%"></th>
      <th scope="col"width="20%"></th>
      <th scope="col"width="10%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($salesListNextMonth as $row){
         $count++;
         $id = $row['id'];
         $order_id = $row['order_id'];
         $name = $row['Name'];
         if($name == 'Unregistered Customer')
         {
           $name = $row['new_name'];
         }
         $cust_type = $row['type'];
        $contact = $row['Number'];
        $product = $row['name'];
        $qty = $row['Quantity'];
        $discount = $row['Discount'];
        //MariaDB Only
        //$selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only
        $selling_price = mysqli_query($connection,"SELECT sf.Selling_price as Selling_price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product';")or die($connection->error);
         $row2 = mysqli_fetch_array($selling_price);
        $price = $row2['Selling_price'];
        $newCost = $price - $discount;
        $cost = $qty * $newCost; 
        $debt = $row['Debt'];
        $mpesa = $row['MPesa'];
        $cash = $row['Cash'];
        $fine = $row['Fine'];
        $balance = ($mpesa + $cash) + $debt - $cost + $fine;
        if(($balance > 0 && $balance < 1) || ($balance > -1 && $balance < 0))
        {
          $balance = 0;
        }
        if ($balance == "0.0" ) {
          $name_color = "#2ECC71";
        }
        if ($balance  < "0.0" && $balance  >= "-100.0" ) {
          $name_color = "grey";
        }
        if ($balance > "0.0" ) {
          $name_color = "orange";
        }
        if ($balance < "-100.0" ) {
          $name_color = "red";
        }
        $delivery_date = $row['Delivery_time'];
        $returned = $row['Returned'];
        $banked = $row['Banked'];
        $slip = $row['Slip_Number'];
        $invoice = $row['Invoice_Number'];
        $banked_by = $row['Banked_By'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idNextMonth<?php echo $count; ?>"><?php echo $order_id; ?></th>
      <td class="uneditable" ></td>
      <td style = "background-color: <?php echo $name_color; ?>;color: white"class="uneditable" id="nameNextMonth<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="productNextMonth<?php echo $count; ?>"><?php echo $product; ?></td>
      <td class="uneditable" ></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyNextMonth<?php echo $count; ?>"><?php echo round($qty,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="priceNextMonth<?php echo $id; ?>"><?php echo round($price,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="costNextMonth<?php echo $id; ?>"><?php echo round($cost,2); ?></td>
      <td class="uneditable" ></td>
      <td class="uneditable" id="balanceNextMonth<?php echo $id; ?>"><?php echo round($balance,2); ?></td>
      <td class="uneditable" ></td>
       <td>
       <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" data-toggle="modal" data-target="#viewOrderNextMonth<?php echo $id; ?>" role="dialog" class="btn btn-warning btn-sm active viewOrderNextMonth" role="button" aria-hidden="true" ><i class="fa fa-eye"></i> View Details</button>
          <div class="modal fade bd-example-modal-lg" id="viewOrderNextMonth<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $name; ?> - #ORD<?php echo $order_id; ?> - <?php echo $cust_type; ?> customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                    Customer Tel: <?php echo $contact; ?>
                    <div class="row">
                          <p class="ml-4"><b><i>Order Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>Product: <span id="name_NextMonth<?php echo $id; ?>"><?php echo $product; ?></span></p>
                        </div>
                        <div class="col-4">
                            <label for="qtyNextMonth">Quantity: </label>
                            <input type="number" name="qtyNextMonth" id="qty_NextMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Product Quantity..." value="<?php echo round($qty,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="qtyNextMonth">Returned: </label>
                            <input type="number" name="returnedNextMonth" id="returned_NextMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Returned Quantity..." value="<?php echo round($returned,2); ?>" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Cost</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-3">
                            <p>Unit Price: Ksh. <?php echo round($price,2); ?></p>
                        </div>
                        <div class="col-3">
                        <label for="qtyNextMonth">Discount/Unit (Ksh.): </label>
                           <input type="number" name="discountNextMonth" id="discount_NextMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Discount given per Unit..." value="<?php echo round($discount,2); ?>" required>
                        </div>
                        <div class="col-3">
                            <p>Fine: <?php echo round($fine,2); ?></p>
                        </div>
                        <div class="col-3">
                            <p>Net Cost: Ksh. <?php echo round($cost,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Payments</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>C/F/Debt: Ksh. <?php echo round($debt,2); ?></p>
                        </div>
                        <div class="col-2">
                        <label for="mpesaNextMonth">MPesa (Ksh.): </label>
                           <input type="number" name="mpesaNextMonth" id="mpesa_NextMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in MPesa..." value="<?php echo round($mpesa,2); ?>" required>
                        </div>
                        <div class="col-2">
                        <label for="cashNextMonth">Cash (Ksh.): </label>
                           <input type="number" name="cashNextMonth" id="cash_NextMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in Cash..." value="<?php echo round($cash,2); ?>" required>
                        </div>
                        <div class="col-4">
                            <p>New Balance: Ksh. <?php echo round($balance,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      <label for="dateNextMonth" class="ml-5">Order Expected On: </label>
                      <div class="col-10">
                          <input type="date" name="dateNextMonth" id="date_NextMonth<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Date Expected..." value="<?php echo $delivery_date; ?>" required>
                     </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Invoice Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-10">
                        <label for="invoiceNextMonth" class="ml-5">Invoice #: </label>
                          <input type="text" name="invoiceNextMonth" id="invoice_NextMonth<?php echo $id; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Invoice Number..." value="<?php echo $invoice; ?>" required>
                        </div>
                      </div>  
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Banking Details</i></b></p>
                      </div>
                      <div class="row">
                      <div class="col-4">
                      <label for="cashNextMonth">Amount Banked (Ksh.): </label>
                          <input type="number" name="bankedNextMonth" id="banked_NextMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Amount banked..." value="<?php echo round($banked,2); ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashNextMonth">Bank Slip #: </label>
                          <input type="text" name="slipNextMonth" id="slip_NextMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Bank Slip Number..." value="<?php echo $slip; ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashNextMonth">Banked By: </label>
                          <input type="text" name="bankedByNextMonth" id="banked_By_NextMonth<?php echo $id; ?>" class="form-control" style="padding:15px;" placeholder="Banked By Who?" value="<?php echo $banked_by; ?>" required>
                        </div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="margin-right: 50px" onclick="saveOrderNextMonth(<?php echo $id; ?>)" id="<?php echo $id; ?>">Save Changes</button>
                  </form>
                  </div>
              </div>
            </div>
          </div>
      </td>
        <td>
        <?php
           if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {
        ?>
          <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-secondary btn-sm active deleteOrderNextMonth" role="button" aria-pressed="true" onclick="deleteOrderNextMonth(this,<?php echo $id; ?>)">Return</button>
          <?php
          }
          ?>  
        </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
    </div>
  </div>

    <ul class="nav nav-tabs">
      <li><a data-toggle="tab" class="nav-link salesTab" href="#menu1" style="color: inherit;">Last 1 Month's Orders</a></li>
    <li><a data-toggle="tab" class="nav-link salesTab" href="#menu2" style="color: inherit;">Yesterday's Orders</a></li>
    <li class="active"><a data-toggle="tab" class="nav-link salesTab active" href="#menu3" style="color: inherit;">Today's Orders</a></li>
    <li><a data-toggle="tab" class="nav-link salesTab" href="#menu4" style="color: inherit;">Tomorrow's Orders</a></li>
    <li><a data-toggle="tab" class="nav-link salesTab" href="#menu5" style="color: inherit;">Next 1 Month's Orders</a></li>
  </ul>


  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?>
