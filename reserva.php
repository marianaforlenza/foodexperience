<?php

require "conexion.php";

$con=mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");

$idResto = $_POST['idRestRes'];
$fecha=$_POST['fechaReserva'];
$mesa=$_POST['idMesaRes'];
$idUsuario=$_POST['idUsuario'];

// echo "la id del usuario  es $idUsuario";
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
$sqlReservar = "UPDATE disponibilidad SET estado = true, usu_id = $idUsuario
                WHERE fecha = '$fecha' and res_id = $idResto and idMesa = $mesa;";

$resultado = mysqli_query($con, $sqlReservar);

if(mysqli_affected_rows($con)>0){
    echo "<h4 class='textoPrinc'> La reserva ha sido realizada. </h4>";
    echo '<meta http-equiv="Refresh" content="2; url=index.php">';
}else{
    echo "<h4 class='textoPrinc'> No se pudo llevar a cabo la reserva. </h4>";
    echo '<meta http-equiv="Refresh" content="2; url=index.php">';
}

?>


<?php
require "./layout/footer.php";
?>


</body>
</html>







