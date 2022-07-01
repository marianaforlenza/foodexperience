<?php
session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo '<meta http-equiv="Refresh" content="0; url=index.php">';
}

require "conexion.php";

$idResto = $_POST['idResto'];
$fecha=$_POST['fecha'];
$comensales=$_POST['comensales'];
$mesa=$_POST['mesa'];

$con=mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");

$restoSelec="SELECT *
            FROM restaurantes 
            INNER JOIN disponibilidad
            WHERE disponibilidad.fecha='$fecha' AND 
            disponibilidad.idMesa = $mesa AND
            restaurantes.id = $idResto AND
            disponibilidad.estado = false AND
            disponibilidad.res_id =$idResto AND
            restaurantes.id = disponibilidad.res_id;";

$resultRest = mysqli_query($con, $restoSelec);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    
<!-- header -->
<header>
  <!-- logo -->
    <div class="logo">
      <a href="index.php">
        <img src="./imagenes/logo.png">
      </a>
    </div>
  <!-- título central -->
    <div class="titulo">
        <h1 class="centrar">Food Experience</h1>
    </div>

<?php //comprobando si ya inició sesión
  if(isset($_SESSION['usu_mail'])){
    $nombreCompleto= $_SESSION['nombre_completo'];
?>
  <div class="loguearse">
    <div class="derecha">
      <p>Bienvenida/o <?php echo $nombreCompleto ?></p>
    </div>
    <div class="contra-registro">
      <!-- botón de Cerrar sesión -->
      <a href="index.php?logout"><button class="btn btn-outline-secondary mr-2">Cerrar Sesión</button></a>
    </div>
  </div>
<?php
}else{
?>
    <!-- pantalla de login -->
    <div class="loguearse">
      <div>
        <form class="derecha" action="buscarUsu.php" method="post">
        <input type="text" class="tamanio-form" name="mail" placeholder="Ingrese su mail" required>
        <input type="password" class="tamanio-form" name="contra" placeholder="Ingrese su Contraseña" required>
        <input type="submit" class="btn btn-primary btn-sm" value="Iniciar Sesión">
        </form>
      </div>
      <!-- olvidé mi contraseña -->
      <div class="contra-registro">
        <div class="olvide-contra mr-5">
          <a href=""> Olvidé mi contraseña </a>
        </div>
        <div>   <!-- botón Registrarse -->
          <form class="derecha" action="formRegistro.php">
            <input type="submit" class="btn btn-outline-primary btn-sm" value="Registrarse">
          </form>
        </div>
      </div>
    </div>
<!-- cierre del else -->
<?php
}
?>
</header>

<?php

$campos = mysqli_fetch_array($resultRest);
$nombreResto = $campos[1];
$fecha = $campos['fecha'];
$idRestoRes = $campos[0];
$idMesa = $campos['idMesa'];

?>

<img class="card-img-top" width="600px" height="560px" src="data:<?php echo $campos['tipoImagen']; ?>;base64,<?php echo base64_encode($campos['imagenPrincipal']);?>">

<?php


echo "<br><h4 class='centrar divCol' > ¿Desea confirmar la reserva en el restaurante $nombreResto para el día $fecha? </h4> <br>";
?>


<form method=post class="centrar"> 
    <input type=hidden name="fechaReserva" value=<?php echo $fecha ?>>
    <input type=hidden name="idRestRes" value=<?php echo $idRestoRes ?>>
    <input type=hidden name="idMesaRes" value=<?php echo $idMesa ?>>
    <input class="btn btn-success" type=submit value="Si" formaction=reserva.php>
    <input class="btn btn-danger"type=submit value="No" formaction=index.php>
</form>

















</body>
</html>