<?php

session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo '<meta http-equiv="Refresh" content="0; url=index.php">';
}
?>

<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Experience</title>

    <!-- css bootstrap -->
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
    $mail= $_SESSION['usu_mail'];
    
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

  require "conexion.php";
  $idResto2=$_POST['idResto2'];
  $idmesa2=$_POST['idmesa2'];
  $fecha2=$_POST['fecha2'];
  $nombreResto2=$_POST['nombreresto2'];

  $con=mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die("no se pudo conectar a la BD");

  $sqlBuscarUsu="select id from usuarios where email ='$mail'";

  $resultBuscarUsu =mysqli_query($con, $sqlBuscarUsu);
 
  $registro=mysqli_fetch_assoc($resultBuscarUsu);
 
     if(mysqli_affected_rows($con)>0) 
     {
       $idusu=$registro['id'];
     }

  $con=mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die("no se pudo conectar a la BD");

  $sqlconsulta="update Disponibilidad 
                   set estado = true ,
                       usu_id = $idusu
                 where res_id = $idResto2
                   and idMesa = $idmesa2
                   and fecha  = '$fecha2';";

$resulset=mysqli_query($con,$sqlconsulta);

if(mysqli_affected_rows($con)>0) 
{
    echo '<font color="black"> Reserva efectuada con exito.</font><br><br>';
}
else{    
    echo '<font color="black"> La reserva no ha sido realizada.</font><br><br>'; 
}

  ?> 

<body>

<a href=index.php><input type=button value="Volver"></a> </form>

</body>
         
<!-- js bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
 integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>
</html>