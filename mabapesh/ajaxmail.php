<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/Exception.php';
require './phpmailer/PHPMailer.php';
require './phpmailer/SMTP.php';

$un=$_POST['username'];
$em=$_POST['useremail'];
$su=$_POST['useresubject'];
$msg=$_POST['mesg'];

if(trim($un)!="" && trim($msg)!="" && trim($su)!="" && trim($em)!="")
{
	if(filter_var($em, FILTER_VALIDATE_EMAIL))
	{
		$message="Estimado equipo Mabapesh<p>".$un."(".$em.") ha enviado un mensaje desde el formulario de contacto. "."</p><p>Asunto:".$su."<br>Mensaje : ".$msg."</p>";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <support@transport.com>' . "\r\n";

		// Envío de correo
		try {
			// Configuración del servidor de correo usando PHPMailer.
			$mail = new PHPMailer(true);
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->isSMTP();
			$mail->SMTPAuth   = true;
			$mail->Host       = 'mail.logisticamabapesh.com';
			$mail->Username   = 'noreplay@logisticamabapesh.com';
			$mail->Password   = 'Nor@170821';
			$mail->SMTPSecure = 'ssl';
			$mail->Port       = 465;

			// Establecer los destinatarios del correo.
			$mail->setFrom('noreplay@logisticamabapesh.com', 'Notificaciones Mabapesh');
			$mail->addAddress('notificaciones@logisticamabapesh.com');
			$mail->addBCC('noreplay@logisticamabapesh.com');
			$mail->addBCC('mgacarrera@gmail.com');
			//$mail->addBCC('hsgc5701@gmail.com');
			$mail->addReplyTo($em);

			// Configuración del contenido del correo.
			$mail->isHTML(true);
			$mail->Subject = 'Mensaje de contacto enviado por ' . $un . '.';
			$mail->Body    = $message;
			$mail->CharSet = 'UTF-8';

			$mail->send();

			echo '1#<p style="color:green;">Correo enviado exitosamente. En breve nos ponemos en contacto.</p>';

		} catch (Exception $exception) {
			error_log('Error al enviar correo: ' . $mail->ErrorInfo);
			echo '2#<p style="color:red;">Por favor intente nuevamente. ' . $exception . '</p>';
		}
	}
	else
		echo '2#<p style="color:red">Por favor proporcione un correo válido.</p>';
}
else
{
echo '2#<p style="color:red">Por favor proporcione todos los datos.</p>';
}?>