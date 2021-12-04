<?php
class Verification{

    private $_db = null,
            $_data;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function verifyCredentials($id,$email,$password)
    {
        //check if email address exists in the database
        $validate = new Validation();
        $result = $validate->emailCheck($email);
        //verify that credentials match
        if (($this->verifyPassword($email,$passowrd) == FALSE) || ($result == FALSE)) 
        {     
            //fetch & increament login attempts
            $user = new User();
            $updateLoginAttempts = $user->updateUserLoginAttempts($id,intval($user->fetchUserLoginAttempts($email)+1));
            return "invalid";
        }
        else
        {
            return "valid";
        }
    }

    public function verifyPassword($email, $password)
    {
       if($password != '')
       {
            $user = new User();
            if(!password_verify($password, $user->fetchUserPassword($email)))
            {
                return false;
            }
        }
        return true;
    }
}