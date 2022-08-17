<?php
 include "admin_nav.php";
  include('../queries.php');
  require_once '../core/init.php';
  $Customer = new Customer();
  $Stock = new Stock();
 ?> 
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales </span><span style="font-size: 15px;">/New Order</span></h1>
         <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
           <?php
       include "dashboard_tabs.php";

        ?>
        <div class="row">
        <div class="col-2">  
          <a href="sales.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
        </div>
        </div><br>
        <form method="POST">

         <table id="customerOrderSearch" class="table table-striped table-hover" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="5%">Select</th>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="12%">Location</th>
      <th scope="col" width="17%">Contact Number</th>
      <th scope="col" width="10%">Deliverer</th>
      <th scope="col"width="10%">Note</th>
    </tr>
  </thead>
  <tbody >
  <tr>
      <td ><input type="radio" id='selectedUnregisteredCustomer' onclick="selectCustomer(this);" name="selectedCustomer"  value="N/A"></td>
      <th scope="row" id="id">--</th>
      <td id="customerName">Unregistered Customer</td>
      <td id="customerLocation">--</td>
      <td id="customerNumber">--</td>
      <td id="customerDeliverer">--</td>
      <td id="customerNote">--</td>
    </tr>
    <?php
        $count = 0;
        foreach($Customer->fetchFinedCustomers() as $customer){
         $count++;
      ?>
    <tr>
      <td ><input type="radio" id='selectedCustomer' onclick="selectCustomer(this);" name="selectedCustomer" value="<?php echo $customer['id']; ?>"></td>
      <th scope="row" id="id<?php echo $customer['id']; ?>"><?php echo $customer['id']; ?></th>
      <td id="customerName<?php echo $customer['id']; ?>"><?php echo $customer['Name']; ?></td>
      <td id="customerLocation<?php echo $customer['id']; ?>"><?php echo $customer['Location']; ?></td>
      <td id="customerNumber<?php echo $customer['id']; ?>"><?php echo $customer['Number']; ?></td>
      <td id="customerDeliverer<?php echo $customer['id']; ?>"><?php echo $customer['Deliverer']; ?></td>
      <td id="customerNote<?php echo $customer['id']; ?>"><?php echo $customer['Note']; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table><br>
<p style="text-align:center">If non-registered customer field name below</p>
<div class="row">
      <div class="input-group-prepend col-5" >
           <span class="input-group-text offset-9" id="inputGroup-sizing-default" >Customer Name:</span>
           </div>
       <div class="col-5">
       <input type="text" class="form-control col-6 offset-2" name="newCustomer" id="newCustomer" aria-describedby="inputGroup-sizing-default" autofocus style="font-family: FontAwesome, Arial; font-style: normal;">
        </div>
        </div><br><br>

       <table id="productOrderSearch" class="table table-striped table-hover" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr >
      <th scope="col" width="5%">#</th>
      <th scope="col" width="15%">Category</th>
      <th scope="col" width="18%">Stock Name</th>
      <th scope="col"width="15%">Selling Price</th>
      <th scope="col"width="10%">Discount</th>
      <th scope="col"width="18%">Quantity Available</th>
       <th scope="col"width="18%"></th>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($Stock->fetchStock() as $stock){
         $count++;
      ?>
    <tr>
      <th scope="row" id="id<?php echo $stock['id']; ?>"><?php echo $stock['id']; ?></th>
      <td id="category<?php echo $stock['id']; ?>"><?php echo $stock['Category_Name']; ?></td>
      <td id="name<?php echo $stock['id']; ?>"><?php echo $stock['Name']; ?></td>
      <td id="sp<?php echo $stock['id']; ?>"><?php echo $stock['Price']; ?></td>
      <td id="Discount<?php echo $stock['id']; ?>"><?php echo $stock['Discount']; ?></td>
      <td id="qty<?php echo $stock['id']; ?>"><?php echo $stock['Quantity']; ?></td>
      <?php
       if ($stock['Quantity'] > 0) {
      ?>
      <td><button type="button" class="btn btn-warning addToCart" onclick="cartArray(<?php echo $stock['id']; ?>)" id="add_product<?php echo $stock['id']; ?>" data_id="<?php echo $stock['id']; ?>"><i class="fa fa-cart-plus" ></i>&emsp;Add To Cart</button></td>
      <?php
       }else{
      ?>
        <td><button type="button" class="btn btn-warning addToCart" disabled onclick="cartArray(<?php echo $stock['id']; ?>)" id="add_product<?php echo $stock['id']; ?>" data_id="<?php echo $stock['id']; ?>"><i class="fa fa-cart-plus" ></i>&emsp;Add To Cart</button></td>
      <?php
        }
      ?>
   </tr>
    <?php
    }
    ?>
  </tbody>
</table><br>

        
        <h3>Cart</h3>
        <div class="row">
        <table class="table table-bordered" id="cartEditable">
  <thead>
    <tr style="text-align: center;">
      <th scope="col" width="5%">#</th>
      <th scope="col" width="40%">Product Description</th>
      <th scope="col" width="10%">Unit Price</th>
      <th scope="col" width="10%">Quantity</th>
      <th scope="col" width="10%">Discount</th>
      <th scope="col" width="11%"></th>
      <th scope="col" width="15%">Sub-Total</th>
    </tr>
  </thead>
  <tbody id="cartData">

 </tbody>
    <tfoot>
      <th scope="row" colspan="6"><b>Total:</b></th>
      <td id="cartTotal"style="text-align: center;">0</td>
    </tfoot>
</table>
</div><br>
<div class="row" id="customerDetails">
  
</div><br>
    <div class="row">
      <div class="input-group-prepend col-5">
           <span class="input-group-text offset-9" id="inputGroup-sizing-default">Date of Delivery:</span>
           </div>
       <div class="col-5">
       <input type="date"  class="form-control col-6 offset-2" name="deliveryDate" id="deliveryDate" value="" aria-describedby="inputGroup-sizing-default" required autocomplete="date" autofocus style="font-family: FontAwesome, Arial; font-style: normal;">
        </div>
        </div><br><br>

          <div class="row">
          <div class="col-6 d-flex justify-content-center">
          <button type="submit" class="btn btn-success btn-md completeOrder" id="completeOrderLaterBtn"><!--<i class="fa fa-check"></i>&emsp;-->Complete Order (On Credit)</button>
          </form>
          </div>
          <div class="col-6 d-flex justify-content-center">
          <a href="#" data-toggle="modal" id="completeOrderNowBtn" data-target="#exampleModalScrollable" class="btn btn-success btn-md placeOrder" role="button" aria-pressed="true"><i class="fa fa-check"></i>&ensp;Complete Order (Now)<!--& Print Receipt--></a>
      <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Place Order</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <input type="hidden" id="orderCustomerName" value="John Doe"></input>
                <div class="row"><p style="margin-left: 60px" id="orderTotal">Order Cost: Ksh. 00.00</p></div>
                <div class="row">
                  <label for="amount_paid" style="margin-left: 60px">Amount Paid</label>
                 <input type="number" name="amount_paid" id= "amount_paid" class="form-control col-9" style="padding:15px;margin-left: 60px" required min="0" val="0.00">
                  </div><br>
                  <p style="margin-left: 60px;">Mode of Payment:</p> 
                  <div class="row">
                    <div class="form-check mt-n3" style="margin-left: 60px;">
                        <input class="form-check-input" type="radio" name="payment-mode" id="cash" value="0" >
                        <label class="form-check-label" for="exampleRadios1">
                          Cash
                        </label>
                    </div>  
                    </div> 
                    <div class="row">   
                  <div class="form-check mt-n1" style="margin-left: 60px;">
                        <input class="form-check-input" type="radio" name="payment-mode" id="mpesa" value="1">
                        <label class="form-check-label" for="exampleRadios2">
                          M-Pesa
                        </label>
                  </div>
            </div><br>
            <div class="row">
                <div class="ios-switch ml-5">
                <label><h6>Home Delivery</h6></label>
                    <div class="switch-body">
                        <div class="toggle">

                        </div>
                    </div>
                    <input type="checkbox" name="delivery" id="home_delivery">
            </div>
           </div>
            <div class="row"><p style="margin-left: 60px" id="paidBalance">Balance: Ksh. 00.00</p></div>
                  <input type="hidden" name="where" id= "where"  value="customer">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="orderAndPrint">Place Order<!--Print Receipt--></button>
            </form>
            </div>
          </div>
        </div>
      </div>
          </div>
        </div><br>
<!--
             <div class="row">
          <div class="input-group mb-5" style="margin-left: 250px;">
          <div class="input-group-prepend" >
           <span class="input-group-text" id="inputGroup-sizing-default">Customer #:</span>
           </div>
         <input type="text" class="form-control col-6" required aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;" placeholder='Search...&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&#xf002;' name="customerSearch" id="customerSearch">
       </div>
       <div class="list-group" id="customer_results" style="margin-top: -5px;margin-left: 350px;">

       </div>
        </div><br>

               <div class="row">
          <div class="input-group mb-3" style="margin-left: 160px;">
          <div class="input-group-prepend" >
           <span class="input-group-text" id="inputGroup-sizing-default">Product:</span>
           </div>
         <input type="text" class="form-control col-6" required aria-label="Default" aria-describedby="inputGroup-sizing-default" style="font-family: FontAwesome, Arial; font-style: normal;" placeholder='Search...&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&#xf002;' name="productSearch" id="productSearch">
         <div class="input-group-prepend"style="margin-left: 30px;" >
           <span class="input-group-text" id="inputGroup-sizing-default">Quantity:</span>
           </div>
         <input type="number" class="form-control col-1" name="orderQty" id="orderQty" min="1" oninput="validity.valid||(value='');">
       </div>
       <div class="list-group" id="product_results" style="margin-top: -5px;margin-left: 350px;">
         
       </div>
        </div><br>

        <div class="row">
          <button type="button" class="btn btn-success col-4 " style="margin-left: 320px"><i class="fa fa-cart-plus" id="addToCart"></i>&emsp;Add to Cart</button>
        </div><br>
        </form>
-->
 
  <!-- Scroll to Top Button-->
  <script Type="text/javascript">
    var completeOrderBtn = document.getElementById(`completeOrderNowBtn`);
    completeOrderBtn.disabled = true;
    var completeOrderLaterBtn = document.getElementById(`completeOrderLaterBtn`);
    completeOrderLaterBtn.disabled = true;
    var completeOrderAndPrint = document.getElementById(`orderAndPrint`);
    completeOrderAndPrint.disabled = true;
  </script>
  <?php include "admin_footer.php" ?> 