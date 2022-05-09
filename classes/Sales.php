<?php
class Sales extends Database{
    private $_db,
    $sales_stmt;

    public function __construct($sales = null)
    {
        $this->_db = Database::getInstance();
        $this->$sales_stmt = "SELECT orders.id AS id, orders.Order_id AS order_id,customers.Name AS Name,orders.Customer_type as type,orders.Walk_in_name as new_name, Number,stock.Name AS name, orders.Quantity AS Quantity,orders.Discount as Discount,Debt,MPesa,Cash,Fine,Balance,Delivery_time,Returned,Banked,Slip_Number,Invoice_Number,Banked_By,orders.Created_at as created_at FROM orders INNER JOIN customers ON orders.Customer_id=customers.id INNER JOIN stock ON orders.Stock_id=stock.id  WHERE DATE(Delivery_time) =";
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('orders', $fields))
        {
            throw new Exception('error');
        }
    }

    public function fetchOrdersToday()
    {

        $query = $this->connect()->query($this->$sales_stmt." CURRENT_DATE() ORDER BY orders.id ASC;");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ordersTodayCount()
    {
        $query = $this->connect()->query($this->$sales_stmt." CURRENT_DATE() ORDER BY orders.id ASC;");
        return $query->rowCount();
    }

    public function fetchOrdersYesterday()
    {

        $query = $this->connect()->query($this->$sales_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY ) ORDER BY orders.id ASC;");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ordersYesterdayCount()
    {
        $query = $this->connect()->query($this->$sales_stmt." DATE_SUB( CURDATE(), INTERVAL 1 DAY ) ORDER BY orders.id ASC;");
        return $query->rowCount();
    }

    public function fetchOrdersTomorrow()
    {

        $query = $this->connect()->query($this->$sales_stmt." DATE_ADD( CURDATE(), INTERVAL 1 DAY ) ORDER BY orders.id ASC;");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ordersTomorrowCount()
    {
        $query = $this->connect()->query($this->$sales_stmt." DATE_ADD( CURDATE(), INTERVAL 1 DAY ) ORDER BY orders.id ASC;");
        return $query->rowCount();
    }

    public function fetchOrdersNextMonth()
    {

        $query = $this->connect()->query($this->$sales_stmt." DATE(Delivery_time) < DATE_ADD( CURDATE(), INTERVAL 1 MONTH ) AND DATE(Delivery_time) > DATE_SUB( CURDATE(), INTERVAL 0 DAY ) ORDER BY orders.id ASC;");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ordersNextMonthCount()
    {
        $query = $this->connect()->query($this->$sales_stmt." DATE(Delivery_time) < DATE_ADD( CURDATE(), INTERVAL 1 MONTH ) AND DATE(Delivery_time) > DATE_SUB( CURDATE(), INTERVAL 0 DAY ) ORDER BY orders.id ASC;");
        return $query->rowCount();
    }

    public function fetchSellingPrice($product)
    {
        //MariaDB Only
       // $selling_price = mysqli_query($connection,"SELECT Selling_price FROM (SELECT s.Name as sname,sf.Selling_price as Selling_Price, sf.Created_at,ROW_NUMBER() OVER (PARTITION BY s.id ORDER BY sf.Created_at DESC) as rn FROM stock s JOIN stock_flow sf ON s.id = sf.Stock_id join orders o on s.id = o.Stock_id ) q WHERE rn = 1 AND sname = '$product'")or die($connection->error);
        //MySQL Only 
        $query = $this->connect()->query("SELECT sf.Selling_price as Selling_price FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at AND s.name = '$product'");
        return $query->fetch()['Selling_price'];
    }


}