<?php
require_once 'lib/lib.mailgun_mail.php';
require_once 'lib/email-templates.php';
$name="subha";
$pass="abcd";
$email="dsubhajit88@gmail.com,subhajitctm@gmail.com";
$mail = new mailgun_mail();
$mail->setBody(students_add_email_template($name,APP_URL,$pass));
$mail->setSubject("Placement Cell Registration");
$mail->setTo($email);
$res = $mail->send_mail();
echo var_dump($res);

?>
