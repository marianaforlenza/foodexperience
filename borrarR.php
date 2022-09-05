<?php

require "conexion.php";
$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");

$id = $_POST['id'];

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
echo $id;

$con1 = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");
$sqlDelete1= "DELETE FROM calificaciones WHERE rest_id= $id;";
$resultDelete1= mysqli_query($con1, $sqlDelete1);
if(mysqli_affected_rows($con1)>0){
    echo "<h5 class='textoPrinc'>Se eliminaron las entradas en Calificaciones</h5>";
}else{
    echo "<h5 class='textoPrinc'>No se pudieron eliminar las calificaciones del restaurante. Intente nuevamente.</h5>";
}

$con2 = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");
$sqlDelete2="DELETE FROM disponibilidad WHERE res_id= $id;";
$resultDelete2= mysqli_query($con2, $sqlDelete2);
if(mysqli_affected_rows($con2)>0){
    echo "<h5 class='textoPrinc'>Se elimó al restaurante de la lista de reservas</h5>";
}else{
    echo "<h5 class='textoPrinc'>No se pudo eliminar al restaurante de la lista de reservas. Intente nuevamente.</h5>";
}


$sqlDelete="DELETE FROM restaurantes WHERE restaurantes.id= $id;";
$resultDelete= mysqli_query($con, $sqlDelete);
if(mysqli_affected_rows($con)>0){
    echo "<h5 class='textoPrinc'>El restaurante ha sido borrado con éxito.</h5>";
    echo '<meta http-equiv="Refresh" content="1; url=listaRestaurantes.php">';
}else{
    echo "<h5 class='textoPrinc'>No se pudo eliminar el restaurante. Intente nuevamente.</h5>";
    echo '<meta http-equiv="Refresh" content="1; url=listaRestaurantes.php">';
}
?>

<?php
require "./layout/footer.php";
?>

</body>
</html>

