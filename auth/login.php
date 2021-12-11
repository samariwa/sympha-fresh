<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//require user configuration and database connection parameters
require('../config.php');
require_once "../functions.php";
require_once '../core/init.php';
  Session::validateAuthSession();
//Pre-define validation
$validationresults = TRUE;
$botDetect = FALSE;
$internetConnection = TRUE;
//Check if a user has logged-in
if (!Session::exists('logged_in')) 
{
    Session::put('logged_in', FALSE);
}
if(Input::exists())
{
  $token_verification = new Token();
  $token_result = $token_verification->AuthToken(Input::get('token'));
	if ($token_result == "success") 
  {
//Check if the form is submitted
 if (Input::set('pass') && Input::set('email') && (Session::get('logged_in') == FALSE)) 
 {
    $userDetails = Database::getInstance()->getAll('users', array('email', '=', sanitize(Input::get('email'))));
    $access = $userDetails->first_result()->access;
    $user_id = $userDetails->first_result()->id;
    $roleSession = mysqli_query($connection,"SELECT jobs.Name as Name FROM `users` inner join jobs on users.Job_id = jobs.id WHERE `email`='".$userDetails->first_result()->email."'");
    $row5 = mysqli_fetch_array($roleSession);
     Session::put('role', $row5['Name']);
     Session::put('user', $userDetails->first_result()->firstname);
     Session::put('email', $userDetails->first_result()->email);
    $verification = new Verification();
    $verificationResults = $verification->verifyCredentials($userDetails->first_result()->id, Input::get('email'), Input::get('pass'));
    if($verificationResults == 'invalid')
    {
      $validationresults = FALSE;
    }
    elseif($verificationResults == 'valid')
    {
       $user = new User();
       $login = $user->login($user_id,sanitize(Input::get('email')),sanitize(Input::get('pass')),sanitize(Input::get('remember')));
    }
}
}
elseif($token_result == "no connection")
{
  $internetConnection = FALSE;
}
else
{
  $botDetect = TRUE;
}
}
if (!$_SESSION['logged_in']):
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
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
            Sign In
          </span>
        </div>

        <form class="login100-form" method="POST" id="login-form">

          <div class="wrap-input100 m-b-20">
						<span style="color: red;" id="email-error"></span>
            <span class="label-input100">Email Address</span>
            <input class="input100" value="<?php if(isset($_COOKIE['email'])){echo Cookie::get('email');}?>"  type="email" name="email" id="email" required placeholder="Enter email address">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 m-b-20">
						<span style="color: red;" id="password-error"></span>
            <span class="label-input100">Password</span>
            <input class="input100" value="<?php if(isset($_COOKIE['password'])){echo Cookie::get('password');}?>" type="password" name="pass" id="pass" required placeholder="Enter password">
            <span class="focus-input100"></span>
          </div>
           <div class="flex-sb-m w-full m-b-30">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" <?php if(isset($_COOKIE['email'])){ ?> checked <?php }?>>
              <label class="label-checkbox100" for="ckb1">
                Remember Me
              </label>
            </div>
            <div>
              <a href="forgot.php" class="txt1" style="text-decoration: none;">
                Forgot Password?
              </a>
            </div>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" name="login-button">
              Login
            </button>
          </div>
          <div>
            <br>
             <p>Don't have an account?&ensp;<a href="registration.php" style="color: inherit;text-decoration: underline;">Register</a></p>
          </div>
          <?php 
          if (($validationresults == FALSE) || ($botDetect == TRUE) || ($internetConnection == FALSE))
          {
          ?>
          <div style="margin-top: 20px">
          <!-- Display validation errors -->
                     <?php if ($botDetect == TRUE)
		                        echo '<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Access Denied!</font>';
                            if ($internetConnection  == FALSE)
		                        echo '<br><font color="red"><i class="bx bx-wifi bx-flashing"></i>&ensp;Please check your internet connection and try again.</font>';
                            if ($validationresults == FALSE)
                            echo '<font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;Please enter valid email address, password <br> &ensp;&emsp;(if required).</font>';
                   ?>
                  </div>
            <?php
                 }
           ?>
           <input type="hidden" id="token" name="token">                   
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript">
  $(function(){
    $(`#email-error`).hide();
    $(`#password-error`).hide();

    var emailError = false;
    var passError = false;
 
    $(`#email`).focusout(function(){
        check_email();
      });
    $(`#pass`).focusout(function(){
        check_pass();
      });

      function check_email(){
          	var email = $(`#email`).val();
          	var where = 'email';
            $.post("verification.php",{email:email,where:where},
              function(result){
              	if (result == 'missing') {
              		$(`#email-error`).show();
              		$(`#email-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;This email address does not exists.');
              		emailError = true;
              	}
              	else{
              		$(`#email-error`).hide();
              		$(`#email-error`).html('');
              		emailError = false;
              	}
            });
        }

        function check_pass(){
          var email = $(`#email`).val();
          	var password = $(`#pass`).val();
          	var where = 'password';
              $.post("verification.php",{email:email,password:password,where:where},
              function(result){
              	if (result == 'invalid') {
              		$(`#password-error`).show();
              		$(`#password-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;Invalid Password.');
              		passError = true;
              	}
              	else{
              		$(`#password-error`).hide();
              		$(`#password-error`).html('');
              		passError = false;
              	}
          });
        }

        $(`#login-form`).submit(function(){

          check_email();
          check_pass();   

          if (emailError == false && passError == false) {
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
<?php
else:
	//redirect
  if($access == 'customer')
  {
    if($redirect_link == '')
    {
      Redirect::to('../'.Config::get('pages/home_url'));
    }
    else
    {
      Redirect::to($_REQUEST['page_url']);
    }
  }
  else
  {
    Redirect::to('../'.Config::get('pages/admin_url'));
  }
endif;
?>