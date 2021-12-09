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

    public function login($id,$email,$password,$remember_me)
    {
        if($remember_me == TRUE)
        {
            Cookie::put('email',$email, Config::get('remember_me_cookie/expiry'));
            Cookie::put('password',$password, Config::get('remember_me_cookie/expiry'));
        }
        else
        {
            if(Cookie::exists('email'))
            {
                Cookie::empty('email');
            }
            if(Cookie::exists('password'))
            {
                Cookie::empty('password');
            }
        }
        $this->updateUserLoginAttempts($id,'0');
        //generate random hash
        $random = Functions::genRandomSaltString();
        $salt_ip = substr($random, 0, Config::get('salt/salt_length'));
        //hash the ip address, user-agent and the salt
        $hash_user = sha1($salt_ip . Config::get('client_id/ip_address') . Config::get('client_id/user_agent'));
        //concatenate the salt and the hash to form a signature
        $signature = $salt_ip . $hash_user;
        //Generate session id prior to setting any session variable to mitigate session fixation attacks
        session_regenerate_id();
        Session::put('signature', $signature);
        Session::put('logged_in', TRUE);
        Session::put('LAST_ACTIVITY', time());
        if (Session::exists('logged_in'))
        {
            $this->_db->insert("logged_devices", array('user_id' => $id, 'ip_address' => Config::get('client_id/ip_address'), 'browser/device' => Config::get('client_id/user_agent')));
        }
    }

    public function fetchUserPassword($email)
    {
        $data = $this->_db->get('users', 'password', array('email', '=', $email));
        if($data->count())
        {
            return $data->first_result()->password;        
        }
        return false;
    }

    public function fetchUserLoginAttempts($email)
    {
        $data = $this->_db->get('users', 'loginattempt', array('email', '=', $email));
        if($data->count())
        {
            return $data->first_result()->loginattempt;        
        }
        return false;
    }

    public function updateUserLoginAttempts($id,$attempts)
    {
        $this->_db->update('users', 'id', $id, array('loginattempt' => $attempts));
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