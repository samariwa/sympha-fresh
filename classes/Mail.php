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
        $mail -> Body = "
                Hi $recepient_name,<br><br>
                $body
                Kind Regards,<br>
                $organization.
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

    public function forgotPasswordMail($email, $user_first_name)
    {
        $reset_link = Config::get('server_id/protocol').Config::get('server_id/host').'/sympha-fresh/auth/reset.php?email='.$email.'&token='.Functions::generateRandomString();
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
}