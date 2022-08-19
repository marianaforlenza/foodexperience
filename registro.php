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



<?php
// mensaje si el mail ya está en uso
if(mysqli_affected_rows($con)>0){
    echo "<h3 class='centrar mt-3 textoPrinc'> El correo electrónico <?php echo $email ?> ya está en uso.<br> Intente con otro.<br> <h3>";
    ?>
    <meta http-equiv="Refresh" content="2; url=formRegistro.php">
<?php
    }
    // si no está en uso
    else{
        $sql= "INSERT into usuarios (nombre, apellido, email, contra, cel, rol_id)
        values ('$nombre','$apellido','$email','$contra','$tel', 2);";

        $resulset= mysqli_query($con,$sql);

        if (mysqli_affected_rows ($con)>0){

            ?>
            <div class="textoPrinc">
             <h3 class='centrar mt-3'> El usuario <?php echo $email ?> se registró correctamente </h3>  
            </div>
             <meta http-equiv="Refresh" content="2; url=index.php"> 
                
            <?php    
            }
            else{   
               ?>
            <div class="textoPrinc">
            <h3 class='centrar mt-3'> El usuario <?php echo $email ?> no se pudo registrar </h3>
            </div>
            <meta http-equiv="Refresh" content="2; url=index.php">  
                
            <?php 
            }       
    }
?>

  

<?php
require "./layout/footer.php";
?>

   
</body>
</html>