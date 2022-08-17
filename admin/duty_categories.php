<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Duty Categories</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>
 

        <div class="row">
        <div class="col-2">  
              <a href="duties.php" class="btn btn-primary btn-md active float-left ml-3" role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
         </div>
         <div class="col-6">
           <?php
        $dutyCategoriesCount = mysqli_num_rows($dutyCategoriesList);
      ?>
      <h6 class="offset-6">Total Number: <?php echo $dutyCategoriesCount; ?></h6>
      </div>
        <div class="col-4">   
      <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active offset-6" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;Add Category</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Add Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <input type="text" name="category" id="category" class="form-control col-9" style="padding:15px;margin-left: 60px" placeholder="Category Name..." required>
                  </div>
                  <input type="hidden" name="where" id= "where"  value="duty_categories">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addDutyCategory">Add Category</button>
            </form>
            </div>
          </div>
        </div>
      </div>
        </div><br><br><br>

        <table id="employeeMailingEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="30%">#</th>
      <th scope="col" width="60%">Duty Category</th>
      <th scope="col"width="80%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($dutyCategoriesList as $row){
        $count++;
        $id = $row['id'];
        $category = $row['category'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $category; ?></td>
       <td>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteDutyCategory" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button>
       </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 