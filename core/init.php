<?php
session_start();

$protocol = $_SERVER['SERVER_PROTOCOL'];
if(strpos($protocol, "https"))
{
    $protocol="https://";
}
else
{
    $protocol="http://";
}

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'port' => '3307',
        'username' => 'root',
        'password' => 'samokoth.1999',
        'database' => 'sympha_fresh'
    ),
    'remember_me_cookie' => array(
        'name' => 'remember',
        'expiry' => time()+60*60*7*24
    ),
    'session_timeout' => array(
        'session_expiry' => 60*30
    ),
    'server_id' => array(
        'protocol' => $protocol,
        'host' => $_SERVER['HTTP_HOST'],
        'current_directory' => $_SERVER['REQUEST_URI']
    ),
    'client_id' => array(
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER["HTTP_USER_AGENT"]
    ),
    'cart_cookie' => array(
        'name' => 'cart',
        'expiry' => time() +60*60*7*24
    ),
    'wishlist_cookie' => array(
        'name' => 'wishlist',
        'expiry' => time() +60*60*7*24
    ),
    'login_failed_attempts' => array(
        'max_attempts' => 5
    ),
    'google_recaptcha' => array(
        'token_verification_site' => 'https://www.google.com/recaptcha/api/siteverify',
        'public_key' => '6Ld_DqAaAAAAAIVKl_AmFc4qhHItRTT75yqbmhtR',
        'private_key' => '6Ld_DqAaAAAAAC_Xp5g6yDr5XPjC1oIlMGZwX5cS'    
    ),
    'organization_details' => array(
        'name' => 'Sympha Fresh',
        'contact' => '+254 797 233 726',
        'physical_address' => 'This address',
        'mission' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. consequuntur quibusdam enim expedita sed nesciunt incidunt accusamus adipisci officia libero laboriosam! Proin gravida nibh vel velit auctor aliquet. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.',
        'vision' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. consequuntur quibusdam enim expedita sed nesciunt incidunt accusamus adipisci officia libero laboriosam! Proin gravida nibh vel velit auctor aliquet. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.',
        'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. consequuntur quibusdam enim expedita sed nesciunt incidunt accusamus adipisci officia libero laboriosam! Proin gravida nibh vel velit auctor aliquet. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.',
    ),
    'mailer' => array(
        'mailing_host' => 'smtp.gmail.com',
        'authenticator_email' => 'symphauthenticator@gmail.com',
        'authenticator_email_password' => 'Kenya.2030'
    ),
    'salt' => array(
        'salt_length' => 15
    ),
    'pages' => array(
        'home_url' => 'index.php',
        'admin_url' => 'admin/dashboard.php',
        'logout_url' => 'auth/logout.php',
        'login_url' => 'auth/login.php',
        'redirect_link' => $_SERVER['SERVER_PROTOCOL'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
    )
);



    spl_autoload_register(function($class){
        $directory = 'classes/'.$class.'.php';
        if(file_exists($directory))
        {
            require_once $directory;
        }
        else
        {
            require_once '../classes/'.$class.'.php';
        }
    });


