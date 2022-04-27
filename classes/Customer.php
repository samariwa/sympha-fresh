<?php
class Customer extends Database{

    private $_db,
            $active_customers_stmt,
            $blacklisted_customers_stmt;

    public function __construct($customer = null)
    {
        $this->_db = Database::getInstance();
        $this->$active_customers_stmt = $this->connect()->query("SELECT * from customers WHERE Status != 'blacklisted' AND NOT id = '1' ORDER BY id DESC");
      //$this->$blacklisted_customers_stmt = $this->connect()->query("SELECT customers.id as id,customers.Name, MAX(orders.created_at),customers.Location,customers.Number,customers.Deliverer,orders.Balance FROM orders INNER JOIN customers ON orders.Customer_id=customers.id where customers.Status='blacklisted' GROUP BY customers.id");
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('customers', $fields))
        {
            throw new Exception('error');
        }
    }
    
    public function deleteCustomer($id)
    {
        $this->_db->delete('customers', array('id' , '=', $id));
    }

    public function customerExists($number)
    {
        $data = $this->_db->get('customers', '*', array('Number', '=', $number));
        if($data->count())
        {
            return true;        
        }
        return false;
    }

    public function fetchCustomerId($userId)
    {
        $data = $this->_db->get('customers', 'id', array('User_id', '=', $userId));
        if($data->count())
        {
            return $data->first_result()->id;        
        }
        return false;
    }

    public function fetchActiveCustomers()
    {
        return $this->$active_customers_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function activeCustomersCount()
    {
        return $this->$active_customers_stmt->rowCount();
    }

    public function fetchBlacklistedCustomers()
    {
        return $this->$blacklisted_customers_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function blacklistedCustomersCount()
    {
        return $this->$blacklisted_customers_stmt->rowCount();
    }
   
    /* public function delete($id)
    {
        $this->_db->delete('customers', array('id' , '=', $id));
    }*/
}