<?php
class Wishlist{
    private $_db;

    public function __construct($user = null)
    {
        $this->_db = Database::getInstance();
        require('config.php');
    }

    public static function cookieExists()
    {
        return (Cookie::exists('shopping_wishlist')) ? true : false;
    }

    public static function decodeCookie()
    {
        $wishlist_data = stripslashes(Cookie::get('shopping_wishlist'));
        $wishlist_data = json_decode($wishlist_data, true); 
        return $wishlist_data;
    }

    public function transferCookieToDatabase($customer_id, $product_id)
    {
        if(Cart::existsInWishlist($customer_id, $product_id) == true)
        {
            $this->_db->insert("wishlist", array('customer_id' => $customer_id, 'product_id' => $product_id));  
        }
    }

    public function existsInWishlist($customer_id, $product_id)
    {
        //$check = $this->_db->getAll('cart', array('customer_id', '=', $customer_id));
        $wishlist_duplicate = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='$customer_id' AND product_id = '$product_id'");
        //if($check->count())
        if(mysqli_fetch_array($wishlist_duplicate) == false)
        {
            return true;
        } 
        return false;  
    }
}