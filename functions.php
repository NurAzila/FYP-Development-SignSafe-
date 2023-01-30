<?php

require 'mail/phpmailer/PHPMailerAutoload.php';

function generateSecretKey() {
    $secret_key = '';
    for ($i = 0; $i < 16; $i++) {
        $secret_key .= chr(mt_rand(0, 255));
    }
    return bin2hex($secret_key);
}

function sendEmail($to, $subject, $message) {
  
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPDebug = 0;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465;
  $mail->IsHTML(true);
  $mail->Username = "unkwn.example@gmail.com";
  $mail->Password = "idovwysbwsuujygu";
  $mail->SetFrom("SignSafe");
  $mail->Subject = $subject;
  $mail->Body = $message;
  $mail->AddAddress($to);

  if (!$mail->Send()) {
    echo "Mail Not Sent";
  } else {
    echo "Mail Sent";
  }
}

function generateTwoFactorCode() {
  $totp = new \OTPHP\TOTP();
  return $totp->now();
}

function sendTwoFactorCode($to, $code) {
  $message = "Your verification code is: " . $code;
  sendEmail($to, 'Two-Factor Authentication', $message);
}
?>