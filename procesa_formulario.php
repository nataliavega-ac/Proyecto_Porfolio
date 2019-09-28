<?php

// Tomamos las variables 
$opcion = isset($_POST["nombre"])?$_POST["nombre"]:'';
$opcion = isset($_POST["email"])?$_POST["email"]:'';
$opcion = isset($_POST["mensaje"])?$_POST["mensaje"]:'';


date_default_timezone_set('Etc/UTC');
require 'clases/PHPMailerAutoload.php';

//Crea una instancia del mail
$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';


//Configuración de SMTP
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0; 

//-------- Configuraciones del correo ---------------------------------------------
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->Username = "mi_mail@gmail.com";  // acá va una cuenta de correo real
$mail->Password = "mi_password"; // acá va tu password real


$mail->setFrom('mi_mail@gmail.com', 'Notificación desde Mi página'); // Muestra quien envia
$mail->addReplyTo('mi_mail@gmail.com', 'Notificación desde Mi página'); // Mail de respuesta
 
// Email de DESTINO del formulario
$mail->AddAddress('mi_mail@gmail.com');
 
//Contenido del subject
$mail->Subject = 'Consulta desde formulario de mi página';

// Cuerpo del mail
$mail->Body = '<h3 align="center"><u> Consulta desde el formulario de mi página </h3></u>' .
'<p><b> Nombre: </b>' . $nombre . '<p>' .
'<p><b> Email: </b>' . $email . '<p>' .
'<p><b> Mensaje: </b>' . $mensaje . '<p>';

// Formatea al mail
$mail->AltBody = 'pbody';

// Envía el correo
if (!$mail->send()) {
  // Si salió todo bien devuelve
  echo json_encode("Mailer Error: " . $mail->ErrorInfo);

} else {
    // Si algo falló devuelve
    echo json_encode("ok");
}


?>