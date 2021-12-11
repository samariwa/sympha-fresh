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
        if($enteredEmail != '')
        {
            $check = $this->_db->getAll('users', array('email', '=', $enteredEmail));
            if($check->count())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return true;
    }

    public function mobileNumberCheck($enteredNumber)
    {
        if($enteredNumber != '')
        {
            $check = $this->_db->getAll('users', array('number', '=', $enteredNumber));
            if($check->count())
            {
                return true;
            }
            else
            {
                return false;
            }
            return true;
        }
    }
}