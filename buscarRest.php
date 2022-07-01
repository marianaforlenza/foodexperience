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

</head>
<body>

<!-- header -->
<header>
  <!-- logo -->
    <div class="logo">
      <a href="index.php">
        <img src="./imagenes/logo.png">
      </a>
    </div>
  <!-- título central -->
    <div class="titulo">
        <h1 class="centrar">Food Experience</h1>
    </div>

<?php //comprobando si ya inició sesión
  if(isset($_SESSION['usu_mail'])){
    $nombreCompleto= $_SESSION['nombre_completo'];
?>
  <div class="loguearse">
    <div class="derecha">
      <p>Bienvenida/o <?php echo $nombreCompleto ?></p>
    </div>
    <div class="contra-registro">
      <!-- botón de Cerrar sesión -->
      <a href="index.php?logout"><button class="btn btn-outline-secondary mr-2">Cerrar Sesión</button></a>
    </div>
  </div>
<?php
}else{
?>
    <!-- pantalla de login -->
    <div class="loguearse">
      <div>
        <form class="derecha" action="buscarUsu.php" method="post">
        <input type="text" class="tamanio-form" name="mail" placeholder="Ingrese su mail" required>
        <input type="password" class="tamanio-form" name="contra" placeholder="Ingrese su Contraseña" required>
        <input type="submit" class="btn btn-primary btn-sm" value="Iniciar Sesión">
        </form>
      </div>
      <!-- olvidé mi contraseña -->
      <div class="contra-registro">
        <div class="olvide-contra mr-5">
          <a href=""> Olvidé mi contraseña </a>
        </div>
        <div>   <!-- botón Registrarse -->
          <form class="derecha" action="formRegistro.php">
            <input type="submit" class="btn btn-outline-primary btn-sm" value="Registrarse">
          </form>
        </div>
      </div>
    </div>
<!-- cierre del else -->
<?php
}
?>
</header>


<!-- botón Volver -->
<div class="derecha mt-3">
    <a href="index.php">
        <i class="bi bi-house-fill" style="font-size:2rem; color: rgb(199, 198, 255)"></i>
    </a>
