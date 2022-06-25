<?php
 include "admin_nav.php";
 $Summary = new Summary();
 ?> 

 <!-- Begin Page Content -->
        <div class="container-fluid"> 

  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Summary</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

         <?php
           include "dashboard_tabs.php";
          ?>

          <br>
        <?php 
        $today = date( 'l, F d, Y', strtotime("today"));
        $yesterday = date( 'l, F d, Y', strtotime("yesterday"));
        ?>
        <div class="row"><h3>Summary for Today (<?php echo $today; ?>)</h3> </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Sales Value</h3>
            <p class="lead"><?php echo $Summary->salesToday(); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Revenue Realized</h3>
            <p class="lead"><?php echo $Summary->revenueToday(); ?></p>
        </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Paid via M-Pesa</h3>
            <p class="lead"><?php echo $Summary->mpesaToday(); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Total Paid in Cash</h3>
            <p class="lead"><?php echo $Summary->cashToday(); ?></p>
        </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Banked</h3>
            <p class="lead"><?php echo $Summary->bankedToday(); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Expenditure</h3>
            <p class="lead"><?php echo $Summary->expenditureToday(); ?></p>
        </div>
        </div>
        <div class="row"><h3>Summary for Yesterday (<?php echo $yesterday; ?>)</h3> </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Sales Value</h3>
            <p class="lead"><?php echo $Summary->salesYesterday(); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Revenue Realized</h3>
            <p class="lead"><?php echo $Summary->revenueYesterday(); ?></p>
        </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Paid via M-Pesa</h3>
            <p class="lead"><?php echo $Summary->mpesaYesterday(); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Total Paid in Cash</h3>
            <p class="lead"><?php echo $Summary->cashYesterday(); ?></p>
        </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Banked</h3>
            <p class="lead"><?php echo $Summary->bankedYesterday(); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Expenditure</h3>
            <p class="lead"><?php echo $Summary->expenditureYesterday(); ?></p>
        </div>
        </div>
        
        

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 
         