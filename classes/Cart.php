<?php
class Cart{
    private $_db;

    public function __construct($user = null)
    {
        $this->_db = Database::getInstance();
        require('config.php');
    }

    public static function cookieExists()
    {
        return (Cookie::exists('shopping_cart')) ? true : false;
    }

    public static function decodeCookie()
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true); 
        return $cart_data;
    }

    public function transferCookieToDatabase($customer_id, $product_id, $quantity)
    {
        if(Cart::existsInCart($customer_id, $product_id) == true)
        {
            $this->_db->insert("cart", array('customer_id' => $customer_id, 'product_id' => $product_id, 'quantity' => $quantity));  
        }
    }

    public function existsInCart($customer_id, $product_id)
    {
        //$check = $this->_db->getAll('cart', array('customer_id', '=', $customer_id));
        $cart_duplicate = mysqli_query($connection,"SELECT * FROM `cart` WHERE customer_id ='$customer_id' AND product_id = '$product_id'");
        //if($check->count())
        if(mysqli_fetch_array($cart_duplicate) == false)
        {
            return true;
        } 
        return false; 
       
    }
}