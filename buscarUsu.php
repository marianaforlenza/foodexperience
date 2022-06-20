<?php

require "conexion.php";

$mail=$_POST['mail'];
$contra=$_POST['contra'];

// por si alguien ingresa a esta url desde la barra de navegación
if($_POST['mail']==""){
    echo "ACCESO NO AUTORIZADO";
    echo '<meta http-equiv="Refresh" content="0; url=index.php">';
    exit();
}

$con=mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");


$sqlVerifica="select * from usuarios where usu_email='$mail';";

$resulset=mysqli_query($con, $sqlVerifica);

$registro=mysqli_fetch_assoc($resulset);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Food Experience - Registro</title>

   <link rel="stylesheet" href="estilos.css">
</head>
<body>
   
<!-- header -->
<header >
    <!-- logo izq -->
    <div class="logo">
        <img src="./imagenes/logo.png">
    </div>
    <!-- título central -->
    <div class="titulo">
        <h1 class="centrar">Food Experience</h1>
    </div>
    <!-- loggin -->
    <div class="loguearse">
        <p> </P>
    </div>
</header>

<?php

if(mysqli_affected_rows($con)>0){
    //echo "<br><br><h3 class='centrar'> Se encontró el usuario <h3>";

    $usu=$registro['usu_email'];
    $contras= $registro['usu_contra'];
    $nomyape= $registro['usu_nombre']." ".$registro['usu_apellido'];
    $id= $registro['usu_id'];
    //verifico pass
    if($registro['usu_contra']==$contra){
        session_start();
        ?>
        <div>
        <h3 class='centrar mt-3'> Iniciando sesión <h3>
        </div>
        <?php
        //cargar variables de sesion
        $_SESSION['usu_mail']=$usu;
        $_SESSION['nombre_completo']=$nomyape;  
        ?>
    <meta http-equiv="Refresh" content="2; url=index.php">

<?php
    }
    else{
    ?>
    <div>
        <h3 class='centrar mt-3'> La contraseña es incorrecta <h3>
    </div>
    <?php
        echo '<meta http-equiv="Refresh" content="2; url=index.php">';
    }

}
else{
    ?>
    <div>
    <h3 class='centrar mt-3'> No existe el usuario <?php echo $mail ?> <h3>
    </div>
    <?php
    echo '<meta http-equiv="Refresh" content="2; url=index.php">';
}

?>

<!-- footer -->
<footer>
  <!-- parte izquierda -->
  <div class="item-footer">
    <p> </p>
  </div>
    <!-- parte centro -->
  <div class="item-footer centrar">
    <p> Hecho con <i class="bi bi-suit-heart-fill" style="font-size:0.8rem; color:red"></i></p>
    <p> por Vale, Maru y Jair<p>
  </div>
  <!-- parte derecha -->
  <div class="item-footer derecha">
    <a href="#">
      <i class="bi bi-github" style="font-size:2rem; color:white"></i>
      </a>
    <a href="">
      <i class="bi bi-whatsapp" style="font-size:2rem; color:green"></i>
    </a>
    <a href="#">
      <i class="bi bi-envelope" style="font-size:2rem; color:black"></i>
    </a>
  </div>

  </footer>




</body>
</html>