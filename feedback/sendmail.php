<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->IsHTML(true);

$mail->setFrom('kamalov.alb2000@mail.ru');
$mail->addAddress('kamalov.alb2000@mail.ru');
$mail->Subject = 'kamalov.alb2000@mail.ru send';

$body = 'Ура! У тебя новый гость:';

if(trim(!empty($_POST['name']))){
    $body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['message']))){
    $body.='<p><strong>Message:</strong> '.$_POST['message'].'</p>';
}

$mail->Body = $body;

if(!$mail->send()) {
    $message = 'Ошибка';
} else {
    $message = 'Данные отправлены';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>
