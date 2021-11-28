<?php
class Validation{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function emailCheck($enteredEmail)
    {
         $check = $this->_db->get('users', array('email', '=', $enteredEmail));
         if($check->count())
         {
             return true;
         }
         return false;
    }

    public function mobileNumberCheck($enteredNumber)
    {
        $check = $this->_db->get('users', array('number', '=', $enteredNumber));
        if($check->count())
        {
            return true;
        }
        return false;
    }
}