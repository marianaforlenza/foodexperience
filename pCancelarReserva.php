<?php


require "conexion.php";

$con=mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die("no se pudo conectar a la BD");

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


<?php
$sqlEliminarReserva="SELECT * FROM disponibilidad WHERE fecha = '$fecha' and res_id = $idResto and idMesa = $mesa;";

$resultCancelar =mysqli_query($con, $sqlEliminarReserva);

$registro=mysqli_fetch_array($resultCancelar);

    if(mysqli_affected_rows($con)>0) 
    {
    ?>
        <div class="cancelarReserva">
            <h5 class="textoPrinc"> Está por eliminar la reserva para el día <?php echo $registro[2] ?>. </h5><br>
            <h5 class="textoPrinc"> ¿Desea continuar? </h5><br>
            <form method=post class="textoPrinc">
            <input type=hidden name="fechaReserva" value=<?php echo $fecha ?>>
            <input type=hidden name="idRestRes" value=<?php echo $idResto ?>>
            <input type=hidden name="idMesaRes" value=<?php echo $mesa ?>>
            <input class="btn btn-success" type=submit value="Si" formaction=cancelarReserva.php>
            <input class="btn btn-danger"type=submit value="No" formaction=misReservas.php>
            </form>
        </div>
    <?php
    }
    else{    
      echo "<h5 class='textoPrinc'> La reserva seleccionada no existe en la base de datos. </h5>";
      
    }
?>



<?php
require "./layout/footer.php";
?>


</body>
</html>

























