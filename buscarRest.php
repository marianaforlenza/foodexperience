<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
   
   $fecha=$_POST['fecha'];
   $zona=$_POST['zona'];
   $comensales=$_POST['comensales'];
   
   
   // echo "La fecha seleccionada es $fecha<br>";
    //echo "La zona seleccionada es $zona<br>";
    //echo "Los comensales seleccionados son $comensales<br>";
    
    require "conexion.php";
    
    $con=mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die("no se pudo conectar a la BD");
 
     
    $sqlBuscarRest="select * from restaurantes INNER join disponibilidad where disponibilidad.fecha='$fecha' and  disponibilidad.cant_comensales >= $comensales and restaurantes.zon_id = $zona and disponibilidad.estado = false";

    $resultRest=mysqli_query($con,$sqlBuscarRest);

    if(mysqli_affected_rows($con)>0){
        echo "Se encontro el rest<br><br>";
    }
    else{
        echo "<h3>No se encontró producto con el código $codigoBuscado<h3><br><br>";
    }
?>
