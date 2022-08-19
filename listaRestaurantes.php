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

  
    <br><h4 class="textoPrinc"> Restaurantes: </h4><br>
    <br><h5 class="textoPrinc"> botones para ordenar: </h5><br>
    <table>
        <tr>
            <th class="filas-tabla"> ID </th>
            <th class="filas-tabla"> Nombre </th>
            <th class="filas-tabla"> Dirección </th>
            <th class="filas-tabla"> Teléfono </th>
            <th class="filas-tabla"> Zona </th>
            <th class="filas-tabla"> Categoría </th>
            <th class="filas-tabla"> Imagen del frente </th>
            <th class="filas-tabla"> Imagen 1 </th>
            <th class="filas-tabla"> Imagen 2 </th>
            <th class="filas-tabla"> Imagen 3 </th>
            <th class="filas-tabla"> Reservas realizadas </th>
            <th class="filas-tabla"> Puntuación </th>
            <th class="filas-tabla"> Estado </th>
            <th> Cambiar estado </th>
            <th>  </th>
        </tr>

        <?php

        $sqlRestaurantes = "SELECT * FROM restaurantes;";
        $recordSet = mysqli_query($con, $sqlRestaurantes);
        while($listaRestaurantes = mysqli_fetch_array($recordSet)){
            $estado=$listaRestaurantes['estado'];
            $id = $listaRestaurantes[0];
            ?>
            <tr>
                <td><?php echo $listaRestaurantes['id'] ?></td>
                <td><?php echo $listaRestaurantes['nombre'] ?></td>
                <td><?php echo $listaRestaurantes['direccion'] ?></td>
                <td><?php echo $listaRestaurantes['tel'] ?></td>
                <?php
                
                $sqlZona = "SELECT * FROM zonas WHERE id='$listaRestaurantes[14]';";
                $recordZona = mysqli_query($con, $sqlZona);
                $zona=mysqli_fetch_array($recordZona);
                ?>
                <td><?php echo $zona[1] ?></td>
                <?php
                $sqlCat = "SELECT * FROM categorias WHERE id='$listaRestaurantes[15]';";
                $recordCat = mysqli_query($con, $sqlCat);
                $Cat=mysqli_fetch_array($recordCat);
                ?>
                <td><?php echo $Cat[1] ?></td>
                <!-- <div class="card item m-5 tarjetas-fondo" style="width: 700px"> -->
                <td><img width="200" height="100" class="card-img-top" src="data:<?php echo $listaRestaurantes[6]; ?>;base64,<?php echo base64_encode($listaRestaurantes[4]);?>"></td>
                <td><img width="200" height="100" class="card-img-top" src="data:<?php echo $listaRestaurantes[8]; ?>;base64,<?php echo base64_encode($listaRestaurantes[7]);?>"></td>
                <td><img width="200" height="100" class="card-img-top" src="data:<?php echo $listaRestaurantes[10]; ?>;base64,<?php echo base64_encode($listaRestaurantes[9]);?>"></td>
                <td><img width="200" height="100" class="card-img-top" src="data:<?php echo $listaRestaurantes[12]; ?>;base64,<?php echo base64_encode($listaRestaurantes[11]);?>"></td>
                <?php
                $sqlCantReservas = "SELECT * FROM disponibilidad WHERE res_id= '$listaRestaurantes[id]' AND estado=TRUE;";
                $recordCantReservas = mysqli_query($con, $sqlCantReservas);
                $listaRestaurantes = mysqli_fetch_array($recordCantReservas);
                $cantidadReservas= mysqli_num_rows($recordCantReservas);
                ?>
                <td><?php echo $cantidadReservas ?></td>
                <?php
                $sqlProm = "SELECT AVG(punt_valor) from calificaciones WHERE rest_id=$id;";
                $resultProm = mysqli_query($con, $sqlProm);
                $verProm=mysqli_fetch_array($resultProm);
                $promedio=$verProm[0]; ?>
                <td> <?php echo number_format($promedio, 1)?> <span class="estrella-color">&#9733 </span> </td>
                <?php
                if($estado!=0){ ?>
                    <td bgcolor="green"> Activo </td>                    
                 <?php
                }else{ ?>
                    <td bgcolor="red"> Deshabilitado </td>
                 <?php
                }
                if($estado!=0){?>
                    <form action="cambiarEstadoRes.php" method="POST">
                        <input type=hidden name="idRest" value=<?php echo $id ?>>
                        <td><input type="submit" class="btn btn-danger" value="Dar de baja"> </td>
                    </form>
                 <?php
                }else{ ?>
                    <form action="cambiarEstadoRes.php" method="POST">
                        <input type=hidden name="idResto" value=<?php echo $id ?>>
                        <td><input type="submit" class="btn btn-success" value="Activar"> </td>
                    </form> <?php
                }
                ?>
                <form action="#" method="POST">
                <input type=hidden name="idResto" value=<?php echo $id ?>>
                <td><input type="submit" class="btn btn-primary" value="Modificar"> </td>
                </form>
                

            </tr>
         <?php
        } ?>
    </table>


    <?php
require "./layout/footer.php";
?>


</body>

</html>