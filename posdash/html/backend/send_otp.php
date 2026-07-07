<?php
session_start();

include "db.php";

$email = trim($_POST['email']);

$q = mysqli_query($conn,"SELECT * FROM register WHERE email='$email'");

if(mysqli_num_rows($q)==0)
{
    echo "Email not found";
    exit;
}

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST['email']))
{
    $email = trim($_POST['email']);

   
    $otp = rand(100000,999999);

    
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    $mail = new PHPMailer(true);

    try
    {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        
        $mail->Username = 'ayushhnipane@gmail.com';

        $mail->Password = 'vzoq jcra glkp fybw';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('ayushhnipane@gmail.com','POS Dashboard');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Password Reset OTP";
        $mail->Body = "
        <h2>Your OTP is</h2>
        <h1>$otp</h1>
        <p>This OTP is valid for 5 minutes.</p>
        ";

        $mail->send();

        echo "success";
    }
    catch(Exception $e)
    {
        echo $mail->ErrorInfo;
    }
}
?>