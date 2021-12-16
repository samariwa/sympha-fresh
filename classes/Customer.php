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

    public function fetchCustomerId($userId)
    {
        $data = $this->_db->get('customers', 'id', array('User_id', '=', $userId));
        if($data->count())
        {
            return $data->first_result()->id;        
        }
        return false;
    }
   
}