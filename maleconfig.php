<?php
include_once('PHPMailer-master/PHPMailerAutoload.php');
include_once ('PHPMailer-master/class.phpmailer.php'); // path to the PHPMailer class
include_once ('PHPMailer-master/class.smtp.php');

function sendMale($to, $from, $from_name, $subject, $body) { 
    global $error;
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465; 
    $mail->Username = 'kambojgaurav27@gmail.com';  
    $mail->Password = 'kambojenbake'; 
    $mail->From = 'kambojgaurav27@gmail.com';
    $mail->FromName = 'admim';
   //$mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->IsHTML(true);
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        $error = 'Mail error: '.$mail->ErrorInfo; 
        return false;
    } else {
        $error = 'Message sent!';
        return true;
    }
}