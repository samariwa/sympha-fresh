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
    $expenditure_stmt,
    $weekly_delivery_speed_stmt,
    $weekly_delivery_count_stmt;

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
        $this->expenditure_stmt = "SELECT SUM(Paid_amount) as 'paid' FROM `expense_details` WHERE DATE(`Payment_date`) =";
        $this->weekly_delivery_speed_stmt = "SELECT COALESCE(AVG(delivery_time_left),0) AS 'avg' FROM order_status INNER JOIN orders ON order_status.Order_id = orders.Order_id  where DATE(orders.`Delivery_time`) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) && DATE(orders.`Delivery_time`) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )";
        $this->weekly_delivery_count_stmt = "SELECT count(distinct order_id) as num from order_status where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) && DATE(Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )";
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
    
    public function sales_weekly_avg()
    {
        $today = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        $day_1 = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        $day_2 = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        $day_3 = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        $day_4 = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        $day_5 = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        $day_6 = $this->connect()->query($this->sales_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        $avg_sales = (floatval($today->fetch()['Sales']) + floatval($day_1->fetch()['Sales'])  + floatval($day_2->fetch()['Sales'])  + floatval($day_3->fetch()['Sales'])  + floatval($day_4->fetch()['Sales'])  + floatval($day_5->fetch()['Sales'])  + floatval($day_6->fetch()['Sales']))/7;
        return $this->summaryResult($avg_sales);
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

    public function revenue_weekly_avg()
    {
        $today = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        $day_1 = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        $day_2 = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        $day_3 = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        $day_4 = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        $day_5 = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        $day_6 = $this->connect()->query($this->revenue_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        $avg_revenue = (floatval($today->fetch()['Revenue']) + floatval($day_1->fetch()['Revenue'])  + floatval($day_2->fetch()['Revenue'])  + floatval($day_3->fetch()['Revenue'])  + floatval($day_4->fetch()['Revenue'])  + floatval($day_5->fetch()['Revenue'])  + floatval($day_6->fetch()['Revenue']))/7;
        return $this->summaryResult($avg_revenue);
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

    public function mpesa_weekly_avg()
    {
        $today = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        $day_1 = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        $day_2 = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        $day_3 = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        $day_4 = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        $day_5 = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        $day_6 = $this->connect()->query($this->mpesa_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        $avg_mpesa = (floatval($today->fetch()['Mpesa']) + floatval($day_1->fetch()['Mpesa'])  + floatval($day_2->fetch()['Mpesa'])  + floatval($day_3->fetch()['Mpesa'])  + floatval($day_4->fetch()['Mpesa'])  + floatval($day_5->fetch()['Mpesa'])  + floatval($day_6->fetch()['Mpesa']))/7;
        return $this->summaryResult($avg_mpesa);
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

    public function cash_weekly_avg()
    {
        $today = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        $day_1 = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        $day_2 = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        $day_3 = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        $day_4 = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        $day_5 = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        $day_6 = $this->connect()->query($this->cash_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        $avg_cash = (floatval($today->fetch()['Cash']) + floatval($day_1->fetch()['Cash'])  + floatval($day_2->fetch()['Cash'])  + floatval($day_3->fetch()['Cash'])  + floatval($day_4->fetch()['Cash'])  + floatval($day_5->fetch()['Cash'])  + floatval($day_6->fetch()['Cash']))/7;
        return $this->summaryResult($avg_cash);
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

    public function mpesaDebt_weekly_avg()
    {
        $today = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        $day_1 = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        $day_2 = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        $day_3 = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        $day_4 = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        $day_5 = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        $day_6 = $this->connect()->query($this->mpesa_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        $avg_mpesa_debt = (floatval($today->fetch()['Mpesa_debt']) + floatval($day_1->fetch()['Mpesa_debt'])  + floatval($day_2->fetch()['Mpesa_debt'])  + floatval($day_3->fetch()['Mpesa_debt'])  + floatval($day_4->fetch()['Mpesa_debt'])  + floatval($day_5->fetch()['Mpesa_debt']) + floatval($day_6->fetch()['Mpesa_debt']))/7;
        return $this->summaryResult($avg_mpesa_debt);
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
    
    public function cashDebt_weekly_avg()
    {
        $today = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        $day_1 = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        $day_2 = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        $day_3 = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        $day_4 = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        $day_5 = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        $day_6 = $this->connect()->query($this->cash_debt_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        $avg_cash_debt = (floatval($today->fetch()['Cash_debt']) + floatval($day_1->fetch()['Cash_debt'])  + floatval($day_2->fetch()['Cash_debt'])  + floatval($day_3->fetch()['Cash_debt'])  + floatval($day_4->fetch()['Cash_debt'])  + floatval($day_5->fetch()['Cash_debt'])  + floatval($day_6->fetch()['Cash_debt']))/7;
        return $this->summaryResult($avg_cash_debt);
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

    public function banked_weekly_avg()
    {
        $today = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        $day_1 = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        $day_2 = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        $day_3 = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        $day_4 = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        $day_5 = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        $day_6 = $this->connect()->query($this->banked_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        $avg_banked = (floatval($today->fetch()['Banked']) + floatval($day_1->fetch()['Banked'])  + floatval($day_2->fetch()['Banked'])  + floatval($day_3->fetch()['Banked'])  + floatval($day_4->fetch()['Banked'])  + floatval($day_5->fetch()['Banked'])  + floatval($day_6->fetch()['Banked']))/7;
        return $this->summaryResult($avg_banked);
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

    public function expenditure_weekly_avg()
    {
        $today = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 0 DAY )");
        $day_1 = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY )");
        $day_2 = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 2 DAY )");
        $day_3 = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 3 DAY )");
        $day_4 = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 4 DAY )");
        $day_5 = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 5 DAY )");
        $day_6 = $this->connect()->query($this->expenditure_stmt." DATE_SUB( CURDATE(), INTERVAL 6 DAY )");
        $avg_expenditure = (floatval($today->fetch()['paid']) + floatval($day_1->fetch()['paid'])  + floatval($day_2->fetch()['paid'])  + floatval($day_3->fetch()['paid'])  + floatval($day_4->fetch()['paid'])  + floatval($day_5->fetch()['paid'])  + floatval($day_6->fetch()['paid']))/7;
        return $this->summaryResult($avg_expenditure);
    }

    public function delivery_speed_weekly_avg()
    {
        $query = $this->connect()->query($this->weekly_delivery_speed_stmt);
        return (int)($query->fetch()['avg']);
    }

    public function delivery_count_weekly_avg()
    {
        $query = $this->connect()->query($this->weekly_delivery_count_stmt);
        return (int)(($query->fetch()['num'])/7);
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




