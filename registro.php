<?php




require "conexion.php";

$email=$_POST['email'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$contra=$_POST['contra'];
$contra2=$_POST['contra2'];
$tel=$_POST['tel'];

// por si alguien ingresa a esta url desde la barra de navegación
if($_POST['email']==""){
    echo "ACCESO NO AUTORIZADO";
    echo '<meta http-equiv="Refresh" content="0; url=index.php">';
    exit();
}

//echo $email;


 $con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");
//  comprobando si el email ya está en uso
 $sqlVerifica="select * from usuarios where email='$email';";

 $resultadoset=mysqli_query($con, $sqlVerifica);
?>

<!-- hacer un  if para comparar contra 1 y contra 2 -->



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
// mensaje si el mail ya está en uso
if(mysqli_affected_rows($con)>0){
    echo "<h3 class='centrar mt-3'> El correo electrónico <?php echo $email ?> ya está en uso. <h3>";
    echo "<br><h3 class='centrar'> Intente con otro.<h3>";
    ?>
    <meta http-equiv="Refresh" content="4; url=formRegistro.php">
<?php
    }
    // si no está en uso
    else{
        $sql= "INSERT into usuarios (nombre, apellido, email, contra, cel)
        values ('$nombre','$apellido','$email','$contra','$tel');";

        $resulset= mysqli_query($con,$sql);

        if (mysqli_affected_rows ($con)>0){

            ?>
            <div>
             <h3 class='centrar mt-3'> El usuario <?php echo $email ?> se registró correctamente </h3>  
            </div>
             <meta http-equiv="Refresh" content="2; url=index.php"> 
                
            <?php    
            }
            else{   
               ?>
            <div>
            <h3 class='centrar mt-3'> El usuario <?php echo $email ?> no se pudo registrar </h3>
            </div>
            <meta http-equiv="Refresh" content="2; url=index.php">  
                
            <?php 
            }       
    }
?>




  <footer>  <!-- footer -->
  <!-- parte izquierda -->
  <div class="item-footer">
    <p> </p>
  </div>
    <!-- parte centro -->
  <div class="item-footer centrar">
    <p> Hecho con <i class="bi bi-suit-heart-fill" style="font-size:0.8rem; color:red"></i>
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