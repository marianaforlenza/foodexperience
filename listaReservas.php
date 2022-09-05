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




<div class="textoPrinc tablaR">
    <br><h4> Reservas actuales: </h4><br>
    <table>
        <tr>
            <th class="filas-tabla"> Fecha </th>
            <th class="filas-tabla"> Restaurante </th>
            <th class="filas-tabla"> Zona </th>
            <th class="filas-tabla"> Dirección </th>
            <th class="filas-tabla"> Usuario </th>
        </tr>

        <?php

        $sqlReservas = "SELECT * FROM disponibilidad WHERE estado=true AND fecha >= NOW() ORDER BY fecha;";
        $recordSet = mysqli_query($con, $sqlReservas);
        while($listaReservas = mysqli_fetch_array($recordSet)){
            ?>
            <tr>
                <td><?php echo $listaReservas['fecha'] ?></td>
                <?php
                $sqlBuscar_Rest = "SELECT * FROM restaurantes WHERE id= '$listaReservas[res_id]';";
                $recordSet_Rest = mysqli_query($con, $sqlBuscar_Rest);
                $listaReservasRest = mysqli_fetch_array($recordSet_Rest);
                ?>
                <td><?php echo $listaReservasRest['nombre'] ?></td>
                <?php
                $sqlBuscar_Zona = "SELECT * FROM zonas where id = '$listaReservasRest[zon_id]';";
                $recordSet_Zona = mysqli_query($con, $sqlBuscar_Zona);
                $listaReservasZona = mysqli_fetch_array($recordSet_Zona);
                ?>
                <td><?php echo $listaReservasZona[1] ?></td>
                <td><?php echo $listaReservasRest['direccion'] ?></td>
                <?php
                $sqlBuscarUsu = "SELECT * FROM usuarios WHERE id= '$listaReservas[usu_id]';";
                $recordSetUsu = mysqli_query($con, $sqlBuscarUsu);
                $listaReservasUsu = mysqli_fetch_array($recordSetUsu);
                ?>
                <td><?php echo $listaReservasUsu['email'] ?></td>
            </tr>
         <?php
        } ?>
    </table>
</div>

<div class="textoPrinc tablaR">
    <br><br><h4> Historial de reservas: </h4><br>
    <table>
        <tr>
            <th> Fecha </th>
            <th> Restaurante </th>
            <th> Zona </th>
            <th> Dirección </th>
            <th class="filas-tabla"> Usuario </th>
        </tr>
        <?php
        $sqlReservas = "SELECT * FROM disponibilidad WHERE estado=true AND fecha < NOW() ORDER BY fecha;";
        $recordSet = mysqli_query($con, $sqlReservas);
        while($listaReservas = mysqli_fetch_array($recordSet)){
            ?>
            <tr>
                <td><?php echo $listaReservas['fecha'] ?></td>
                <?php
                $sqlBuscar_Rest = "SELECT * FROM restaurantes WHERE id= '$listaReservas[res_id]';";
                $recordSet_Rest = mysqli_query($con, $sqlBuscar_Rest);
                $listaReservasRest = mysqli_fetch_array($recordSet_Rest);
                ?>
                <td><?php echo $listaReservasRest['nombre'] ?></td>
                <?php
                $sqlBuscar_Zona = "SELECT * FROM zonas where id = '$listaReservasRest[zon_id]';";
                $recordSet_Zona = mysqli_query($con, $sqlBuscar_Zona);
                $listaReservasZona = mysqli_fetch_array($recordSet_Zona);
                ?>
                <td><?php echo $listaReservasZona[1] ?></td>
                <td><?php echo $listaReservasRest['direccion'] ?></td>
                <?php
                $sqlBuscarUsu = "SELECT * FROM usuarios WHERE id= '$listaReservas[usu_id]';";
                $recordSetUsu = mysqli_query($con, $sqlBuscarUsu);
                $listaReservasUsu = mysqli_fetch_array($recordSetUsu);
                ?>
                <td><?php echo $listaReservasUsu['email'] ?></td>
            </tr>
         <?php
        } ?>
    </table>
</div>


    <?php
require "./layout/footer.php";
?>


</body>

</html>