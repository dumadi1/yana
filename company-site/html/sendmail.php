<?php
require('/var/www/company-site/html/phpmailer/class.phpmailer.php');
require('/var/www/company-site/html/phpmailer/class.smtp.php');

//Load Composer's autoloader
require('PHPMailerAutoload.php');

if(isset($_POST['subject']) && isset($_POST['name']) && isset($_POST['message']) && isset($_POST['email'])){
  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'partnership-outreach@yanaenergysolutions.com';                     //SMTP username
      $mail->Password   = 'OUxFpTqITyS0VVggOLw1TSxLJr2Qw2hGXsei3GwkELU242epv5';                               //SMTP password
      $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom("no-reply@yanaenergysolutions.com", $_POST['name']);
      $mail->addAddress('partnership-outreach@yanaenergysolutions.com', 'Outreach');     //Add a recipient
      $mail->addReplyTo($_POST['email'], $_POST['name']);

      //Content
      $mail->isHTML(false);                                  //Set email format to HTML
      $mail->Subject = $_POST['name']." - ".$_POST['subject'];
      $mail->Body    = $_POST['message'];
      $mail->AltBody = $_POST['message'];

      $mail->send();
      echo 'sent';
  } catch (Exception $e) {
      echo "failed";
  }
}

?>
