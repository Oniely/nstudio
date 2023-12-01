<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";

function generateOTP($length = 6)
{
    $characters = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $otp;
}

function sendEmail($email)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "nechmastudio@gmail.com";
    $mail->Password = "qxzr xycs wybs jowo";
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('nechmastudio@gmail.com'); /* Sender */
    $mail->addAddress($email); /* Receiver */
    $mail->isHTML(true);

    $otp = generateOTP();

    $mail->Subject = 'Nechma Studio Password Recovery OTP';
    // prettier-ignore
    $mail->Body = "
Dear $email,<br><br>

We hope this message finds you well. If you've requested to recover your Nechma Studio account password, we're here to assist you.<br><br>

Your One-Time Password (OTP) for Nechma Studio is: [$otp]<br><br>

Please use this OTP to securely reset your password and regain access to your account. For security reasons, do not share this OTP with anyone.<br><br>

If you didn't initiate this password recovery or have any concerns, please reach out to our support team immediately at <a href='mailto:nechmastudio@gmail.com'>nechmastudio@gmail.com</a>.<br><br>

Thank you for entrusting Nechma Studio with your fashion choices. We're committed to ensuring a seamless and secure experience for our valued customers.<br><br>

Best regards,<br>
Nechma Studio Team<br>
<a href='http://www.nechma-studio.com'>www.nechma-studio.com</a>";

    if ($mail->send()) {
        $_SESSION['otp'] = $otp;
        return true;
    } else {
        return false;
    }
}
