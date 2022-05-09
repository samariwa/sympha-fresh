<?php
 include "admin_nav.php";
  include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Assets</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>

  <div class="row">
    <div class="col-4">
             <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;Add Asset</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Add Asset</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form method="POST">
                  <div class="row">
                 <input type="text" name="name" id="name" class="form-control col-9" style="padding:15px;margin-left: 60px" placeholder="Asset Name..." required>
                  </div><br>
                  <div class="row">
                 <input type="number" name="value" id="value" class="form-control col-9" style="padding:15px;margin-left: 60px" step="0.1" placeholder="Asset Value..." required>
                  </div><br>
                  <input type="hidden" name="where" id= "where"  value="asset">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addAsset">Add Asset</button>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-4">
           <?php
        $assetsrowcount = mysqli_num_rows($assetsList) + 1;
      ?>
      <h6 class="offset-4">Total Number: <?php echo $assetsrowcount; ?></h6>
      </div>
      <div class="col-4">
       
       </div>
        </div><br>
        <table id="assetsEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="20%">Asset Name</th>
      <th scope="col" width="20%">Asset Type</th>
      <th scope="col" width="20%">Asset Value</th>
      <th scope="col"width="23%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $totalValue = 0;
        foreach($valuationQuery as $row){
          $count++;
          $name = $row['sname'];
         $purchase = $row['purchased'];
         $qty = $row['Quantity'];
          if ($qty <= $purchase) {
         $closing = $qty;
         }
         $damaged = $row['damaged'];
         $bp = $row['Buying_price'];
         //MariaDB Only
         //$previousValuation = mysqli_query($connection,"WITH qry AS (SELECT  s.id as sid, sf.id as sfid , s.Name as sname ,s.Opening_stock as Opening_stock,sf.Damaged as damaged,sf.purchased as purchased,s.Quantity as Quantity,sf.Buying_price as Buying_price,sf.Received_date as received, sf.Expiry_date as expiry, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.id DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id  )SELECT sfid, sname , Buying_price,damaged, purchased,  Quantity ,received FROM qry WHERE rn = 2 AND sname = '$name'")or die($connection->error);
         //Hybrid
         $previousValuation = mysqli_query($connection,"SELECT sf.id as sfid,sf.Damaged as damaged,sf.Buying_price as Buying_price,sf.purchased as purchased,s.Quantity as Quantity, s.name as sname,sf.Received_date as received FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id )subQuery  ON subQuery.max_id = s.id  WHERE s.name = '$name' ORDER BY sf.id DESC LIMIT 1,1;")or die($connection->error);   
         if ($qty > $purchase) {
           $closing = $purchase;
        }
        $value = $bp * $closing;
        $totalValue += $value;
     if ($qty > $purchase) {
       $row2 = mysqli_fetch_array($previousValuation);
         $purchase2 = $row2['purchased'];
         $damaged2 = $row2['damaged'];
         $bp2 = $row2['Buying_price'];
         $quantity = $qty - $purchase;
         $value2 = $bp2 * $quantity;
         $totalValue += $value2;
     }
     }
        ?>
        <tr>
          <th scope="row" class="uneditable" id="stock">1</th>
          <td class="uneditable" id="stock_name">Stock Inventory</td>
          <td class="uneditable" id="asset_type">Current Asset</td>
          <td class="uneditable" id="stock_value"><?php echo number_format($totalValue,2); ?></td>
          <td>
        
       </td>
        </tr>
        <?php
        $count = 1;
        foreach($assetsList as $row){
         $count++;
         $id = $row['id'];
        $name = $row['name'];
        $value = $row['value'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="editable" id="asset_name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" id="type<?php echo $count; ?>">Fixed Asset</td>
      <td class="editable" id="asset_value<?php echo $count; ?>"><?php echo number_format($value,2); ?></td>
       <td>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteAsset" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button>
       </td>
    </tr>
    <?php
    $totalValue += $value;
    }
   ?>
  </tbody>
</table>       
<br>
<div style="text-align: center;"><b>Total Value of Assets: Ksh. <?php echo number_format($totalValue,2); ?></b></div> 
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 