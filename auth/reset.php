<?php
require_once "../functions.php";
require('../config.php');
require_once '../core/init.php';
$passwordnotempty = TRUE;
$passwordvalidate = TRUE;
$internetConnection = TRUE;
$passwordmatch  = TRUE;
$botDetect = FALSE;
if(Input::exists())
 {
  $token_verification = new Token();
  $token_result = $token_verification->AuthToken(Input::post('token'));
	if ($token_result == "success") 
  {
   if ((Input::getSet('email') == true) && (Input::getSet('token') == true)){
      $email = sanitize($_GET['email']);
      $token = sanitize($_GET['token']);
      $sql = "SELECT number FROM users WHERE email='$email' AND token='$token' AND tokenExpire > NOW()";
      $check=mysqli_query($connection,$sql);
      $exists=mysqli_num_rows($check);
      if($exists > 0){
         if ((Input::postSet('pass') == true) &&  (Input::postSet('pass2') == true)) {
         $desired_password = sanitize($_POST["pass"]);
         $desired_password1 = sanitize($_POST["pass2"]);
    if ($desired_password == $desired_password1) 
    {
      $passwordmatch = TRUE;
    } 
    else 
    {
      $passwordmatch = FALSE;
    }
       
    if (strlen($desired_password) < 8) 
    {
      $passwordvalidate = FALSE;
    }
    else 
    {
      $passwordvalidate = TRUE;
    }
    if(($passwordnotempty == TRUE) && ($passwordmatch == TRUE))
    {
        $user = new User();
        $resetPassword = $user->resetPassword($email,$desired_password);
        //redirect to login page
        echo '<script type="text/javascript">
        alert("Your password reset was successful!");
        window.location.href="login.php?page_url=../template/index.php";
        </script>';
    }
    }
    else
    {
      $passwordnotempty = FALSE;
    }
      }else
      {
         redirectToLoginPage();
      }     
   }else{
   	redirectToLoginPage();
   }
  }
  elseif($token_result == "no connection")
{
  $internetConnection = FALSE;
}
  else{
    $botDetect = TRUE;
  }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reset Password</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="shortcut icon" type="image/png" sizes="196x196" href="../assets/images/sympha_fresh_white.png" />
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/css/util.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <!--===============================================================================================-->
    <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <!--===============================================================================================-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--===============================================================================================-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!--===============================================================================================-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo Config::get('google_recaptcha/public_key'); ?>"></script>
    
</head>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-form-title" style="background-image:url('../assets/images/auth-bg.jpg')">
          <span class="login100-form-title-1">
            Reset Password
          </span>
        </div>

        <form class="login100-form" method="POST" id="rest-form">

        <div class="wrap-input100 m-b-20">
        <span style="color: red;" id="pass-error"></span>
            <span class="label-input100">New Password</span>
            <input class="input100" type="password" name="pass" id="pass" required placeholder="Enter password">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 m-b-20">
          <span style="color: red;" id="pass2-error"></span>
            <span class="label-input100">Confirm Password</span>
            <input class="input100" type="password" name="pass2" id="pass2" required placeholder="Re-enter password">
            <span class="focus-input100"></span>
          </div>
           <div class="flex-sb-m w-full m-b-30">
           
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="reset_button">
             Reset
            </button>
          </div>
          <div>
          </div>
          
          <div style="margin-top: 20px">
          <!-- Display validation errors -->
          <?php if ($botDetect == TRUE)
              echo '<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Access Denied!</font>';
              if ($internetConnection  == FALSE)
              echo '<br><font color="red"><i class="bx bx-wifi bx-flashing"></i>&ensp;Please check your internet connection and try again.</font>';
           if ($passwordmatch == FALSE)
            echo '<br><font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;<font color="red"><i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.</font>'; 
             if ($passwordvalidate = FALSE)
                echo '<br><br><font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your password should be greater than 8 characters.</font>'; ?>
            <br>
        </div>  
        <input type="hidden" id="token" name="token">                
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
		$(function(){
  $(`#pass-error`).hide();
	$(`#pass2-error`).hide();

  var passError = false;
  var pass2Error = false;

  $(`#pass`).focusout(function(){
      check_pass();
  });
  $(`#pass2`).focusout(function(){
      check_pass2();
  });

  function check_pass(){
      var pass = $(`#pass`).val().length;
      if (pass > 0 && pass < 8) {
        $(`#pass-error`).show();
        $(`#pass-error`).html('<i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Password should be greater than 8 characters.');
        passError = true;
      }
      else{
          $(`#pass-error`).hide();
          $(`#pass-error`).html('');
          passError = false;
      }
      
  }
  function check_pass2(){
      var pass2 = $(`#pass2`).val();
      var pass = $(`#pass`).val();
      if( pass2 !== pass && pass2 != ''){
        $(`#pass2-error`).show();
        $(`#pass2-error`).html('<i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.');
        pass2Error = true;
      }
      else{
        $(`#pass2-error`).hide();
          $(`#pass2-error`).html('');
          pass2Error = false;
      }
      
  } 

  $(`#reset-form`).submit(function(){
          check_pass(); 
          check_pass2();          

          if (passError == false && pass2Error == false) {
          	return true;
          }else{
          	return false;
          }
        });
  });

  grecaptcha.ready(function() {
    // do request for recaptcha token
    // response is promise with passed token
        grecaptcha.execute('<?php echo Config::get('google_recaptcha/public_key'); ?>', {action:'validate_captcha'})
                  .then(function(token) {
            // add token value to form
            document.getElementById('token').value = token;
        });
    });
	</script>
</body>
</html>