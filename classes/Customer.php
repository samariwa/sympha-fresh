<?php
class Customer{

    private $_db,
            $active_customers_stmt;

    public function __construct($customer = null)
    {
        $this->_db = Database::getInstance();
        $this->$active_customers_stmt = $this->_db->connect()->query("SELECT * from customers WHERE Status != 'blacklisted' AND NOT id = '1' ORDER BY id DESC");
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('customers', $fields))
        {
            throw new Exception('error');
        }
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
   
}