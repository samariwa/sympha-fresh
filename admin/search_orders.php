<?php
 include "admin_nav.php";
 $Sales = new Sales();
 ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
             <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales Search</span></h1>
                        <h6 class="text-gray-600" style="margin-left: 480px;">Time: <span id="time"></span></h6>
            <button class="btn btn-light btn-md active printSales mr-3" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
          </div>
          <?php
       }
       else{
        ?>
         <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales Search</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
        <?php
         }
         include "dashboard_tabs.php";
        ?>
      <div class="row">
        <div class="col-2">
        <a href="sales.php" class="btn btn-primary btn-md active float-left" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
      <div class="col-6">
      <input type="text" class="form-control col-12 offset-2" aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;"  name="filter_orders" id="filter_orders" placeholder="&#xf0b0 Filter customer/date...">
        </div>
    </div><br>
          <div id="dynamic-section">
          <?php
          $name_color = '';
          ?>

    <div id="menu" class="tab-pane fade main show active">
      <div class="row">
         <div class="col-12">
      <h6 class="offset-5">Total Number: <?php echo $Sales->ordersTodayCount(); ?></h6>
    </div>
      </div> 
      <table id="OrderSearch" class="table table-striped table-hover table-responsive" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Orders Made Today</caption>
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
  <tbody >
    <?php
        $count = 0;
        foreach($Sales->fetchOrdersToday() as $salesToday){
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
      ?>
    <tr>
      <th scope="row" class="uneditable" id="idToday<?php echo $count; ?>"><?php echo $salesToday['order_id']; ?></th>
      <td class="uneditable" id="priceToday<?php echo $salesToday['id']; ?>"><?php echo date("d/m/Y", strtotime($salesToday['Delivery_time'])); ?></td>
      <td style = "background-color: <?php echo $Sales->getCustomerBalanceColor($balance); ?>;color: white"class="uneditable" id="nameToday<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" id="productToday<?php echo $count; ?>"><?php echo $salesToday['name']; ?></td>
      <td <?php if( $view == 'Software' ){?>class="editable"<?php }else{ ?> class="uneditable"<?php } ?> id="qtyToday<?php echo $count; ?>"><?php echo round($salesToday['Quantity'],2); ?></td>
      <td class="uneditable" id="costToday<?php echo $salesToday['id']; ?>"><?php echo round($cost,2); ?></td>
      <td class="uneditable" id="balanceToday<?php echo $salesToday['id']; ?>"><?php echo round($balance,2); ?></td>
         <td>
         <button id="<?php echo $salesToday['id']; ?>" data_id="<?php echo $salesToday['id']; ?>" data-toggle="modal" data-target="#viewOrderToday<?php echo $salesToday['id']; ?>" role="dialog" class="btn btn-warning btn-sm active viewOrderToday" role="button" aria-hidden="true" ><i class="fa fa-eye"></i> View Details</button>
          <div class="modal fade bd-example-modal-lg" id="viewOrderToday<?php echo $salesToday['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $name; ?> - #ORD<?php echo $salesToday['order_id']; ?> - <?php echo $salesToday['type']; ?> customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                    <div class="row">
                      <div class="col-6">
                    Customer Tel: <?php echo $salesToday['Number']; ?>
                     </div>
                     <div class="col-6">
                    Time: <?php echo date('H:i',strtotime($salesToday['created_at'])); ?>
                     </div>
                    </div>
                    <div class="row">
                          <p class="ml-4"><b><i>Order Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-4">
                            <p>Product: <span id="name_Today<?php echo $salesToday['id']; ?>"><?php echo $salesToday['name']; ?></span></p>
                        </div>
                        <div class="col-4">
                            <label for="qtyToday">Quantity: </label>
                            <input type="number" name="qtyToday" id="qty_Today<?php echo $salesToday['id']; ?>" class="form-control" style="padding:15px;" placeholder="Product Quantity..." value="<?php echo round($salesToday['Quantity'],2); ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="qtyToday">Returned: </label>
                            <input type="number" name="returnedToday" id="returned_Today<?php echo $salesToday['id']; ?>" class="form-control" style="padding:15px;" placeholder="Returned Quantity..." value="<?php echo round($salesToday['Returned'],2); ?>" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Order Cost</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-3">
                            <p>Unit Price: Ksh. <?php echo round($Sales->fetchSellingPrice($salesToday['name']) ,2); ?></p>
                        </div>
                        <div class="col-3">
                        <label for="qtyToday">Discount/Unit (Ksh.): </label>
                           <input type="number" name="discountToday" id="discount_Today<?php echo $salesToday['id']; ?>" class="form-control" style="padding:15px;" placeholder="Discount given per Unit..." value="<?php echo round($salesToday['Discount'],2); ?>" required>
                        </div>
                        <div class="col-3">
                            <p>Fine: <?php echo round($salesToday['Fine'],2); ?></p>
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
                            <p>C/F/Debt: Ksh. <?php echo round($salesToday['Debt'],2); ?></p>
                        </div>
                        <div class="col-2">
                        <label for="mpesaToday">MPesa (Ksh.): </label>
                           <input type="number" name="mpesaToday" id="mpesa_Today<?php echo $salesToday['id']; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in MPesa..." value="<?php echo round($salesToday['MPesa'],2); ?>" required>
                        </div>
                        <div class="col-2">
                        <label for="cashToday">Cash (Ksh.): </label>
                           <input type="number" name="cashToday" id="cash_Today<?php echo $salesToday['id']; ?>" class="form-control" style="padding:15px;" placeholder="Amount paid in Cash..." value="<?php echo round($salesToday['Cash'],2); ?>" required>
                        </div>
                        <div class="col-4">
                            <p>New Balance: Ksh. <?php echo round($balance,2); ?></p>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      <label for="dateToday" class="ml-5">Order Expected On: </label>
                      <div class="col-10">
                          <input type="date" name="dateToday" id="date_Today<?php echo $salesToday['id']; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Date Expected..." value="<?php echo $salesToday['Delivery_time']; ?>" required>
                     </div>
                      </div>
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Invoice Details</i></b></p>
                      </div>
                      <div class="row">
                        <div class="col-10">
                        <label for="invoiceToday" class="ml-5">Invoice #: </label>
                          <input type="text" name="invoiceToday" id="invoice_Today<?php echo $salesToday['id']; ?>" class="form-control offset-1" style="padding:15px;" placeholder="Invoice Number..." value="<?php echo $salesToday['Invoice_Number']; ?>" required>
                        </div>
                      </div>  
                      <br>
                      <div class="row">
                          <p class="ml-4"><b><i>Banking Details</i></b></p>
                      </div>
                      <div class="row">
                      <div class="col-4">
                      <label for="cashToday">Amount Banked (Ksh.): </label>
                          <input type="number" name="bankedToday" id="banked_Today<?php echo $salesToday['id']; ?>" class="form-control" style="padding:15px;" placeholder="Amount banked..." value="<?php echo round($salesToday['Banked'],2); ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashToday">Bank Slip #: </label>
                          <input type="text" name="slipToday" id="slip_Today<?php echo $salesToday['id']; ?>" class="form-control" style="padding:15px;" placeholder="Bank Slip Number..." value="<?php echo $salesToday['Slip_Number']; ?>" required>
                        </div>
                        <div class="col-4">
                        <label for="cashToday">Banked By: </label>
                          <input type="text" name="bankedByToday" id="banked_By_Today<?php echo $salesToday['id']; ?>" class="form-control" style="padding:15px;" placeholder="Banked By Who?" value="<?php echo $salesToday['Banked_By']; ?>" required>
                        </div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="margin-right: 50px" onclick="saveOrderToday(<?php echo $salesToday['id']; ?>)" id="<?php echo $salesToday['id']; ?>">Save Changes</button>
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
            <li><a class="dropdown-item" href="tel:<?php echo $salesToday['Number']; ?>"><i class="fa fa-phone"></i>&ensp;Call Customer</a></li>
              <li><a class="dropdown-item" href="#" onclick="setAsDelivery(<?php echo $salesToday['order_id']; ?>); return false;">Set as delivery</a></li>
              <li><a class="dropdown-item" href="#" onclick="sendMpesaNotification(<?php echo $salesToday['order_id']; ?>, <?php echo $salesToday['Number']; ?>); return false;" ><i class="fa fa-mobile"></i>&ensp;Push M-Pesa STK Notification</a></li>
              <?php
              if ($view == 'Software'  || $view == 'CEO' || $view == 'Director' || $view == 'Stores Manager') {
              ?>
              <li><a class="dropdown-item" href="#" onclick="fineCustomerToday(<?php echo $salesToday['id']; ?>); return false;"><i class="fa fa-money-bill"></i>&ensp;Fine</a></li>
              <li><a class="dropdown-item" href="#" onclick="deleteOrderToday(this,<?php echo $salesToday['id']; ?>); return false;"><i class="fa fa-arrow-left"></i>&ensp;Return</a></li>
              <?php
              }
              ?>
              <li><a class="dropdown-item" href="#" onclick="cancelOrderToday(this,<?php echo $salesToday['id']; ?>); return false;"><i class="fa fa-times"></i>&ensp;Cancel</a></li>
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
  

    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" class="nav-link salesTab active" href="#menu" style="color: inherit;">Today's Orders</a></li>
  </ul>
  </div>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?>
