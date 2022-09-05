<?php

require "conexion.php";
$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");

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

if(isset($_POST['agrCat'])){
    $agrCat = $_POST['agrCat'];
    if($agrCat!=""){
        $sqlCat = "INSERT INTO categorias (descripcion) VALUES('$agrCat');";
        $resultCat = mysqli_query($con, $sqlCat);
    }if(mysqli_affected_rows($con)>0){
        echo "<br><h5 class='textoPrinc'> Se ha añadido con éxito la nueva Categoría. </h5>";
        echo '<meta http-equiv="Refresh" content="1; url=listaRestaurantes.php">';
    }else{
        echo "<br><h5 class='textoPrinc'> No se ha podido añadir la nueva Categoría. Intente nuevamente.</h5>";
        echo '<meta http-equiv="Refresh" content="3; url=listaRestaurantes.php">';
    }
}

if(isset($_POST['elimCat'])){
    $elimCat = $_POST['elimCat'];
    if($elimCat!=""){
        $sqlCatE = "DELETE FROM categorias WHERE id= $elimCat;";
        $resultCatE = mysqli_query($con, $sqlCatE);
    }if(mysqli_affected_rows($con)>0){
        echo "<br><h5 class='textoPrinc'> Se ha eliminado con éxito la Categoría seleccionada. </h5>";
        echo '<meta http-equiv="Refresh" content="1; url=listaRestaurantes.php">';
    }else{
        echo "<br><h5 class='textoPrinc'> No se ha podido eliminar la Categoría seleccionada. Intente nuevamente.</h5>";
        echo '<meta http-equiv="Refresh" content="3; url=listaRestaurantes.php">';
    }
}


if(isset($_POST['agrZona'])){
    $agrZona = $_POST['agrZona'];
    if($agrZona!=""){
        $sqlZona = "INSERT INTO zonas (descripcion) VALUES('$agrZona');";
        $resultZona = mysqli_query($con, $sqlZona);
    }if(mysqli_affected_rows($con)>0){
        echo "<br><h5 class='textoPrinc'> Se ha añadido con éxito la nueva Zona. </h5>";
        echo '<meta http-equiv="Refresh" content="1; url=listaRestaurantes.php">';
    }else{
        echo "<br><h5 class='textoPrinc'> No se ha podido añadir la nueva Zona. Intente nuevamente.</h5>";
        echo '<meta http-equiv="Refresh" content="3; url=listaRestaurantes.php">';
    }
}

if(isset($_POST['elimZona'])){
    $elimZona = $_POST['elimZona'];
    if($elimZona!=""){
        $sqlZonaE = "DELETE FROM zonas WHERE id= $elimZona;";
        $resultZonaE = mysqli_query($con, $sqlZonaE);
    }if(mysqli_affected_rows($con)>0){
        echo "<br><h5 class='textoPrinc'> Se ha eliminado con éxito la Zona seleccionada. </h5>";
        echo '<meta http-equiv="Refresh" content="1; url=listaRestaurantes.php">';
    }else{
        echo "<br><h5 class='textoPrinc'> No se ha podido eliminar la Zona seleccionada. Intente nuevamente.</h5>";
        echo '<meta http-equiv="Refresh" content="3; url=listaRestaurantes.php">';
    }
}


?>





<?php
require "./layout/footer.php";
?>

</body>
</html>