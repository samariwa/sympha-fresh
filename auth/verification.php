<?php
require('../functions.php');
require_once '../core/init.php';
$where = $_POST['where'];
$validate = new Validation();
if($where == 'email' )
{
    $result = $validate->emailCheck(sanitize(Input::get('email')));
   if($result == TRUE)
    {
        echo "exists";
    }
   else
   {
         echo "missing";
   }
}
elseif($where == 'mobile' )
{
    $result = $validate->mobileNumberCheck(sanitize(Input::get('mobile')));
    if($result == TRUE)
     {
         echo "exists";
     }
    else
    {
          echo "missing";
    }
} 
elseif($where == 'password' )
{
    $verify = new Verification();
    $result = $verify->verifyPassword(sanitize(Input::get('email')), sanitize(Input::get('password')));
    if($result == FALSE)
     {
         echo "invalid";
     }
    
}
?>