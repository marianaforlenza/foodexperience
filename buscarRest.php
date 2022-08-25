<?php

session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo '<meta http-equiv="Refresh" content="0; url=index.php">';
}
?>

<?php

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



  <div class="buscarRest">
 
       <!-- botón Volver -->
    <div class="boton-volver">
        <a href="index.php">
          <p>Volver <i class="bi bi-house-fill" style="font-size:2rem; color: rgb(78, 76, 196)"></i></p>
            
        </a>
    </div>


    <?php
    $fecha=$_POST['fecha'];
    $zona=$_POST['zona'];
    $comensales=$_POST['comensales'];
    $cat=$_POST['cat'];
    
    require "conexion.php";
    $con=mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die("no se pudo conectar a la BD");

    

    if($cat == 0){    //viendo si se eligió categoria

      $sqlBuscarRest="SELECT restaurantes.id, restaurantes.nombre, restaurantes.imagenPrincipal, restaurantes.tipoImagen, disponibilidad.idMesa
                      from restaurantes 
                      INNER join disponibilidad
                      WHERE disponibilidad.fecha='$fecha' and 
                      disponibilidad.cant_comensales >= $comensales and
                      restaurantes.zon_id = $zona and
                      disponibilidad.estado = false and
                      restaurantes.estado = true and
                      restaurantes.id = disponibilidad.res_id
                      GROUP BY disponibilidad.res_id
                      ORDER BY disponibilidad.cant_comensales;";

      $resultRest=mysqli_query($con, $sqlBuscarRest);

      if(mysqli_affected_rows($con)>0){
        while($row = mysqli_fetch_row($resultRest)){
          ?>
          <div class="tarjetas">
            <?php
            $nombreResto = $row[1];
            $idResto= $row[0];
            $mesa=$row[4];
            // trayendo datos para mostrar promedio
            $getProm = "SELECT AVG(punt_valor) FROM calificaciones WHERE rest_id=$idResto;";
            $resultProm=mysqli_query($con, $getProm);
            $verProm=mysqli_fetch_array($resultProm);
            $promedio=$verProm[0]; ?>
            <!-- tarjetas de restaurants-->
            <form action="restaurantes.php" method="POST" enctype="multipart/form-data">
              <div class="card item m-5 tarjetas-fondo" style="width: 700px">
                <img width="600" height="350" class="card-img-top" src="data:<?php echo $row[3]; ?>;base64,<?php echo base64_encode($row[2]);?>">
                <div class="card-body centrar">
                  <input type=hidden name=idResto value=<?php echo $idResto ?>>
                  <input type=hidden name=fecha value=<?php echo $fecha ?>>
                  <input type=hidden name=comensales value=<?php echo $comensales ?>>
                  <input type=hidden name=mesa value=<?php echo $mesa ?>>
                  <h5 class='card-title'> <?php echo $nombreResto . " ". number_format($promedio, 1)?> <span class="estrella-color">&#9733 </span> </h5>
                  <button name="submit" class="btn btn-primary"> Reservar </button>
                </div>
              </div>
            </form>
          </div>
          <?php
        }
      }
      else{
        echo "No hay restaurantes disponibles para esa búsqueda";
      }

    }else{    //sin elegir categoria
      $sqlBuscarRest="SELECT restaurantes.id, restaurantes.nombre, restaurantes.imagenPrincipal, restaurantes.tipoImagen, disponibilidad.idMesa
                      from restaurantes 
                      INNER join disponibilidad
                      WHERE disponibilidad.fecha='$fecha' and 
                      disponibilidad.cant_comensales >= $comensales and
                      restaurantes.zon_id = $zona and
                      disponibilidad.estado = false and
                      restaurantes.estado = true and
                      restaurantes.cat_id =$cat and
                      restaurantes.id = disponibilidad.res_id
                      GROUP BY disponibilidad.res_id
                      ORDER BY disponibilidad.cant_comensales;";

      $resultRest=mysqli_query($con, $sqlBuscarRest);

      if(mysqli_affected_rows($con)>0){
        while($row = mysqli_fetch_row($resultRest)){
          ?>
          <div class="tarjetas">
            <?php
            $nombreResto = $row[1];
            $idResto= $row[0];
            $mesa=$row[4];
            // trayendo datos para mostrar promedio
            $getProm = "SELECT AVG(punt_valor) FROM calificaciones WHERE rest_id=$idResto;";
            $resultProm=mysqli_query($con, $getProm);
            $verProm=mysqli_fetch_array($resultProm);
            $promedio=$verProm[0]; ?>
            <!-- tarjetas de restaurants-->
            <form action="restaurantes.php" method="POST" enctype="multipart/form-data">
              <div class="card item m-5 tarjetas-fondo" style="width: 700px">
                <img width="600" height="350" class="card-img-top" src="data:<?php echo $row[3]; ?>;base64,<?php echo base64_encode($row[2]);?>">
                <div class="card-body centrar">
                  <input type=hidden name=idResto value=<?php echo $idResto ?>>
                  <input type=hidden name=fecha value=<?php echo $fecha ?>>
                  <input type=hidden name=comensales value=<?php echo $comensales ?>>
                  <input type=hidden name=mesa value=<?php echo $mesa ?>>
                  <h5 class='card-title'> <?php echo $nombreResto . " ". number_format($promedio, 1)?> <span class="estrella-color">&#9733 </span> </h5>
                  <button name="submit" class="btn btn-primary"> Reservar </button>
                </div>
              </div>
            </form>
          </div>
          <?php
        }
      }
      else{
        echo "No hay restaurantes disponibles para esa búsqueda";
      }
    }
    ?> 
  </div>         


<?php
require "./layout/footer.php";
?>


</body>
</html>
