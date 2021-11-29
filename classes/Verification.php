<?php
class Verification{

    private $_db = null,
            $_data;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function verifyPassword($email, $password)
    {
       if($password != '')
       {
            $data = $this->_db->get('users', 'password', array('email', '=', $email));
            if($data->count())
            {
                $this->_data = $data->first_result()->password;
                    if(!password_verify($password, $this->_data))
                    {
                        return false;
                    }
            }
        }
        return true;
    }
}