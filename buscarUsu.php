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


$sqlVerifica="select * from usuarios where email='$mail';";

$resulset=mysqli_query($con, $sqlVerifica);

$registro=mysqli_fetch_assoc($resulset);



if(mysqli_affected_rows($con)>0){

    $usu=$registro['email'];
    $contras= $registro['contra'];
    $nomyape= $registro['nombre']." ".$registro['apellido'];
    $idUsuario= $registro['id'];
    $rol= $registro['rol_id'];
    //verifico pass
    if($registro['contra']==$contra){
        session_start();
        ?>
        <!-- <div>
        <h3 class='centrar mt-3 textoPrinc'> Iniciando sesión <h3>
        </div> -->
        <?php
        //cargar variables de sesion
        $_SESSION['usu_mail']=$usu;
        $_SESSION['nombre_completo']=$nomyape;
        $_SESSION['idUsuario']= $idUsuario;
        $_SESSION['rol'] = $rol;
        ?>
    <meta http-equiv="Refresh" content="2; url=index.php">

<?php
    }


}
else{
    ?>
    <div>
    <h3 class='centrar mt-3 textoPrinc'> No existe el usuario <?php echo $mail ?> <h3>
    </div>
    <?php
    echo '<meta http-equiv="Refresh" content="2; url=index.php">';
}

?>

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
if(isset($_SESSION['usu_mail'])){ ?>
    <div>
    <h3 class='centrar mt-3 textoPrinc'> Iniciando sesión <h3>
    </div>



<?php
}    else{
    ?>
    <div>
        <h3 class='centrar mt-3 textoPrinc'> La contraseña es incorrecta <h3>
    </div>
    <?php
        echo '<meta http-equiv="Refresh" content="2; url=index.php">';
    }


?>


<?php
require "./layout/footer.php";
?>


</body>
</html>