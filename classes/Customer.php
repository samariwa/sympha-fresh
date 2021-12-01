<?php
class Customer{
    private $_db;

    public function __construct($customer = null)
    {
        $this->_db = Database::getInstance();
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('customers', $fields))
        {
            throw new Exception('error');
        }
    }
   
}