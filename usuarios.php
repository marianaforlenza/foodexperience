<?php

session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo '<meta http-equiv="Refresh" content="0; url=index.php">';
}

if($_SESSION['rol']!=1){
    echo "ACCESO NO AUTORIZADO";
    echo '<meta http-equiv="Refresh" content="1; url=index.php">';
    exit();
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
    <title>Food Experience</title>

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



  
    <br><h4 class="textoPrinc"> Usuarios: </h4><br>
    <table>
        <tr>
            <th class="filas-tabla"> Email </th>
            <th class="filas-tabla"> Nombre </th>
            <th class="filas-tabla"> Apellido </th>
            <th class="filas-tabla"> Celular </th>
            <th class="filas-tabla"> Reservas realizadas </th>
        </tr>

        <?php

        $sqlUsuarios = "SELECT * FROM usuarios WHERE rol_id!=1 ORDER BY email;";
        $recordSet = mysqli_query($con, $sqlUsuarios);
        while($listaUsuarios = mysqli_fetch_array($recordSet)){
            ?>
            <tr>
                <td><?php echo $listaUsuarios['email'] ?></td>
                <td><?php echo $listaUsuarios['nombre'] ?></td>
                <td><?php echo $listaUsuarios['apellido'] ?></td>
                <td><?php echo $listaUsuarios['cel'] ?></td>
                <?php
                $sqlCantReservas = "SELECT * FROM disponibilidad WHERE usu_id= '$listaUsuarios[id]';";
                $recordCantReservas = mysqli_query($con, $sqlCantReservas);
                $listaUsuarios = mysqli_fetch_array($recordCantReservas);
                $cantidadReservas= mysqli_num_rows($recordCantReservas);
                ?>
                <td><?php echo $cantidadReservas ?></td>
                

            </tr>
         <?php
        } ?>
    </table>




    <?php
require "./layout/footer.php";
?>

</body>

</html>