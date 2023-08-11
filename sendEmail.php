<?php

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

    class sendEmail 
    {
        public function send($code) // function for email verification
        {

        // create object of PHPMailer class with boolean parameter which sets/unsets exception.

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP(); // using SMTP protocol

            $mail->Host = '[YOUR_HOSTNAME]'; // SMTP host

            $mail->SMTPAuth = true;  // enable smtp authentication

            $mail->Username = '[USERNAME]';  // sender host username

            $mail->Password = '[PASSWORD]'; // sender host password

            $mail->SMTPSecure = 'tls';  // for encrypted connection

            $mail->Port = 587;   // port for SMTP

            $mail->isHTML(true);

            $mail->setFrom('sender@gmail.com', "Sender"); // sender's email and name

            $mail->addAddress('receiver@gmail.com', "Receiver");  // receiver's email and name
            
            $mail->Subject = 'Email verification';

            $mail->Body    = 'Please click this link to verify your account: <a href=http://localhost/website_reg/verify.php?code='.$code.'>Verify</a>';

            $mail->send();
            } 

            catch (Exception $e)
            {
                echo 'Message could not be sent. Mailer Error: {$mail->ErrorInfo} <br>';
            }

        }

        public function send_token($token, $email) // function for password reset
        {

        // create object of PHPMailer class with boolean parameter which sets/unsets exception.

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP(); // using SMTP protocol

            $mail->Host = '[YOUR_HOSTNAME]'; // SMTP host

            $mail->SMTPAuth = true;  // enable smtp authentication

            $mail->Username = '[USERNAME]';  // sender host username

            $mail->Password = '[PASSWORD]'; // sender host password

            $mail->SMTPSecure = 'tls';  // for encrypted connection

            $mail->Port = 587;   // port for SMTP

            $mail->isHTML(true);

            $mail->setFrom('sender@gmail.com', "Sender"); // sender's email and name

            $mail->addAddress('receiver@gmail.com', "Receiver");  // receiver's email and name
            
            $mail->Subject = 'Password Reset';

            $mail->Body    = 'Please click this link to reset your password: <a href=http://localhost/website_reg/reset-password?token='.$token.'&email='.$email.'>Reset Password</a>';

            $mail->send();
            } 

            catch (Exception $e)
            {
                echo 'Message could not be sent. Mailer Error: {$mail->ErrorInfo} <br>';
            }

        }

    }

$sendMl = new sendEmail();

?>