</div>

    
  <?php
   
  $fecha=$_POST['fecha'];
  $zona=$_POST['zona'];
  $comensales=$_POST['comensales'];
   
   
  // echo "La fecha seleccionada es $fecha<br>";
  //echo "La zona seleccionada es $zona<br>";
  //echo "Los comensales seleccionados son $comensales<br>";
    
  require "conexion.php";
    
  $con=mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die("no se pudo conectar a la BD");
 
     
  $sqlBuscarRest="SELECT restaurantes.id, restaurantes.nombre, restaurantes.imagenPrincipal, restaurantes.tipoImagen, disponibilidad.idMesa
                  from restaurantes 
                  INNER join disponibilidad
                  WHERE disponibilidad.fecha='$fecha' and 
                  disponibilidad.cant_comensales = $comensales and
                  restaurantes.zon_id = $zona and
                  disponibilidad.estado = false and
                  restaurantes.estado = true and
                  disponibilidad.idMesa = (SELECT MIN(disponibilidad.idMesa) FROM disponibilidad) and
                  restaurantes.id = disponibilidad.res_id;";

  $resultRest=mysqli_query($con, $sqlBuscarRest);

  if(mysqli_affected_rows($con)>0){
    // echo "Se encontro el rest<br><br>";

    while($row = mysqli_fetch_row($resultRest)){
      ?>

      <div class="tarjetas">

        <?php
        $nombreResto = $row[1];
        $idResto= $row[0];
        $mesa=$row[4];
        ?>
        <!-- tarjetas de restaurants-->
        <form action="restaurantes.php" method="POST" enctype="multipart/form-data">
        <div class="card item" style="width: 18rem;">
          <img class="card-img-top" src="data:<?php echo $row[3]; ?>;base64,<?php echo base64_encode($row[2]);?>">
          <div class="card-body centrar">
            <input type=hidden name=idResto value=<?php echo $idResto ?>>
            <input type=hidden name=fecha value=<?php echo $fecha ?>>
            <input type=hidden name=comensales value=<?php echo $comensales ?>>
            <input type=hidden name=mesa value=<?php echo $mesa ?>>
            <?php echo "<h5 class='card-title'> $nombreResto</h5>"; ?>
            <button name="submit" class="btn btn-primary">Reservar</button>
          </div>
        </div>
        </form>
      </div>
      
      <?php
      }
  }
  else{

    $conn1=mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die("no se pudo conectar a la BD");


    $sqlBuscarRest1="SELECT restaurantes.id, restaurantes.nombre, restaurantes.imagenPrincipal, restaurantes.tipoImagen, disponibilidad.idMesa
              from restaurantes 
              INNER join disponibilidad
              WHERE disponibilidad.fecha='$fecha' and 
              disponibilidad.cant_comensales = $comensales and
              restaurantes.zon_id = $zona and
              disponibilidad.estado = false and
              restaurantes.estado = true and
              restaurantes.id = disponibilidad.res_id;";

      $resultRest1=mysqli_query($conn1, $sqlBuscarRest1);
         
      if(mysqli_affected_rows($conn1)>0){

          while($row1 = mysqli_fetch_row($resultRest1)){
            ?>
      
            <div class="tarjetas">
      
              <?php
              $nombreResto1 = $row1[1];
              $idResto1= $row1[0];
              $mesa1=$row1[4];
              ?>
              <!-- tarjetas de restaurants-->
              <form action="restaurantes.php" method="POST" enctype="multipart/form-data">
              <div class="card item" style="width: 18rem;">
                <img class="card-img-top" src="data:<?php echo $row1[3]; ?>;base64,<?php echo base64_encode($row1[2]);?>">
                <div class="card-body centrar">
                  <input type=hidden name=idResto value=<?php echo $idResto1 ?>>
                  <input type=hidden name=fecha value=<?php echo $fecha ?>>
                  <input type=hidden name=comensales value=<?php echo $comensales ?>>
                  <input type=hidden name=mesa value=<?php echo $mesa1 ?>>
                  <?php echo "<h5 class='card-title'> $nombreResto1</h5>"; ?>
                  <button name="submit" class="btn btn-primary">Reservar</button>
                </div>
              </div>
              </form>
            </div>
            
            <?php
          }
        }
          
      else{
          

        $comensales++;
        $comensales2 = $comensales;

        $conn=mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die("no se pudo conectar a la BD");


        $sqlBuscarRest2="SELECT restaurantes.id, restaurantes.nombre, restaurantes.imagenPrincipal, restaurantes.tipoImagen, disponibilidad.idMesa
                  from restaurantes 
                  INNER join disponibilidad
                  WHERE disponibilidad.fecha='$fecha' and 
                  disponibilidad.cant_comensales = $comensales2 and
                  restaurantes.zon_id = $zona and
                  disponibilidad.estado = false and
                  restaurantes.estado = true and
                  restaurantes.id = disponibilidad.res_id;";

        $resultRest2=mysqli_query($conn, $sqlBuscarRest2);
         
        if(mysqli_affected_rows($conn)>0){

        while($row2 = mysqli_fetch_row($resultRest2)){
          ?>
          <?php
          $nombreResto = $row2[1];
          $idResto= $row2[0];
          $mesa=$row2[4];
          ?>

        <div class="tarjetas">
          <!-- tarjetas de restaurants-->
          <form action="restaurantes.php" method="POST" enctype="multipart/form-data">
          <div class="card item" style="width: 18rem;">
            <img class="card-img-top" src="data:<?php echo $row2[3]; ?>;base64,<?php echo base64_encode($row2[2]);?>">
            <div class="card-body centrar">
              <input type="hidden" name="idResto" value="<?php echo $idResto ?>">
              <input type=hidden name=fecha value=<?php echo $fecha ?>>
              <input type=hidden name=comensales value=<?php echo $comensales2 ?>>
              <input type=hidden name=mesa value=<?php echo $mesa ?>>
              <?php echo "<h5 class='card-title'> $nombreResto</h5>";?>
              <button name="submit" class="btn btn-primary">Reservar</button>
            </div>
          </div>
          </form>
        </div>
          
          <?php
          }

      }
      else{

      echo "<h3>No se encontró ningún restaurante<h3><br><br>";
      }

    }
  }
  ?> 
         
  



<!-- js bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
 integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>
</html>
