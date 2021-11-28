<?php
require('../config.php');
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
   else{
       if(sanitize($_POST['email']) != '')
       {
         echo "missing";
       }
   }
}
elseif($where == 'mobile' )
{
    $result = $validate->mobileNumberCheck(sanitize($_POST['mobile']));
    if($result == TRUE)
     {
         echo "exists";
     }
    else{
        if(sanitize($_POST['mobile']) != '')
        {
          echo "missing";
        }
    }
} 
elseif($where == 'password' )
{
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $result = mysqli_query($connection,"SELECT `password` FROM `users` WHERE `email`='$email'");
    $row = mysqli_fetch_array($result);
    if ( $row == TRUE) {
        $correctpassword = $row['password'];
        if($password != '')
        {
        if(!password_verify($password, $correctpassword))
            {
                echo "invalid";
            }
        }    
    }
}
?>