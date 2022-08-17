<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Staff Duties</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>
 

        <div class="row">
          <div class="col-4">
             <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true" ><i class="fa fa-plus-circle"></i>&ensp;Add Duty</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Add Duty</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <select type="text" name="dutyCategoryId" id="dutyCategoryId" class="form-control col-10 " style="padding-right:15px;padding-left:15px;margin-left: 40px" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur(); replenishDisable();'>
                  <option value="" selected="selected" disabled>Duty Category...</option>
                  <?php
                    $count = 0;
                    foreach($dutyCategoriesList as $row){
                     $count++;
                    $id = $row['id'];
                    $category = $row['category'];
                  ?>
                   <option id="categoryId" value="<?php echo $id; ?>"><?php echo $category; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div><br>
                  <div class="row">
                    <label for="duty_name" style="margin-left: 60px;">Duty name:</label>
                 <input type="text" name="duty_name" id="duty_name" class="form-control col-9" required  style="padding:15px;margin-left: 60px" >
                  </div><br>
                  <input type="hidden" name="where" id="where"  value="duties">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary float-left ml-3" id="addDuty">Add Duty</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
           <?php
        $dutiesListcount = mysqli_num_rows($dutiesList);
      ?>
      <h6 class="offset-2">Total Number: <?php echo $dutiesListcount; ?></h6>
      </div>
      <div class="col-2">
      <a href="duty_categories.php" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Duty Categories</a>
    </div>
        </div><br>

        <table id="employeeDutiesEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10%">#</th>
      <th scope="col" width="40%">Duty Name</th>
      <th scope="col" width="40%">Duty Category</th>
      <th scope="col"width="40%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($dutiesList as $row){
        $count++;
        $id = $row['id'];
        $duty = $row['duty'];
        $category = $row['category'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $duty; ?></td>
      <td class="uneditable" id="type<?php echo $count; ?>"><?php echo $category; ?></td>
       <td>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteDuty" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button>
       </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 