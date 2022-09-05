<?php

require "conexion.php";

$con=mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");

if(isset($_SESSION['usu_mail'])){
    $nomyape= $_SESSION['nombre'];
}
else{
    echo "ACCESO NO AUTORIZADO<br> DEBE INICIAR SESIÓN";
    echo '<meta http-equiv="Refresh" content="3; url=index.php">';
    exit();
}

$idResto = $_POST['idRestRes'];
$fecha=$_POST['fechaReserva'];
$mesa=$_POST['idMesaRes'];
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

<!-- botón Volver -->
<div class="boton-volver m-3">
    <a class="btn btn-outline-light" href="index.php">Volver</a>
</div>


<?php
$sqlCancelar = "UPDATE disponibilidad SET estado = false, usu_id = null
                WHERE fecha = '$fecha' and res_id = $idResto and idMesa = $mesa;";

$recordSetCancelar = mysqli_query($con, $sqlCancelar);

if(mysqli_affected_rows($con)>0){
    echo "<h5 class='textoPrinc'> Se ha cancelado la reserva. </h5>";
    echo '<meta http-equiv="Refresh" content="2; url=misReservas.php">';
}else{
    echo "<h5 class='textoPrinc'> No se ha podido cancelar la reserva. </h5>";
    echo '<meta http-equiv="Refresh" content="2; url=misReservas.php">';
}
?>


<?php
require "./layout/footer.php";
?>



</body>
</html>


