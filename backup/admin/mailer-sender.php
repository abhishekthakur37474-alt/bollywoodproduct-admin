<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php"; 
  

include_once "config.php";
function sendEmail($to, $subject, $title, $message){
// Include PHPMailer library

   global $con;
// Create a new instance of PHPMailer
$mail = new PHPMailer(true);
$email=$to; 
//$email="iwebstechnology@gmail.com";
//$subject="Welcome to iWebs Technology";
try {
 

 

$mail->setFrom('noreply@bollywoodproduct.com', 'Bollywood Product');
$mail->addAddress($email);
$mail->Subject = $subject;
$mail->isHTML(TRUE);
$mailContent = $message;
$mail->Body = $mailContent;
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPAutoTLS = false;
$mail->Host = 'bollywoodproduct.com';
$mail->Port = '587';
$mail->Username = 'noreply@bollywoodproduct.com';
$mail->Password = 'Hem@nt$Mailer';
$mail->SMTPDebug  = 2;


    mysqli_query($con, "INSERT INTO email_logs (email_to, subject, title, message, email_date)    VALUES ('$email', '$subject', '$title', '$message',  now())") or die(mysqli_error($con));

$id=mysqli_insert_id($con);  
    ob_start();
    include 'mailer-design.php'; // Path to your email template file
    $emailContent = ob_get_clean();
    $mail->Body = $emailContent;

    // Send the email
    $mail->send();

    return 1;
   // echo 'Email has been sent successfully.';
} catch (Exception $e) {
    return 0;
    //echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}


?>