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
    <div class="boton-volver">
        <a href="index.php">
          <p>Volver <i class="bi bi-house-fill" style="font-size:2rem; color: rgb(78, 76, 196)"></i></p>
            
        </a>
    </div>

  
    <br><h4 class="textoPrinc"> Reservas actuales: </h4><br>
    <table>
        <tr>
            <th class="filas-tabla"> Fecha </th>
            <th class="filas-tabla"> Restaurante </th>
            <th class="filas-tabla"> Zona </th>
            <th class="filas-tabla"> Dirección </th>
            <th class="filas-tabla"> Cantidad de Comensales </th>
            <th> </th>
        </tr>

        <?php

        $sqlReservas = "SELECT * FROM disponibilidad WHERE  usu_id = $idUsuario and fecha >= NOW() ORDER BY fecha;";
        $recordSet = mysqli_query($con, $sqlReservas);
        while($misReservas = mysqli_fetch_array($recordSet)){
            ?>
            <tr>
                <td><?php echo $misReservas['fecha'] ?></td>
                <?php
                $sqlBuscar_Rest = "SELECT * FROM restaurantes WHERE id= '$misReservas[res_id]';";
                $recordSet_Rest = mysqli_query($con, $sqlBuscar_Rest);
                $misReservasRest = mysqli_fetch_array($recordSet_Rest);
                ?>
                <td><?php echo $misReservasRest['nombre'] ?></td>
                <?php
                $sqlBuscar_Zona = "SELECT * FROM zonas where id = '$misReservasRest[zon_id]';";
                $recordSet_Zona = mysqli_query($con, $sqlBuscar_Zona);
                $misReservasZona = mysqli_fetch_array($recordSet_Zona);
                ?>
                <td><?php echo $misReservasZona[1] ?></td>
                <td><?php echo $misReservasRest['direccion'] ?></td>
                <td>    <form method="POST">
                        <input type=hidden name="fechaReserva" value=<?php echo $misReservas['fecha'] ?>>
                        <input type=hidden name="idRestRes" value=<?php echo $misReservas[0] ?>>
                        <input type=hidden name="idMesaRes" value=<?php echo $misReservas[1] ?>>
                        <input class="btn btn-danger"type=submit value="Cancelar" formaction=pCancelarReserva.php> </form>
                </td>
            </tr>
         <?php
        } ?>
    </table>



    <br><br><br><h4 class="textoPrinc"> Historial de reservas: </h4><br>
    <table>

        <tr>
            <th> Fecha </th>
            <th> Restaurante </th>
            <th> Zona </th>
            <th> Dirección </th>
        </tr>

        <?php

        $sqlReservas = "SELECT * FROM disponibilidad WHERE  usu_id = $idUsuario and fecha < NOW() ORDER BY fecha;";
        $recordSet = mysqli_query($con, $sqlReservas);
        while($misReservas = mysqli_fetch_array($recordSet)){
            ?>
            <tr>
                <td><?php echo $misReservas['fecha'] ?></td>
                <?php
                $sqlBuscar_Rest = "SELECT * FROM restaurantes WHERE id= '$misReservas[res_id]';";
                $recordSet_Rest = mysqli_query($con, $sqlBuscar_Rest);
                $misReservasRest = mysqli_fetch_array($recordSet_Rest);
                ?>
                <td><?php echo $misReservasRest['nombre'] ?></td>
                <?php
                $sqlBuscar_Zona = "SELECT * FROM zonas where id = '$misReservasRest[zon_id]';";
                $recordSet_Zona = mysqli_query($con, $sqlBuscar_Zona);
                $misReservasZona = mysqli_fetch_array($recordSet_Zona);
                ?>
                <td><?php echo $misReservasZona[1] ?></td>
                <td><?php echo $misReservasRest['direccion'] ?></td>
            </tr>
         <?php
        } ?>
    </table>





    <?php
require "./layout/footer.php";
?>

</body>

</html>
