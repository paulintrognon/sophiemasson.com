<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Document sans titre</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?php
require("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsMail(); 
$mail->From = "commandes@dickson-constant.com";
$mail->FromName = "Dickson Constant";
$mail->AddAddress("arno_job@yahoo.fr");

$mail->Subject = "premiers essais";
$mail->Body = "<strong>hi ! </strong><br /> this is First mailing I made myself with <em>PHPMailer !</em>";
$mail->AltBody = "hi ! \n\n this is First mailing I made myself with PHPMailer !";
$mail->WordWrap = 50;

if(!$mail->Send())
{
   echo "Message was not sent";
   echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
   echo "Message has been sent";
}
?>
</body>
</html>
