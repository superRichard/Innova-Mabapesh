<?php
$un=$_POST['username'];
$em=$_POST['useremail'];
$su=$_POST['useresubject'];
$msg=$_POST['mesg'];
$correoequipobamapesh = 'davidhsc@gmail.com';
if(trim($un)!="" && trim($msg)!="" && trim($su)!="" && trim($em)!="")
{
	if(filter_var($em, FILTER_VALIDATE_EMAIL))
	{
		$message="Estimado equipo Mabapesh<p>".$un."(".$em.") ha enviado un mensaje desde el formulario de contacto. "."</p><p>Asunto:".$su."<br>mensaje : ".$msg."</p>";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <support@transport.com>' . "\r\n";

		if(mail($correoequipobamapesh,'Mensaje desde formulario de contacto',$message,$headers ))
		{
		echo '1#<p style="color:green;">Correo enviado exitosamente. En breve nos ponemos en contacto.</p>';
		}
		else
		{
		echo '2#<p style="color:red;">Por favor intente nuevamente.</p>';
		}
	}
	else
		echo '2#<p style="color:red">Por favor proporcione un correo válido.</p>';
}
else
{
echo '2#<p style="color:red">Por favor proporcione todos los datos.</p>';
}?>