<?php 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->SMTPKeepAlive = true;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';

$mail->Port = 587;
$mail->Host = 'smtp.hmail.com';

$mail->Username='yusufcan57ycee@gmail.com';
$mail->Password='qtmmfvfaqwsyiabv';

$mail->setFrom(address:"yusufcan57ycee@gmail.com",name:"group_arge");
$mail->addAddress(address:"yusufcan57yce@gmal.com",name:"Yusuf Can Yüce");

$mail->isHTML(true);
$mail->Subject = "GMAİL SMTP ORNEĞi";
$mail->Body="<h1>MERHABA YUSUF CAN</h1> <p>bu bir denmedir</p>";
$mail->addAttachment(path:"dosya.txt");
if($mail->send()){
    echo "mail göndermi başarılı";
}else{
    echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
}

?>