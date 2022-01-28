<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
class Mail{
    public function __construct() {
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/Exception.php";
        require_once "PHPMailer/SMTP.php";
    }

    public function create($recepient_address, $recepient_name, $subject, $body)
    {
        $organization = Config::get('organization_details/name');
        $mail = new PHPMailer(true);
        $mail -> addAddress($recepient_address,'Recepient');
        $mail -> setFrom(Config::get('mailer/authenticator_email'),$organization);
        $mail->IsSMTP();
        $mail->Host = Config::get('mailer/mailing_host');
        // optional
        // used only when SMTP requires authentication  
        $mail->SMTPAuth = true;
        $mail->Username = Config::get('mailer/authenticator_email');
        $mail->Password = Config::get('mailer/authenticator_email_password');
        $mail -> Subject = $subject;
        $mail -> isHTML(true);
        $mail->AddEmbeddedImage('../assets/images/mail-header.jpeg', 'logo');
        $mail->AddEmbeddedImage('../assets/images/mail-header-line.png', 'line');
        $mail->AddEmbeddedImage('../assets/images/socials/facebook.png', 'facebook');
        $mail->AddEmbeddedImage('../assets/images/socials/twitter.png', 'twitter');
        $mail->AddEmbeddedImage('../assets/images/socials/instagram.png', 'instagram');
        $mail->AddEmbeddedImage('../assets/images/socials/youtube.png', 'youtube');
        $mail -> Body = "
                <p style='text-align:center'><img src='cid:logo'  alt='logo'></p>
                <p style='text-align:center'><img src='cid:line' style='width:100%;height:10px;' alt='line'></p>
                <br>
                Hi $recepient_name,<br><br>
                $body
                Kind Regards,<br>
                $organization.
                <br><br><br><br><br><br>
                <hr style='border-top: 1px solid #666666;'>
                <br>
                <a href='#'><img src='cid:facebook' style='width:25px;height:25px;' alt='facebook'></a>
                <a href='#'><img src='cid:twitter' style='width:25px;height:25px;' alt='twitter'></a>
                <a href='#'><img src='cid:instagram' style='width:25px;height:25px;' alt='instagram'></a>
                <a href='#'><img src='cid:youtube' style='width:25px;height:25px;' alt='youtube'></a>
                
                <a href='#' style='margin-left:10px;color: #666666; text-align:right'>Unsubscribe</a>
                <a href='#' style='margin-left:10px;color: #666666; text-align:right'>Privacy Policy</a>
                <a href='#' style='margin-left:10px;color: #666666; text-align:right'>Terms of Service</a>
                ";
        return $mail;
    }

    public function send($mail)
    {
        if($mail -> send())
        {
            return true;
        }
        return false;
    }

    public function forgotPasswordMail($email, $user_first_name, $token)
    {
        $reset_link = Config::get('server_id/protocol').Config::get('server_id/host').'/sympha-fresh/auth/reset.php?email='.$email.'&token='.$token;
        $message = "In order to reset your password, please click on the link below:<br>
                    <a href='
                    $reset_link'>Password Reset Link</a><br><br>
                    Kindly reset your password in the given time limit of 5 minutes.<br><br>";
        $mail = $this->create($email, $user_first_name, 'Forgot Password', $message);
        $sendMail = $this->send($mail);
        if($sendMail == TRUE)
        {
            return true;
        }
        return false;
    }

    public function registrationVerificationMail($email, $user_first_name, $verification_key)
    {
        $verified_link = Config::get('server_id/protocol').Config::get('server_id/host').'/sympha-fresh/auth/registration.php?email='.$email.'&verification='.$verification_key;
        $message = "You've successfully signed up for Sympha Fresh.
        In order to activate your account, please click on the link below (this will confirm you email address):<br>
        <a href='
        $verified_link'>Account Activation Link</a><br><br>";
        $mail = $this->create($email, $user_first_name, 'Activate your Sympha Fresh account', $message);
        $sendMail = $this->send($mail);
        if($sendMail == TRUE)
        {
            return true;
        }
        return false;
    }
}