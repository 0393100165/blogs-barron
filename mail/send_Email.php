<?php
  echo "OK SENT";
  echo("<script>console.log('PHP: " . $email . "');</script>");
  
require '\PHPMailer\autoload.php';
require '\PHPMailer\PHPMailer.php';
require '\PHPMailer\Exception.php';
require '\PHPMailer\SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$alert = '';


if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
   

  try{  
    $mail->isSMTP();
    $mail->Mailer = "smtp";
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'person290421@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'Nvt.123abc'; // Gmail address Password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 587;

    $mail->setFrom('person290421@gmail.com'); // Gmail address which you used as SMTP server
    $mail->addAddress('person290421@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

    $mail->isHTML(true);
    $mail->Subject = 'Message Received (Contact Page)';
    $mail->Body = "<h3>Name : $name <br>Email: $email <br>Message : $message</h3>";

    if($mail->send()) {
      $response = "email is sent";
    }
    else {
      $response ='email is not sent';
    }
    $alert = '<div class="alert-success">
                 <span>Message Sent! Thank you for contacting us.</span>
                </div>';
  } catch (Exception $e){
    $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
  }

?>