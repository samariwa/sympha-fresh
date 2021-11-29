<?php
require('../functions.php');
require_once '../core/init.php';
$where = $_POST['where'];
$validate = new Validation;
if($where == 'email' )
{
    $result = $validate->emailCheck(sanitize($_POST['email']));
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
    $result = $validate->mobileNumberCheck(sanitize($_POST['mobile']));
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
    $result = $verify->verifyPassword(sanitize($_POST['email']), sanitize($_POST['password']));
    if($result == FALSE)
     {
         echo "invalid";
     }
    
}
?>