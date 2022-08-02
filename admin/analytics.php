<?php
 include "admin_nav.php";
 include('../queries.php');
 require('config.php');
 $Summary = new Summary();
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Analytics</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

           <?php
       include "dashboard_tabs.php";

        ?>
 
<br>
<h4>Stock Flow</h4>
<div class="row offset-4"> <h6>Stock flow records shown are for as at now.</h6></div> 
    <?php
     $yesterday1 = date('d/m/Y',strtotime('-2 day'));
     $yesterday2 = date('d/m/Y',strtotime('-3 day'));
     $yesterday3 = date('d/m/Y',strtotime('-4 day'));
     $yesterday4 = date('d/m/Y',strtotime('-5 day'));
     $yesterday5 = date('d/m/Y',strtotime('-6 day'));
    ?>
    <table  class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Brand Name</th>
      <th scope="col" width="10%"><?php echo $yesterday3; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday2; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday1; ?></th>
      <th scope="col"width="10%">Yesterday</th>
      <th scope="col"width="10%">Today</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($stockFlowQuery as $row){
         $count++;
         $id = $row['sid'];
         $name = $row['sname'];
        $sum1 = $row['sum1'];
        $sum2 = $row['sum2'];
        $sum3 = $row['sum3'];
        $sum4 = $row['sum4'];
        $sum5 = $row['sum5'];
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $name; ?></td>
      <td ><?php echo round($sum1,2); ?></td>
      <td ><?php echo round($sum2,2); ?></td>
      <td ><?php echo round($sum3,2); ?></td>
      <td ><?php echo round($sum4,2); ?></td>
      <td ><?php echo round($sum5,2); ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<table  class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Brand Name</th>
      <th scope="col"width="10%">Opening Stock (Today)</th>
      <th scope="col"width="10%">Quantity (Now)</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($openingClosingQuery as $row){
         $count++;
         $id = $row['sid'];
         $name = $row['sname'];
        $opening = $row['Opening_stock'];
        $closing = $row['Quantity'];
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $name; ?></td>
      <td ><?php echo $opening; ?></td>
      <td ><?php echo $closing; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<div class="row">
<h4>Home Delivery Speed (Minutes)</h4>
</div>
<div class="row">
<table  class="table table-striped table-hover" style="text-align: center;">
  <thead class="thead-dark">
    <tr>
    <th scope="col" width="10%"><?php echo $yesterday3; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday2; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday1; ?></th>
      <th scope="col"width="10%">Yesterday</th>
      <th scope="col"width="10%">Today</th>
    </tr>
  </thead>
  <tbody >
    <?php
         $row = mysqli_fetch_array($delivery_speed_today);
         $speed_today = $delivery_time_limit - $row['avg'];
         $row2 = mysqli_fetch_array($delivery_speed_yesterday);
         $speed_yesterday = $delivery_time_limit - $row2['avg'];
         $row3 = mysqli_fetch_array($delivery_speed_two_days_ago);
         $speed_two_days_ago = $delivery_time_limit - $row3['avg'];
         $row4 = mysqli_fetch_array($delivery_speed_three_days_ago);
         $speed_three_days_ago = $delivery_time_limit - $row4['avg'];
         $row5 = mysqli_fetch_array($delivery_speed_four_days_ago);
         $speed_four_days_ago = $delivery_time_limit - $row5['avg'];
      ?>
    <tr>
      <td ><?php echo round($speed_four_days_ago,2); ?></td>
      <td ><?php echo round($speed_three_days_ago,2); ?></td>
      <td ><?php echo round($speed_two_days_ago,2); ?></td>
      <td ><?php echo round($speed_yesterday,2); ?></td>
      <th scope="row"><?php echo round($speed_today,2); ?></th>
    </tr>
  </tbody>
</table>
</div>
<br>
<?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
        <div class="row">
<h4>Week's Summary</h4>
</div>
<div class="row">
<table  class="table table-striped table-hover" style="text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="10%"></th>
      <th scope="col" width="10%"><?php echo $yesterday5; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday4; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday3; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday2; ?></th>
      <th scope="col" width="10%"><?php echo $yesterday1; ?></th>
      <th scope="col"width="10%">Yesterday</th>
      <th scope="col"width="10%">Today</th>
    </tr>
  </thead>
  <tbody >
    <tr>
      <th>Sales Value</th>
      <td ><?php echo $Summary->sales_day_6(); ?></td>
      <td ><?php echo $Summary->sales_day_5(); ?></td>
      <td ><?php echo $Summary->sales_day_4(); ?></td>
      <td ><?php echo $Summary->sales_day_3(); ?></td>
      <td ><?php echo $Summary->sales_day_2(); ?></td>
      <td ><?php echo $Summary->salesYesterday(); ?></td>
      <th scope="row"><?php echo $Summary->salesToday(); ?></th>
    </tr>
    <tr>
      <th>Revenue Realized</th>
      <td ><?php echo $Summary->revenue_day_6(); ?></td>
      <td ><?php echo $Summary->revenue_day_5(); ?></td>
      <td ><?php echo $Summary->revenue_day_4(); ?></td>
      <td ><?php echo $Summary->revenue_day_3(); ?></td>
      <td ><?php echo $Summary->revenue_day_2(); ?></td>
      <td ><?php echo $Summary->revenueYesterday(); ?></td>
      <th scope="row"><?php echo $Summary->revenueToday(); ?></th>
    </tr>
    <tr>
      <th>Paid in M-Pesa</th>
      <td ><?php echo $Summary->mpesa_day_6(); ?></td>
      <td ><?php echo $Summary->mpesa_day_5(); ?></td>
      <td ><?php echo $Summary->mpesa_day_4(); ?></td>
      <td ><?php echo $Summary->mpesa_day_3(); ?></td>
      <td ><?php echo $Summary->mpesa_day_2(); ?></td>
      <td ><?php echo $Summary->mpesaYesterday(); ?></td>
      <th scope="row"><?php echo $Summary->mpesaToday(); ?></th>
    </tr>
    <tr>
      <th>Paid in Cash</th>
      <td ><?php echo $Summary->cash_day_6(); ?></td>
      <td ><?php echo $Summary->cash_day_5(); ?></td>
      <td ><?php echo $Summary->cash_day_4(); ?></td>
      <td ><?php echo $Summary->cash_day_3(); ?></td>
      <td ><?php echo $Summary->cash_day_2(); ?></td>
      <td ><?php echo $Summary->cashYesterday(); ?></td>
      <th scope="row"><?php echo $Summary->cashToday(); ?></th>
    </tr>
    <tr>
      <th>Banked</th>
      <td ><?php echo $Summary->banked_day_6(); ?></td>
      <td ><?php echo $Summary->banked_day_5(); ?></td>
      <td ><?php echo $Summary->banked_day_4(); ?></td>
      <td ><?php echo $Summary->banked_day_3(); ?></td>
      <td ><?php echo $Summary->banked_day_2(); ?></td>
      <td ><?php echo $Summary->bankedYesterday(); ?></td>
      <th scope="row"><?php echo $Summary->bankedToday(); ?></th>
    </tr>
    <tr>
      <th>Expenditure</th>
      <td ><?php echo $Summary->expenditure_day_6(); ?></td>
      <td ><?php echo $Summary->expenditure_day_5(); ?></td>
      <td ><?php echo $Summary->expenditure_day_4(); ?></td>
      <td ><?php echo $Summary->expenditure_day_3(); ?></td>
      <td ><?php echo $Summary->expenditure_day_2(); ?></td>
      <td ><?php echo $Summary->expenditureYesterday(); ?></td>
      <th scope="row"><?php echo $Summary->expenditureToday(); ?></th>
    </tr>
  </tbody>
</table>
</div>
<br>
<div class="row">
<h4>Week's Average</h4>
<div class="col-lg-3 mb-4" style="margin-left: -7px;">   
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-success">Daily Sales</h6>    
        </div>
        <!-- Card Body -->
    <div class="card-body" style="height: 80px;">
      <p style="text-align: center;font-size: 22px"><?php echo $Summary->sales_weekly_avg(); ?></p>
    </div>
 </div>
 </div>
 <div class="col-lg-3 mb-4" style="margin-left: -7px;">   
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-success">Daily Revenue</h6>    
        </div>
        <!-- Card Body -->
    <div class="card-body" style="height: 80px;">
      <p style="text-align: center;font-size: 22px"><?php echo $Summary->revenue_weekly_avg(); ?></p>
    </div>
 </div>
 </div>
<div class="col-lg-3 mb-4" style="margin-left: -7px;">   
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-success">Daily M-Pesa Payment</h6>    
        </div>
        <!-- Card Body -->
    <div class="card-body" style="height: 80px;">
      <p style="text-align: center;font-size: 22px"><?php echo $Summary->mpesa_weekly_avg(); ?></p>
    </div>
 </div>
 </div>
 <div class="col-lg-3 mb-4" style="margin-left: -7px;">   
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-success">Daily Cash Payment</h6>    
        </div>
        <!-- Card Body -->
    <div class="card-body" style="height: 80px;">
      <p style="text-align: center;font-size: 22px"><?php echo $Summary->cash_weekly_avg(); ?></p>
    </div>
 </div>
 </div>
 <div class="col-lg-3 mb-4" style="margin-left: -7px;">   
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-success">Daily Banked</h6>    
        </div>
        <!-- Card Body -->
    <div class="card-body" style="height: 80px;">
      <p style="text-align: center;font-size: 22px"><?php echo $Summary->banked_weekly_avg(); ?></p>
    </div>
 </div>
 </div>
 <div class="col-lg-3 mb-4" style="margin-left: -7px;">   
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-success">Daily Expenditure</h6>    
        </div>
        <!-- Card Body -->
    <div class="card-body" style=" height: 80px;">
      <p style="text-align: center;font-size: 22px"><?php echo $Summary->expenditure_weekly_avg(); ?></p>
    </div>
 </div>
 </div>
 <div class="col-lg-3 mb-4" style="margin-left: -7px;">   
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-success">Daily No. of Deliveries</h6>    
        </div>
        <!-- Card Body -->
    <div class="card-body" style=" height: 80px;">
      <p style="text-align: center;font-size: 22px"><?php echo $Summary->delivery_count_weekly_avg(); ?></p>
    </div>
 </div>
 </div>
 <div class="col-lg-3 mb-4" style="margin-left: -7px;">   
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-success">Daily Delivery Speed</h6>    
        </div>
        <!-- Card Body -->
    <div class="card-body" style=" height: 80px;">
      <p style="text-align: center;font-size: 22px"><?php echo $Summary->delivery_speed_weekly_avg().' '."minutes"; ?></p>
    </div>
 </div>
 </div>
</div>
<div class="row">
  <div class="col-6">
    <h4>Product Sales Comparison</h4>
  </div>
  <div class="col-6">
    <h4>Expenditure</h4>
  </div>
</div>
<div class="row">
  <div id="piechart2" style="width: 420px; height: 400px;"></div>   
<div id="barchart_values" style="width: 500px; height: 400px;"></div>
</div>
<br>
<div class="row">
  <div class="col-6">
    <h4>Key Customers</h4>
  </div>
  <div class="col-6">
    <h4>Company Performance</h4>
  </div>
</div>
<div class="row">
    <div id="keyCutomersChart" style="width: 430px; height: 400px;"></div>
    <div id="chart_divide" style="width: 600px; height: 400px;"></div>    
</div>  
<br>
<div class="row">
  <div class="col-6">
    <h4>Customer Type Comparison</h4>
  </div>
 <div id="customerTypeChart" style="width: 1100px; height: 500px"></div>
</div>
<br>
<div class="row">
  <div class="col-6">
    <h4>Payment Mode</h4>
  </div>
 <div id="paymentModeChart" style="width: 1100px; height: 500px"></div>
</div>
<br>
<div class="row">
  <div class="col-6">
    <h4>Sales Performance</h4>
  </div>
 <div id="curve_chart" style="width: 1100px; height: 500px"></div>
</div>
<br>
<div class="row">
  <div class="col-6">
    <h4>Profit / Loss</h4>
  </div>
</div>
<div class="row">
    <div id="profitchart" style="width: 1200px; height: 600px;"></div>   
</div>  
<?php
       }
       ?>  
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 