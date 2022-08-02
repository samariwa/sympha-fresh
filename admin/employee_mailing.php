<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Employee Mailing List</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

          <?php
           include "dashboard_tabs.php";
          ?>
 

        <div class="row">
          <div class="col-4">
             <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true" ><i class="fa fa-plus-circle"></i>&ensp;Add To List</a>
       <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Add To List</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                 <div class="row">
                 <select type="text" name="userId" id="userId" class="form-control col-10 " style="padding-right:15px;padding-left:15px;margin-left: 40px" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur(); replenishDisable();'>
                  <option value="" selected="selected" disabled>Employee Name...</option>
                  <?php
                    $count = 0;
                    foreach($adminList as $row){
                     $count++;
                    $id = $row['id'];
                    $name = $row['firstname'].' '.$row['lastname'];
                  ?>
                   <option id="userId" value="<?php echo $id; ?>"><?php echo $name; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                  </div>
                  <input type="hidden" name="where" id="where"  value="employee_mailing">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary float-left ml-3" id="addToMailing">Add Employee</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-8">
           <?php
        $mailinglistrowcount = mysqli_num_rows($employeeMailingList);
      ?>
      <h6 class="offset-2">Total Number: <?php echo $mailinglistrowcount; ?></h6>
      </div>
        </div><br>

        <table id="employeeMailingEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10%">#</th>
      <th scope="col" width="25%">Employee Name</th>
      <th scope="col" width="25%">Email Address</th>
      <th scope="col" width="25%">Mail Type</th>
      <th scope="col"width="20%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($employeeMailingList as $row){
        $count++;
        $id = $row['id'];
        $name = $row['firstname'].' '.$row['lastname'];
        $email = $row['email'];
        $mail_type = $row['mail_type'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="uneditable" id="contact<?php echo $count; ?>"><?php echo $email; ?></td>
      <td class="uneditable" id="type<?php echo $count; ?>"><span class="badge badge-pill badge-info"><?php echo $mail_type; ?></span></td>
       <td>
        <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteMailingList" role="button" aria-pressed="true" ><i class="fa fa-user-times"></i>&ensp;Revoke</button>
       </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 