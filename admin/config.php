<?php
//require user configuration and database connection parameters
///////////////////////////////////////
//START OF USER CONFIGURATION/////////
/////////////////////////////////////
//Define MySQL database parameters

$username = "root";
$password = "samokoth.1999";
$hostname = "127.0.0.1";
$database = "sympha_fresh";
$port = "3307";

/*$username = "symphesh_admin";
$password = "samokoth.1999";
$hostname = "198.57.247.209";
$database = "symphesh_db";
$port = "3306";*/

//Definition of canonical domain including trailing slash!:
$domain = "http://www.xyz.com/";

//Defining sending email notification to webmaster

$email = 'kwanzatukuleauthenticator@gmail.com';
$subject = 'New user registration notification';
$from = 'kwanzatukuleauthenticator@gmail.com';

//Defining Recaptcha parameters
$privatekey = "Recaptcha private key";
$publickey = "Recaptcha public key";

//Defining length of salt,minimum=10, maximum=35
$length_salt = 15;

//Defining the maximum number of failed attempts to ban brute force attackers
//minimum is 5
$maxfailedattempt = 5;

//Defining session timeout in seconds
//minimum 60 (for one minute)
$sessiontimeout = 60*30;

////////////////////////////////////
//END OF USER CONFIGURATION/////////
////////////////////////////////////
//DO NOT EDIT ANYTHING BELOW!

$connection = mysqli_connect($hostname,$username, $password, $database,$port)
or die("Unable to connect to Server". mysql_error());
$login_url = 'login.php';
$logout_url = 'logout.php';
$dashboard_url = 'dashboard.php';
?>