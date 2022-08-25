<?php

session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo '<meta http-equiv="Refresh" content="0; url=index.php">';
}

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
    <div class="boton-volver">
        <a href="index.php">
          <p>Volver <i class="bi bi-house-fill" style="font-size:2rem; color: rgb(78, 76, 196)"></i></p>
            
        </a>
    </div>

    
    <br><h4 class="textoPrinc"> Mis opiniones: </h4><br>
    <table>
        <tr>
            <th class="filas-tabla"> Restaurante </th>
            <th class="filas-tabla"> Calificación </th>
            <th class="filas-tabla"> Comentario </th>
            <th class="filas-tabla"> Fecha del comentario </th>
            <th> </th>
        </tr>

        <?php

        $sqlOpiniones = "SELECT * FROM calificaciones WHERE usur_id = $idUsuario;";
        $recordSet = mysqli_query($con, $sqlOpiniones);
        while($misOpiniones = mysqli_fetch_array($recordSet)){
            ?>
            <tr>
                <?php
                $sqlBuscar_Rest = "SELECT * FROM restaurantes WHERE id= '$misOpiniones[rest_id]';";
                $recordSet_Rest = mysqli_query($con, $sqlBuscar_Rest);
                $misOpinionesRest = mysqli_fetch_array($recordSet_Rest);
                ?>
                <td><?php echo $misOpinionesRest['nombre'] ?></td>
                <td><?php echo $misOpiniones['punt_valor'] ?> <span class="estrella-color">&#9733 </span> </td>
                <td class="opinones"><?php echo $misOpiniones['comentario'] ?></td>
                <td><?php echo $misOpiniones['fecha_comentario'] ?></td>
            </tr>
         <?php
        } ?>
    </table>



    <?php
require "./layout/footer.php";
?>


</body>
</html>
