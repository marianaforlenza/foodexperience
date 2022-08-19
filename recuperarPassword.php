<?php

require "conexion.php";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        <!-- css bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="cssGrid.css">

</head>
<body>
    
<?php
require "./layout/header.php";
?>


<form action="enviarMail.php" method="post" class="textoPrinc">
 <h5 class="textoPrinc"> Ingrese su correo electrónico así le enviamos un mail para que pueda recuperar su contraseña </h5><br>   
<input type="text" class="tamanio-form" name="correo" placeholder="Ingrese su mail" required>
<input type="submit" class="btn btn-primary btn-sm" value="Enviar mail">
</form>


<?php
require "./layout/footer.php";
?>

</body>
</html>








