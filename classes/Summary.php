<?php
class Summary extends Database{
    private $_db,
    $sales_stmt,
    $revenue_stmt,
    $mpesa_stmt,
    $cash_stmt,
    $mpesa_debt_stmt,
    $cash_debt_stmt,
    $banked_stmt,
    $expenditure_stmt;

    public function __construct($summary = null)
    {
        $this->_db = Database::getInstance();
        $this->sales_stmt = "select SUM(stock.Price*orders.Quantity) as 'Sales' from orders INNER JOIN stock ON orders.Stock_id=stock.id WHERE DATE(Delivery_time) =";
        $this->revenue_stmt = "select (SUM(orders.Cash)+SUM(orders.MPesa)) as 'Revenue' from orders INNER JOIN stock ON orders.Stock_id=stock.id WHERE DATE(Delivery_time) =";
        $this->mpesa_stmt = "SELECT SUM(MPesa) as 'Mpesa' FROM `orders` WHERE DATE(Delivery_time) =";
        $this->cash_stmt = "SELECT SUM(Cash) as 'Cash' FROM `orders` WHERE DATE(Delivery_time) =";
        $this->mpesa_debt_stmt = "SELECT SUM(MPesa) as 'Mpesa_debt' FROM `orders` WHERE DATE(Updated_at) =";
        $this->cash_debt_stmt = "SELECT SUM(Cash) as 'Cash_debt' FROM `orders` WHERE DATE(`Updated_at`) =";
        $this->banked_stmt = "SELECT SUM(Banked) as 'Banked' FROM `orders` WHERE DATE(Delivery_time) =";
        $this->expenditure_stmt = "SELECT SUM(Paid_amount) as 'paid' FROM `expense_details` WHERE DATE(`Created_at`) =";
    }

    public function salesToday()
    {
        $query = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        return $this->summaryResult($query->fetch()['Sales']);
    }

    public function salesYesterday()
    {

        $query = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Sales']);
    }

    public function sales_day_2()
    {

        $query = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        return $this->summaryResult($query->fetch()['Sales']);
    }

    public function sales_day_3()
    {

        $query = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        return $this->summaryResult($query->fetch()['Sales']);
    }

    public function sales_day_4()
    {

        $query = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        return $this->summaryResult($query->fetch()['Sales']);
    }

    public function sales_day_5()
    {

        $query = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        return $this->summaryResult($query->fetch()['Sales']);
    }

    public function sales_day_6()
    {

        $query = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        return $this->summaryResult($query->fetch()['Sales']);
    }

    public function revenueToday()
    {
        $query = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        return $this->summaryResult($query->fetch()['Revenue']);
    }

    public function revenueYesterday()
    {

        $query = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Revenue']);
    }

    public function revenue_day_2()
    {

        $query = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        return $this->summaryResult($query->fetch()['Revenue']);
    }

    public function revenue_day_3()
    {

        $query = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        return $this->summaryResult($query->fetch()['Revenue']);
    }

    public function revenue_day_4()
    {

        $query = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        return $this->summaryResult($query->fetch()['Revenue']);
    }

    public function revenue_day_5()
    {

        $query = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        return $this->summaryResult($query->fetch()['Revenue']);
    }

    public function revenue_day_6()
    {

        $query = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        return $this->summaryResult($query->fetch()['Revenue']);
    }

    public function mpesaToday()
    {
        $query = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa']);
    }

    public function mpesaYesterday()
    {
        $query = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa']);
    }

    public function mpesa_day_2()
    {
        $query = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa']);
    }
     
    public function mpesa_day_3()
    {
        $query = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa']);
    }

    public function mpesa_day_4()
    {
        $query = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa']);
    }

    public function mpesa_day_5()
    {
        $query = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa']);
    }

    public function mpesa_day_6()
    {
        $query = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa']);
    }

    public function cashToday()
    {
        $query = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        return $this->summaryResult($query->fetch()['Cash']);
    }

    public function cashYesterday()
    {
        $query = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Cash']);
    }

    public function cash_day_2()
    {
        $query = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        return $this->summaryResult($query->fetch()['Cash']);
    }

    public function cash_day_3()
    {
        $query = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        return $this->summaryResult($query->fetch()['Cash']);
    }

    public function cash_day_4()
    {
        $query = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        return $this->summaryResult($query->fetch()['Cash']);
    }

    public function cash_day_5()
    {
        $query = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        return $this->summaryResult($query->fetch()['Cash']);
    }

    public function cash_day_6()
    {
        $query = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        return $this->summaryResult($query->fetch()['Cash']);
    }

    public function mpesaDebtToday()
    {
        $query = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa_debt']);
    }

    public function mpesaDebtYesterday()
    {
        $query = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa_debt']);
    }

    public function mpesaDebt_day_2()
    {
        $query = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa_debt']);
    }

    public function mpesaDebt_day_3()
    {
        $query = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa_debt']);
    }

    public function mpesaDebt_day_4()
    {
        $query = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa_debt']);
    }

    public function mpesaDebt_day_5()
    {
        $query = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa_debt']);
    }

    public function mpesaDebt_day_6()
    {
        $query = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Mpesa_debt']);
    }
    
    public function cashDebtToday()
    {
        $query = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        return $this->summaryResult($query->fetch()['Cash_debt']);
    }

    public function cashDebtYesterday()
    {
        $query = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Cash_debt']);
    }

    public function cashDebt_day_2()
    {
        $query = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Cash_debt']);
    }

    public function cashDebt_day_3()
    {
        $query = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Cash_debt']);
    }

    public function cashDebt_day_4()
    {
        $query = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Cash_debt']);
    }

    public function cashDebt_day_5()
    {
        $query = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Cash_debt']);
    }

    public function cashDebt_day_6()
    {
        $query = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )AND DATE(Delivery_time) < DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Cash_debt']);
    }
    

    public function bankedToday()
    {
        $query = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        return $this->summaryResult($query->fetch()['Banked']);
    }

    public function bankedYesterday()
    {
        $query = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['Banked']);
    }

    public function banked_day_2()
    {
        $query = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        return $this->summaryResult($query->fetch()['Banked']);
    }

    public function banked_day_3()
    {
        $query = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        return $this->summaryResult($query->fetch()['Banked']);
    }

    public function banked_day_4()
    {
        $query = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        return $this->summaryResult($query->fetch()['Banked']);
    }

    public function banked_day_5()
    {
        $query = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        return $this->summaryResult($query->fetch()['Banked']);
    }

    public function banked_day_6()
    {
        $query = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        return $this->summaryResult($query->fetch()['Banked']);
    }

    public function expenditureToday()
    {
        $query = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        return $this->summaryResult($query->fetch()['paid']);
    }

    public function expenditureYesterday()
    {
        $query = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        return $this->summaryResult($query->fetch()['paid']);
    }

    public function expenditure_day_2()
    {
        $query = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        return $this->summaryResult($query->fetch()['paid']);
    }

    public function expenditure_day_3()
    {
        $query = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        return $this->summaryResult($query->fetch()['paid']);
    }

    public function expenditure_day_4()
    {
        $query = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        return $this->summaryResult($query->fetch()['paid']);
    }

    public function expenditure_day_5()
    {
        $query = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        return $this->summaryResult($query->fetch()['paid']);
    }

    public function expenditure_day_6()
    {
        $query = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        return $this->summaryResult($query->fetch()['paid']);
    }

    public function summaryResult($val)
    {
        $result = "";
        if ($val > 0) {
            $result = "Ksh. ".number_format($val,2);
        }
        else{
            $result = "Ksh. 0.00";
        }
        return $result;
    }
}    