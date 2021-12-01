<?php
class User{
    private $_db;

    public function __construct($user = null)
    {
        $this->_db = Database::getInstance();
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('users', $fields))
        {
            throw new Exception('error');
        }
    }

    public function fetchUserId($email)
    {
        $data = $this->_db->get('users', 'id', array('email', '=', $email));
        if($data->count())
        {
            return $data->first_result()->id;        
        }
        return false;
    }
}