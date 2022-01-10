<?php
class Session{

    public static function exists($name)
   {
       return (isset($_SESSION[$name])) ? true : false;
   }

    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }

    public static function delete($name)
    {
        if(self::exists($name))
        {
            unset($_SESSION[$name]);
        }
    }

    public static function flash($name, $string = '')
    {
        if(self::exists($name))
        {
            $session = self::get($name);
            self::delete($name);
            return $session;
        }
        else
        {
            self::put($name, $string);
        }
    }

    public static function loggedIn()
    {
        if (Session::exists('logged_in')) 
        {
            return (Session::get('logged_in') == TRUE) ? true : false;
        }
        else
        {
            return false;
        }
    }

    public static function validateAuthSession()
    {
        if (Session::loggedIn())
        {
            $user = new User();
            //valid user has logged-in to the website
            //Check for unauthorized use of user sessions
            Database::getInstance()->update('users', 'email', Session::get('email'), array('online' => '1'));
            //$this->_db->update('users', 'email', Session::get('email'), array('online' => '1'));
            $signaturerecreate = Session::get('signature');
            //Extract original salt from authorized signature
            $saltrecreate = substr(Session::get('signature'), 0, Config::get('salt/salt_length'));
            //Extract original hash from authorized signature
            $originalhash = substr(Session::get('signature'), Config::get('salt/salt_length'), 40);
            //Re-create the hash based on the user IP and user agent then check if it is authorized or not
            $hashrecreate = sha1($saltrecreate . Config::get('client_id/ip_address') . Config::get('client_id/user_agent'));
            if (!($hashrecreate == $originalhash))
            {
                //Signature submitted by the user does not matched with the authorized signature
                //Block it since this is unauthorized access
                if(basename(Config::get('server_id/self')) == 'login.php')
                {
                    Redirect::to('../'.Config::get('pages/logout_url').'?page_url='.Config::get('server_id/protocol').Config::get('server_id/host').Config::get('server_id/current_directory'));
                }
                elseif(basename(Config::get('server_id/self')) == Config::get('pages/home_url'))
                {
                    Redirect::to(Config::get('pages/logout_url').'?page_url='.Config::get('server_id/protocol').Config::get('server_id/host').Config::get('server_id/current_directory'));
                }
            }
            else
            {
                $userDetails = Database::getInstance()->getAll('users', array('email', '=', Session::get('email')));
                $access = $userDetails->first_result()->access;
                if($access == 'customer')
                {
                    $customer = new Customer();
                    $userId = $user->fetchUserId(Session::get('email')); 
                    $customerId = $customer->fetchCustomerId($userId);
                    //transfer cart cookie to database 
                    /*if(Cookie::exists('shopping_cart'))
                    {
                        $cart = new Cart();
                        die(var_dump(Cart::decodeCookie()));
                        foreach(Cart::decodeCookie() as $keys => $values)
                        {  
                            $cartDump = $cart->transferCookieToDatabase($customerId, $values["item_id"],$values["item_quantity"]);   
                        }
                        Cookie::put('shopping_cart','', Config::get('cart_cookie/expiry'));
                    }
                    //transfer wishlist cookie to database
                    if(Wishlist::cookieExists())
                    {
                        $wishlist = new Wishlist();
                        foreach(Wishlist::decodeCookie() as $keys => $values)
                        {
                            $wishlistDump = $wishlist->transferCookieToDatabase($customerId, $values["item_id"]);
                        }
                        Cookie::put('shopping_wishlist','', Config::get('wishlist_cookie/expiry'));
                    }*/
                    if(basename(Config::get('server_id/self')) == 'login.php')
                    {
                        Redirect::to('../'.Config::get('pages/home_url'));
                    }
                }
                else
                {
                    if(basename(Config::get('server_id/self')) == 'login.php')
                    {
                        Redirect::to('../'.Config::get('pages/admin_url'));
                    }
                }
            }
            //Session Lifetime control for inactivity
            if ((Session::exists('LAST_ACTIVITY')) && ((time() - Session::get('LAST_ACTIVITY')) > Config::get('session_timeout/session_expiry')) || (Session::exists('LAST_ACTIVITY')) && ($user->fetchUserStatus(Session::get('email')) == 2))
            {
                //redirect the user back to login page for re-authentication
                if(basename(Config::get('server_id/self')) != 'login.php')
                {
                    Redirect::to('../sympha-fresh/'.Config::get('pages/logout_url').'?page_url='.Config::get('server_id/protocol').Config::get('server_id/host').Config::get('server_id/current_directory'));
                }
            }
            Session::put('LAST_ACTIVITY', time());
        }
    }
}