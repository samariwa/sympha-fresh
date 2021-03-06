<?php
 include "admin_nav.php";
 include('../queries.php');
 $Categories = new Categories();
 ?> 
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Stock</span> <span style="font-size: 15px;">/Categories</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
         <?php
           include "dashboard_tabs.php";
          ?>
         <div class="row">
       <div class="col-4">   
      <a href="stock.php" class="btn btn-primary btn-md active " role="button" aria-pressed="true"><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
      <div class="col-4">   
      <h6 class="offset-3">Total Number: <?php echo $Categories->stockCategoriesCount(); ?></h6>
    </div>
      <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
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
                  <input type="hidden" name="where" id= "where"  value="categories">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addCategory">Add Category</button>
            </form>
            </div>
          </div>
        </div>
      </div>
        <?php
        }
        ?>
     </div>   
    </div><br> 
         <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
      <table id="categoriesEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="30%" style="text-align: left;">#</th>
      <th scope="col" width="60%">Category Name</th>
      <th scope="col"width="80%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($Categories->fetchStockCategories() as $category){
         $count++;
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>" style="text-align: left;"><?php echo $category['id']; ?></th>
      <td class="editable" id="category<?php echo $count; ?>"><?php echo $category['Category_Name']; ?></td>
       <td>
        <button id="<?php echo $category['id']; ?>" data_id="<?php echo $category['id']; ?>" class="btn btn-danger btn-sm active deleteCategory" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>&ensp;Delete</button>
       </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<?php
        }
        else{
        ?>

         <table id="categoriesEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;width: 100%">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="40%">#&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
      <th scope="col" width="60%">Category Name&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($Categories->fetchStockCategories() as $category){
        $count++;
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $category['id']; ?></th>
      <td class="uneditable" id="category<?php echo $count; ?>"><?php echo $category['Category_Name']; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<?php
    }
    ?>
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 