<?php

session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo '<meta http-equiv="Refresh" content="0; url=index.php">';
}

if($_SESSION['rol']!=1){
    echo "ACCESO NO AUTORIZADO";
    echo '<meta http-equiv="Refresh" content="1; url=index.php">';
    exit();
}

require "conexion.php";
$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");

if(isset($_POST['idRest'])){
$id= $_POST['idRest'];
$sqlDesactivar = "UPDATE restaurantes SET estado=false WHERE id=$id;";
$resultDesactivar = mysqli_query($con, $sqlDesactivar);
echo '<meta http-equiv="Refresh" content="0; url=listaRestaurantes.php">';
}

if(isset($_POST['idResto'])){
$idR= $_POST['idResto'];
$sqlActivar = "UPDATE restaurantes SET estado=true WHERE id=$idR;";
$resultActivar = mysqli_query($con, $sqlActivar);
echo '<meta http-equiv="Refresh" content="0; url=listaRestaurantes.php">';
}

?>
