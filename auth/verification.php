<?php
require('../functions.php');
require_once '../core/init.php';
$where = $_POST['where'];
$validate = new Validation();
if($where == 'email' )
{
    $result = $validate->emailCheck(sanitize(Input::post('email')));
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
    $result = $validate->mobileNumberCheck(sanitize(Input::post('mobile')));
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
    $result = $verify->verifyPassword(sanitize(Input::post('email')), sanitize(Input::post('password')));
    if($result == FALSE)
     {
         echo "invalid";
     }
    
}
?>