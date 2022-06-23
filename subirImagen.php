<?php

require "conexion.php";

$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div >
<form name="MiForm" id="MiForm" method="POST" action="subiendoImagen.php" enctype="multipart/form-data">
    <h4 >Seleccione imagen a cargar</h4>
    <label >Archivos</label>
    <div >
    <input type="file"  id="image" name="foto" multiple><br><br>
    </div>

    <label for="id_rest" >ID de restaurante a agregar imagen</label>
    <input id="id_rest" type="text" pattern="[0-9]{1,7}"  title="Solo números. Tamaño mínimo: 1, máximo: 7" required name="id_rest"><br><br>

    <button name="submit" class="btn btn-primary">Cargar Imagen</button>
      </form>
</div>











</body>
</html>