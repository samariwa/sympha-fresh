<?php
 include "admin_nav.php";
 include('../queries.php');
 ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Sales</span><span style="font-size: 15px;"> /Customer Debts</span></h1>
                        <h6 class="text-gray-600" style="margin-left: 450px;">Time: <span id="time"></span></h6>
            <button class="btn btn-light btn-md active printSales mr-3" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
          </div>
        <?php
         include "dashboard_tabs.php";
        ?>
      <div class="row">
      <div class="col-2">  
      <a href="sales.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
    </div><br>
      <div class="row">
         <div class="col-12">
           <?php
           $balancesrowcount = mysqli_num_rows($pendingBalances);
           ?>
      <h6 class="offset-5">Total Number: <?php echo $balancesrowcount; ?></h6>
    </div>
      </div> 
      <table id="customerDebtsEditable" class="table table-striped table-hover table-responsive  paginate" style="display:block;overflow-x:scroll;overflow-y:scroll;text-align: center;">
      <caption>Unpaid debts</caption>
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="15%">Name</th>
      <th scope="col"width="14%">Contact</th>
      <th scope="col"width="14%">Date</th>
      <th scope="col"width="14%">Balance</th>
      <th scope="col"width="20%">Cash Payment</th>
      <th scope="col"width="20%">M-Pesa Payment</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($pendingBalances as $row){
         $count++;
         $id = $row['id'];
         $order_id = $row['order_id'];
         $name = $row['Name'];
         if($name == 'Unregistered Customer')
         {
           $name = $row['new_name'];
         }
        $contact = $row['Number'];
        $balance = $row['Balance'];
        $delivery_date = $row['Delivery_time'];
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
      <th scope="row" class="uneditable" id="debtId<?php echo $count; ?>"><?php echo $id; ?></th>
      <td style = "background-color: <?php echo $name_color; ?>;color: white"class="uneditable" id="debtName<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" id="debtContact<?php echo $id; ?>"><?php echo $contact; ?></td>
      <td class="uneditable" id="debtDate<?php echo $id; ?>"><?php echo $delivery_date; ?></td>
      <td class="uneditable" id="balanceToday<?php echo $id; ?>"><?php echo round($balance,2); ?></td>
      <td class="editable" id="debtCash<?php echo $count; ?>">0</td>
      <td class="editable" id="debtMpesa<?php echo $count; ?>">0</td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>


  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?>