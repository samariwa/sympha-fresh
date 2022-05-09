<?php
 include "admin_nav.php";
 include('../queries.php');
 $Product_Units = new AnimalProducts();
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Stock</span><span style="font-size: 15px;"> /Animal Product Units</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
           <?php
           include "dashboard_tabs.php";
          ?>
          <div class="row">
            <div class="col-2">
      <a href="animal_products.php" class="btn btn-primary btn-md active float-left" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
      <div class="col-7">
      <h6 class="offset-5">Total Number: <?php echo $Product_Units->productUnitsCount(); ?></h6>
    </div>
    <div class="col-3">   
      <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active offset-6" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;Add Unit</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Add Animal Product Unit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
              <div class="row">
                 <select type="text" name="parent_unit" id="parent_unit" class="form-control col-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <option value="" selected="selected" disabled>Parent Unit...</option>
                  <?php
                    $count = 0;
                    foreach($stockList as $row){
                     $count++;
                     $id = $row['id'];
                     $name = $row['Name'];
                  ?>
                   <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                  <div class="row">
                 <select type="text" name="child_unit" id="child_unit" class="form-control col-9" style="padding-right:15px;padding-left:15px;margin-left: 60px" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                  <option value="" selected="selected" disabled>Child Unit...</option>
                  <?php
                    $count = 0;
                    foreach($stockList as $row){
                     $count++;
                     $id = $row['id'];
                     $name = $row['Name'];
                  ?>
                   <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                  <input type="hidden" name="where" id= "where"  value="animal_product_units">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addAnimalProductUnit">Add Unit</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div><br><br><br>
     
     <table id="animalProductUnitsEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="9%">#</th>
      <th scope="col" width="18%">Stock Name</th>
      <th scope="col"width="18%">Product Unit</th>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {
        ?>
      <th scope="col"width="18%"></th>
       <?php
      }
      ?>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($Product_Units->fetchProductUnits() as $unit){
         $count++;
      ?>
    <tr>
      <th class="uneditable" scope="row"  id="id"><?php echo $unit['id']; ?></th>
      <td class="uneditable" id="name"><?php echo $unit['Name']; ?></td>
      <td class="uneditable" id="unit"><?php echo $Product_Units->fetchUnitName($unit['id']); ?></td>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
      <td>
        <button id="<?php echo $unit['id']; ?>" data_id="<?php echo $unit['id']; ?>" class="btn btn-danger btn-sm active deleteAnimalProductUnit" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button>
       </td>
       <?php
      }
      ?>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>   

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 