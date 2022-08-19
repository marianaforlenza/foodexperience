<?php
require "conexion.php";
$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");
$correo = $_POST['correo'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$getUsuario = "SELECT * FROM usuarios WHERE email='$correo';";
$resultUsuario = mysqli_query($con, $getUsuario);
if(mysqli_affected_rows($con)>0){

    $datos = mysqli_fetch_array($resultUsuario);
    $nombre = $datos['nombre'];
    $contra = $datos['contra'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'foodexperiencearg@gmail.com';                     //SMTP username
        $mail->Password   = 'lnaoonhqvrcfcdzi';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('foodexperiencearg@gmail.com', 'Food Experience');
        $mail->addAddress($correo);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperacion de password - Food Experience';
        $mail->Body    = 'Hola '.$nombre.'. Su contraseña es '. $contra .'<br> 
        Para recuperar tu contraseña haz clic en el siguiente enlace: Enlace.<br>
        Si no has intentado recuperar tu contraseña, <b>ignora este mensaje.</b>';
        $mail->AltBody = 'Hola '.$nombre.'. Para recuperar tu contraseña haz clic en el siguiente enlace: Enlace.
        Si no has intentado recuperar tu contraseña, ignora este mensaje.';

        $mail->send();
        echo 'El mail ha sido enviado';
    } catch (Exception $e) {
        echo "Ha ocurrido un problema al enviar el mail. Error: {$mail->ErrorInfo}";
    }
}else{
    echo "El usuario introducido no pertenece a un usuario registrado.";
}








?>