<?php
require('../config.php');
require('../functions.php');
require_once '../core/init.php';

$botDetect = FALSE;
$usernotduplicate = TRUE;
$passwordvalidate = TRUE;
$passwordmatch  = TRUE;
$error = FALSE;
$internetConnection = TRUE;
$mailsent = FALSE;
$verificationmatch = TRUE;
$user = new User();
if(isset($_GET['verification']))
{
	$userDetails = Database::getInstance()->getAll('users', array('email', '=', sanitize($_GET['email'])));
	$roleSession = mysqli_query($connection,"SELECT jobs.Name as Name FROM `users` inner join jobs on users.Job_id = jobs.id WHERE `email`='".$userDetails->first_result()->email."'");
    $row5 = mysqli_fetch_array($roleSession);
	Session::put('role', $row5['Name']);
    Session::put('user', $userDetails->first_result()->firstname);
    Session::put('email', $userDetails->first_result()->email);
		if($_GET['verification'] == $userDetails->first_result()->token)
		{
			$login = $user->SetSessionVariables($userDetails->first_result()->id);
			Session::flash('success', 'You have registered successfully');
			if (Session::loggedIn()) 
			{
				Redirect::to('../'.$home_url);
				exit;
			}		
		}
		else
		{
			$verificationmatch = FALSE;
		}
}
if(Input::exists())
{
$token_verification = new Token();
$token_result = $token_verification->AuthToken(Input::post('token'));
if ($token_result == "success") 
{
	$random = generateRandomString();
	$validation = new Validation;
    $email_validation = $validation->emailCheck(sanitize(Input::post('email')));
	$mobile_validation = $validation->mobileNumberCheck(sanitize(Input::post('mobile')));
	if(($email_validation == TRUE) || ($mobile_validation == TRUE))
	{
		$usernotduplicate = FALSE;
	}
	else
	{
		$usernotduplicate = TRUE;
	}
	if( ((strlen(sanitize(Input::post('pass')))) < 8)) 
	{
        $passwordvalidate = FALSE;
    } 
	else 
	{
        $passwordvalidate = TRUE;
    }

    if(sanitize(Input::post('pass')) == sanitize(Input::post('pass2'))) 
	{
        $passwordmatch = TRUE;
    } 
	else
	{
        $passwordmatch = FALSE;
    }
	if (($usernotduplicate == TRUE) && ($passwordmatch == TRUE) && ($passwordvalidate == TRUE))
	{
		try
		{
			$user->create(array(
				'firstname' => sanitize(Input::post('firstname')),
				'lastname' => sanitize(Input::post('lastname')),
				'number' => sanitize(Input::post('mobile')),
				'email' => sanitize(Input::post('email')),
				'location' => sanitize(Input::post('location')),
				'password' => password_hash(sanitize(Input::post('pass')), PASSWORD_DEFAULT)
			));
		}
		catch(Exception $e)
		{
			$error = TRUE;
		}
		$customer_fullname = sanitize(Input::post('firstname')).' '.sanitize(Input::post('lastname'));
		$customer = new Customer();
		try
		{
			$customer->create(array(
				'User_id' => $user->fetchUserId(sanitize(Input::post('email'))),
				'Name' => $customer_fullname,
				'Number' => sanitize(Input::post('mobile')),
				'Location' => sanitize(Input::post('location')),
				'Status' => 'clean',
				'Note' => 'Add Note...'
			));
		}
		catch(Exception $e)
		{
			$error = TRUE;
		}
		$verification_key = generateRandomString();
		$verified_link = $protocol.$_SERVER['HTTP_HOST'].'/sympha-fresh/auth/registration.php?email='.$email.'&verification='.$verification_key;
        $registrationToken = $user->RegistrationToken(sanitize(Input::post('email')),$verification_key);
		$mail = new Mail();
        $send = $mail->registrationVerificationMail(sanitize(Input::post('email')),Input::post('firstname'),$verification_key);
		if($send == TRUE)
		{
			$mailsent = TRUE;
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

?>    
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registration</title>
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
<body>	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image:url('../assets/images/auth-bg.jpg')">
					<span class="login100-form-title-1">
						Sign Up
					</span>
				</div>  
				<form class="login100-form" id="registration-form" method="POST" action="<?php echo Config::get('server_id/self'); ?>">

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">First Name</span>
						<input class="input100" type="text" name="firstname" id="firstname" required placeholder="Christine">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">Last Name</span>
						<input class="input100" type="text" name="lastname" id="lastname" required placeholder="Washiali">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">Physical Address</span>
						<input class="input100" type="text" name="location" id="location" required placeholder="&#xf041; Lang'ata, Nairobi, Kenya" style="font-family:Arial, FontAwesome">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="email-error"></span>
						<span class="label-input100">Email Address</span>
						<input class="input100" type="email" name="email" id="email" required placeholder="&#xf0e0; christine*****@gmail.com" style="font-family:Arial, FontAwesome">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="mobile-error"></span>
						<span class="label-input100">Mobile Number</span>
						<input class="input100" type="text" name="mobile" id="mobile" required placeholder="&#xf095; +254 7## ### ###" style="font-family:Arial, FontAwesome">
						<span class="focus-input100" ></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="pass-error"></span>
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" id="pass" required placeholder="Enter password">
						<span class="focus-input100" ></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="pass2-error"></span>
						<span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" name="pass2" id="pass2" required placeholder="Re-enter password">
						<span class="focus-input100" ></span>
					</div>

					<div class="flex-sb-m w-full m-b-30" style="margin-top: 30px">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" required name="T&C">
							<label class="label-checkbox100" for="ckb1">
								I agree to the <a href="#" style="color: inherit;text-decoration: underline;">Terms and Conditions</a>
							</label>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit_button">
							Register
						</button>
					</div>
					<div>
						<br>
						
						<p>Already have an account?&ensp;<a href="<?php echo 'login.php?page_url=../'.$home_url; ?>" style="color: inherit;text-decoration: underline;">Login</a></p>
					</div>	
					<div style="margin-top: 20px">
		                  <!-- Display error -->
		                  <?php if ($botDetect == TRUE)
		                        echo '<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Access Denied!</font>';
								if ($error == TRUE)
		                        echo '<font color="red"><i class="bx bxs-error bx-flashing"></i>&ensp;Something went wrong. Please try again.</font>';
								if ($internetConnection  == FALSE)
		                        echo '<br><font color="red"><i class="bx bx-wifi bx-flashing"></i>&ensp;Please check your internet connection and try again.</font>';
								if ($passwordmatch == FALSE)
								echo '<br><br>&emsp;&emsp;&emsp;&ensp;<font color="red"><i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.</font>'; 
							    if ($mailsent == TRUE)
					            echo '<br><br><font color="green"><i class="bx bx-check-circle bx-flashing"></i>&ensp;Please check your email for an activation link for your account.</font>'; 
								if ($passwordvalidate == FALSE)
								echo '<br><br>&emsp;&emsp;&emsp;&emsp;<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your password should be greater than 8 characters.</font>'; 
								if ($verificationmatch == FALSE)
					           echo '<br><br><font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your verification keys do not match. <br>Kindly ensure that you are using the correct activation link.</font>'; 	
								if ($usernotduplicate == FALSE)
								echo '<br><br>&emsp;&emsp;&emsp;&emsp;<font color="red"><i class="bx bxs-data bx-flashing"></i>&ensp;User already exists.</font>'; 
							?>
                  </div>
					<input type="hidden" id="token" name="token">       		        
				</form>
			</div>
		</div>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
		  $(`#email-error`).hide();
		  $(`#mobile-error`).hide();
		  $(`#pass-error`).hide();
		  $(`#pass2-error`).hide();

		  var emailError = false;
          var mobileError = false;
          var passError = false;
          var pass2Error = false;

           $(`#email`).focusout(function(){
              check_email();
          });
          $(`#mobile`).focusout(function(){
              check_mobile();
          });
          $(`#pass`).focusout(function(){
              check_pass();
          });
          $(`#pass2`).focusout(function(){
              check_pass2();
          });

          
          function check_email(){
          	var email = $(`#email`).val();
			
          	var where = 'email';
            $.post("verification.php",{email:email,where:where},
              function(result){
              	if (result == 'exists') {
              		$(`#email-error`).show();
              		$(`#email-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;This email address already exists.');
              		emailError = true;

              	}
              	else{
              		$(`#email-error`).hide();
              		$(`#email-error`).html('');
              		emailError = false;
              	}
            });
        }


 
        function check_mobile(){
          	var mobile = $(`#mobile`).val();
          	var where = 'mobile';
              $.post("verification.php",{mobile:mobile,where:where},
              function(result){
              	if (result == 'exists') {
              		$(`#mobile-error`).show();
              		$(`#mobile-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;This mobile number already exists.');
              		mobileError = true;
              	}
              	else{
              		$(`#mobile-error`).hide();
              		$(`#mobile-error`).html('');
              		emailError = false;
              	}
          });
        }

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

        $(`#registration-form`).submit(function(){
          check_email();
          check_mobile();
          check_pass(); 
          check_pass2();          

          if (emailError == false && mobileError == false && passError == false && pass2Error == false) {
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