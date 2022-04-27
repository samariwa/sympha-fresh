<?php
 include "admin_nav.php";
 include('../queries.php');
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
        $row = mysqli_fetch_array($salesYesterday);
        if ($row['Sales_yesterday'] > "0") {
          $salesYesterday = $row['Sales_yesterday'];
        }
        else{
          $salesYesterday = "0.00";
        }
        $totalSalesYesterday = $salesYesterday;
        if ($totalSalesYesterday > 0) {
          $totalSalesYesterday = $totalSalesYesterday;
        }
        else{
          $totalSalesYesterday = "0.00";
        }
        $row2 = mysqli_fetch_array($revenueYesterday);
        if ($row2['Revenue_yesterday'] > "0") {
        $revenueYesterday = $row2['Revenue_yesterday'];
         }
        else{
          $revenueYesterday = 0;
        }
        $totalRevenueYesterday = $revenueYesterday;
        if ($totalRevenueYesterday > 0) {
          $totalRevenueYesterday = $totalRevenueYesterday;
        }
        else{
          $totalRevenueYesterday = "0.00";
        }
        $row4 = mysqli_fetch_array($mpesaYesterday);
         if ($row4['Mpesa_yesterday'] > "0") {
        $mpesaYesterday = $row4['Mpesa_yesterday'];
        }
         else{
          $mpesaYesterday = 0;
        }
        $totalMpesaYesterday = $mpesaYesterday;
        if ($totalMpesaYesterday > 0) {
          $totalMpesaYesterday = $totalMpesaYesterday;
        }
        else{
          $totalMpesaYesterday = "0.00";
        }
        $row6 = mysqli_fetch_array($cashYesterday);
        if ($row6['Cash_yesterday'] > "0") {
        $cashYesterday = $row6['Cash_yesterday'];
         }
        else{
          $cashYesterday = 0;
        }
        $totalCashYesterday = $cashYesterday;
        if ($totalCashYesterday > 0) {
          $totalCashYesterday = $totalCashYesterday;
        }
        else{
          $totalCashYesterday = "0.00";
        }
        $row8 = mysqli_fetch_array($mpesaDebt);
        if ( $row8['Mpesa_debt'] > "0") {
       $mpesaDebt = $row8['Mpesa_debt']; 
         }
        else{
          $mpesaDebt = 0;
        }
        $totalMpesaDebt = $mpesaDebt;
        if ($totalMpesaDebt > 0) {
          $totalMpesaDebt = $totalMpesaDebt;
        }
        else{
          $totalMpesaDebt = "0.00";
        }
        $row10 = mysqli_fetch_array($cashDebt);
         if ( $row10['Cash_debt'] > "0") {
        $cashDebt = $row10['Cash_debt'];
         }
        else{
          $cashDebt = 0;
        }
        $totalCashDebt = $cashDebt;
        if ($totalCashDebt > 0) {
          $totalCashDebt = $totalCashDebt;
        }
        else{
          $totalCashDebt = "0.00";
        }
        $row12 = mysqli_fetch_array($bankedYesterday);
        if ( $row12['Banked_yesterday'] > "0") {
        $bankedYesterday = $row12['Banked_yesterday'];
        }
        else{
          $bankedYesterday = 0;
        }
        $totalBankedYesterday = $bankedYesterday;
        if ($totalBankedYesterday > 0) {
          $totalBankedYesterday = $totalBankedYesterday;
        }
        else{
          $totalBankedYesterday = "0.00";
        }
         $row14 = mysqli_fetch_array($expenditureYesterday);
        if ( $row14['paid'] > "0") {
        $expenditureYesterday = $row14['paid'];
        }
        else{
          $expenditureYesterday = "0.00";
        }



       $row15 = mysqli_fetch_array($salesToday);
        if ($row15['Sales_today'] > "0") {
          $salesToday = $row15['Sales_today'];
        }
        else{
          $salesToday = "0.00";
        }
        $totalSalesToday = $salesToday;
        if ($totalSalesToday > 0) {
          $totalSalesToday = $totalSalesToday;
        }
        else{
          $totalSalesToday = "0.00";
        }
         $row16 = mysqli_fetch_array($revenueToday);
        if ($row16['Revenue_today'] > "0") {
        $revenueToday = $row16['Revenue_today'];
         }
        else{
          $revenueToday = 0;
        }
        $totalRevenueToday = $revenueToday;
        if ($totalRevenueToday > 0) {
          $totalRevenueToday = $totalRevenueToday;
        }
        else{
          $totalRevenueToday = "0.00";
        }
        $row17 = mysqli_fetch_array($mpesaToday);
         if ($row17['Mpesa_today'] > "0") {
        $mpesaToday = $row17['Mpesa_today'];
        }
         else{
          $mpesaToday = 0;
        }
        $totalMpesaToday = $mpesaToday;
        if ($totalMpesaToday > 0) {
          $totalMpesaToday = $totalMpesaToday;
        }
        else{
          $totalMpesaToday = "0.00";
        }
        $row18 = mysqli_fetch_array($cashToday);
        if ($row18['Cash_today'] > "0") {
        $cashToday = $row18['Cash_today'];
         }
        else{
          $cashToday = 0;
        }
        $totalCashToday = $cashToday;
        if ($totalCashToday > 0) {
          $totalCashToday = $totalCashToday;
        }
        else{
          $totalCashToday = "0.00";
        }
        $row19 = mysqli_fetch_array($mpesaDebtToday);
        if ( $row19['Mpesa_debt_today'] > "0") {
       $mpesaDebtToday = $row19['Mpesa_debt_today']; 
         }
        else{
          $mpesaDebtToday = 0;
        }
        $totalMpesaDebtToday = $mpesaDebtToday;
        if ($totalMpesaDebtToday > 0) {
          $totalMpesaDebtToday = $totalMpesaDebtToday;
        }
        else{
          $totalMpesaDebtToday = "0.00";
        }
        $row20 = mysqli_fetch_array($cashDebtToday);
         if ( $row20['Cash_debt_today'] > "0") {
        $cashDebtToday = $row20['Cash_debt_today'];
         }
        else{
          $cashDebtToday = 0;
        }
        $totalCashDebtToday = $cashDebtToday;
        if ($totalCashDebtToday > 0) {
          $totalCashDebtToday = $totalCashDebtToday;
        }
        else{
          $totalCashDebtToday = "0.00";
        }
        $row21 = mysqli_fetch_array($bankedToday);
        if ( $row21['Banked_today'] > "0") {
        $bankedToday = $row21['Banked_today'];
        }
        else{
          $bankedToday = 0;
        }
        $totalBankedToday = $bankedToday;
        if ($totalBankedToday > 0) {
          $totalBankedToday = $totalBankedToday;
        }
        else{
          $totalBankedToday = "0.00";
        }
         $row22 = mysqli_fetch_array($expenditureToday);
        if ( $row22['paid_today'] > "0") {
        $expenditureToday = $row22['paid_today'];
        }
        else{
          $expenditureToday = "0.00";
        }
        ?>
        <div class="row"><h3>Summary for Today (<?php echo $today; ?>)</h3> </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Sales Value</h3>
            <p class="lead">Ksh. <?php echo number_format($totalSalesToday); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Revenue Realized</h3>
            <p class="lead">Ksh. <?php echo number_format($totalRevenueToday); ?></p>
        </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Paid via M-Pesa</h3>
            <p class="lead">Ksh. <?php echo number_format($totalMpesaToday); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Total Paid in Cash</h3>
            <p class="lead">Ksh. <?php echo number_format($totalCashToday); ?></p>
        </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Banked</h3>
            <p class="lead">Ksh. <?php echo number_format($totalBankedToday); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Expenditure</h3>
            <p class="lead">Ksh. <?php echo number_format($expenditureToday); ?></p>
        </div>
        </div>
        <div class="row"><h3>Summary for Yesterday (<?php echo $yesterday; ?>)</h3> </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Sales Value</h3>
            <p class="lead">Ksh. <?php echo number_format($totalSalesYesterday); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Revenue Realized</h3>
            <p class="lead">Ksh. <?php echo number_format($totalRevenueYesterday); ?></p>
        </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Paid via M-Pesa</h3>
            <p class="lead">Ksh. <?php echo number_format($totalMpesaYesterday); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Total Paid in Cash</h3>
            <p class="lead">Ksh. <?php echo number_format($totalCashYesterday); ?></p>
        </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="jumbotron">
            <h3 class="display-10">Total Banked</h3>
            <p class="lead">Ksh. <?php echo number_format($totalBankedYesterday); ?></p>
          </div>
        </div>
        <div class="col-6">
        <div class="jumbotron">
            <h3 class="display-10">Expenditure</h3>
            <p class="lead">Ksh. <?php echo number_format($expenditureYesterday); ?></p>
        </div>
        </div>
        
        

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 
         