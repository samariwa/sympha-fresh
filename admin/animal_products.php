<?php
 include "admin_nav.php";
 include('../queries.php');
 $Product_Units = new AnimalProducts();
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Stock</span><span style="font-size: 15px;"> /Animal Products</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
           <?php
           include "dashboard_tabs.php";
          ?>
          <div class="row">
            <div class="col-2">
      <a href="stock.php" class="btn btn-primary btn-md active float-left" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
      <div class="col-7">
      <p style="text-align:center;">Increase / Decrease Animal Product Units from their respective parent units</p>
    </div>
    <div class="col-3">
      <a href="animal_product_units.php" class="btn btn-info btn-md active offset-2" role="button" aria-pressed="true">Animal Product Units</a>
      </div>
    </div><br>
     
    <table id="animalProductEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="8%">#</th>
      <th scope="col" width="18%">Stock Name</th>
      <th scope="col" width="14%">Stock Qty</th>
      <th scope="col"width="18%">Product Unit</th>
      <th scope="col"width="14%">Unit Qty</th>
      <th scope="col"width="23%">Unit Qty Adjustment (+/-)</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($Product_Units->fetchProductUnits() as $unit){
         $count++;
      ?>
    <tr>
      <th class="uneditable" scope="row"  id="id<?php echo $count; ?>"><?php echo $unit['id']; ?></th>
      <td class="uneditable" id="name"><?php echo $unit['Name']; ?></td>
      <td class="uneditable" id="stock_qty"><?php echo $unit['Quantity']; ?></td>
      <td class="uneditable" id="unit"><?php echo $Product_Units->fetchUnitName($unit['id']); ?></td>
      <td class="uneditable" id="unit_qty"><?php echo round($Product_Units->fetchUnitQuantity($unit['id']),2); ?></td>
      <td  class="editable" id="adjustment<?php echo $count; ?>">0</td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>     

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 