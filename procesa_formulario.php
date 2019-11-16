<?php

// Tomamos las variables 
$nombre = isset($_POST["nombre"])?$_POST["nombre"]:'';
$email = isset($_POST["email"])?$_POST["email"]:'';
$mensaje = isset($_POST["mensaje"])?$_POST["mensaje"]:'';


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
$mail->Username = "wehelp.dev@gmail.com";  // acá va una cuenta de correo real
$mail->Password = "Faq23jl45"; // acá va tu password real


$mail->setFrom('wehelp.dev@gmail.com', 'Notificación desde We Help'); // Muestra quien envia
$mail->addReplyTo('wehelp.dev@gmail.com', 'Notificación desde We Help'); // Mail de respuesta
 
// Email de DESTINO del formulario
$mail->AddAddress('vera.sonia3@gmail.com');
 
//Contenido del subject
$mail->Subject = 'Consulta desde formulario de We Help';

// Cuerpo del mail
$mail->Body = '<h3 align="center"><u> Consulta desde el formulario de We Help </h3></u>' .
'<p><b> Nombre: </b>' . $nombre . '<p>' .
'<p><b> Email: </b>' . $email . '<p>' .
'<p><b> Mensaje: </b>' . $mensaje . '<p>';

// Formatea al mail
$mail->AltBody = 'pbody';

// Envía el correo
if (!$mail->send()) {
    
    // Si algo falló devuelve
    echo json_encode("Mailer Error: " . $mail->ErrorInfo);
  

} else {
  
    // Si salió todo bien devuelve
  echo json_encode("ok");  
}


?>