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

    $mail->Subject = 'Password Recovery';
    $mail->Body = "<h1>OTP: <span class='underline'>$otp</span></h1>";

    if ($mail->send()) {
        echo "Successfully Sent to your email.";
        $_SESSION['otp'] = $otp;
        return true;
    } else {
        echo 'Something went wrong.';
        return false;
    }
}
