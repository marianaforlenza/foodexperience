<?php

session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo '<meta http-equiv="Refresh" content="0; url=index.php">';
}

require "conexion.php";

$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");

if($_SESSION['rol']!=1){
    echo "ACCESO NO AUTORIZADO";
    echo '<meta http-equiv="Refresh" content="1; url=index.php">';
    exit();
}

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

<?php

// Última fecha agregada a la BD
$traerFechaMax = "SELECT * FROM disponibilidad WHERE fecha = (SELECT MAX(fecha) FROM disponibilidad);";
$resultFechaMax= mysqli_query($con, $traerFechaMax);
if(mysqli_affected_rows($con)>0){
    $datos = mysqli_fetch_array($resultFechaMax);
    $fechaMax = $datos['fecha'];

    // Sumándole 1 día a la última fecha de la BD
    $fechaMax1 = DateTime::createFromFormat('Y-m-d', $fechaMax);	// pasando a date
    $fechaMax1->add(new DateInterval('P1D'));	//aumentando 1 día
    $fechaMaxSig = $fechaMax1->format('Y-m-d'); // pasando a string de nuevo
    // Sumándole 30 días a la última fecha de la BD
    $fechaMax30 = DateTime::createFromFormat('Y-m-d', $fechaMax);	// pasando a date
    $fechaMax30->add(new DateInterval('P30D'));	//aumentando 1 día
    $fechaMaxMesSig = $fechaMax30->format('Y-m-d'); // pasando a string de nuevo

    ?>


    <form action="datos.php" method="POST" class="textoPrinc">
        <?php echo "<br>Hasta el momento, se pueden realizar reservas hasta la fecha $fechaMax. <br><br>"; ?>
        <label for="fechaInicial">Agregar nuevos días de reserva desde la fecha:</label>
        <input type="date" id="fechaInicial" name="fechaInicial"
        value=<?php echo "$fechaMaxSig" ?>
        min=<?php echo "$fechaMaxSig" ?> max="2022-12-31">

        <label for="fechaFinal"> hasta la fecha:</label>
        <input type="date" id="fechaFinal" name="fechaFinal"
        value=<?php echo "$fechaMaxMesSig" ?>
        min=<?php echo "$fechaMaxSig" ?> max="2022-12-31">

        <input type="submit" value="Agregar fechas" class="btn btn-primary">
    </form>
 <?php
}else{ 
    $diaActual = date('Y-m-d');?>
    <form action="datos.php" method="POST" class="textoPrinc">
        <label for="fechaInicial">Agregar nuevos días de reserva desde la fecha:</label>
        <input type="date" id="fechaInicial" name="fechaInicial"
        value=<?php echo "$diaActual" ?>
        min=<?php echo "$diaActual" ?> max="2022-12-31">

        <label for="fechaFinal"> hasta la fecha:</label>
        <input type="date" id="fechaFinal" name="fechaFinal"
        value=<?php echo "$diaActual" ?>
        min=<?php echo "$diaActual" ?> max="2022-12-31">

        <input type="submit" value="Agregar fechas" class="btn btn-primary">
    </form>
 <?php
} ?>


<?php
require "./layout/footer.php";
?>


</body>
</html>