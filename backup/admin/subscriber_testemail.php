<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
  
$email="hemu.625@gmail.com";   

$subject = "Testing Email Bollywood Product";
 
$message = "<html>
<head>
<title>Testing Email Bollywood Product</title>
</head>
<body>
<p>Hello User,<br>

This is Sample Test Mail from Bollywood Product <br><br> <br><br>
 </p>
<table> 
<tr>
  
<tr>
<td colspan='2'><br><b>If this was you, you can safely disregard this e-mail. <br>
Team Bollywood Product</b></td> 
</tr>
</table>
</body>
</html>
";
 

 


$mail = new PHPMailer; 
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
$mail->Password = '5`+1@i5$J#u1';
$mail->SMTPDebug  = 1;
$mail->send();  


 

 
 ?>
