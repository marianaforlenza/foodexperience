<?php

session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo '<meta http-equiv="Refresh" content="0; url=index.php">';
}

require "conexion.php";

$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");


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



<div class="buscador">
  <form class="was-validated" action="buscarRest.php" method="post">

    <!-- calendario -->
    <?php $diaActual= date('Y-m-d');
    ?>

    <div class="centrar ">
      <label for="fecha">Seleccione un día:</label>
      <input type="date" id="fecha" name="fecha"
      value=<?php echo "$diaActual" ?>
       min=<?php echo "$diaActual" ?> max="2022-12-31">
    </div>
    <!-- fin calendario -->

    <div class="eligiendo">

      <!-- elegir zona -->
      <div class="alternativas centrar">
        <div class="centrar">
          <!-- <form class="was-validated"> -->
          <div class="col-md-3 mb-3 mt-5 ml-5">
            <label >Zona </label>
            <select  class="custom-select is-invalid" id="elegir-zona" name="zona" required>
            <?php
            $getZona = "select * from zonas order by descripcion asc";
            $getZona2 = mysqli_query($con, $getZona);
            // echo  $getZona2;
            ?>
            <option selected disabled value="">Elija...</option>
            <?php
            while($row1 = mysqli_fetch_row($getZona2)){
            $id = $row1[0];
            $descripcion1 = $row1[1];
            ?>

            <option value = "<?php echo $id; ?>"> <?php echo $descripcion1 ?> </option>

            <?php
            }
            ?>
            </select><br><br>

          </div>
          <!-- </form> -->
        </div>
      </div>

      <!-- elegir cantidad comensales -->
      <div class="alternativas mt-5">
        <!-- <form class="was-validated alternativas mt-5"> -->
          <p> Seleecione la cantidad de comensales</p>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="comensales" value="1" class="custom-control-input" required>
            <label class="custom-control-label" for="customRadioInline1">1</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" name="comensales" value="2" class="custom-control-input" required>
            <label class="custom-control-label" for="customRadioInline2">2</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline3" name="comensales" value="3" class="custom-control-input" required>
            <label class="custom-control-label" for="customRadioInline3">3</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline4" name="comensales" value="4" class="custom-control-input" required>
            <label class="custom-control-label" for="customRadioInline4">4</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline5" name="comensales" value="5" class="custom-control-input" required>
            <label class="custom-control-label" for="customRadioInline5">5</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline6" name="comensales" value="6" class="custom-control-input" required>
            <label class="custom-control-label" for="customRadioInline6">6</label>
          </div>
          <div class="invalid-feedback"> Campo obligatorio</div>
            <!-- </form> -->
      </div>

      <div class="centrar mb">
        <input type="submit" class="boton centrar" value="Buscar restaurantes">
      </div>
  </form>
</div>


<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./imagenes/resto1.jpg" class="d-block w-100" width="600px" height="560px" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./imagenes/resto2.jpg" class="d-block w-100" width="600px" height="560px" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./imagenes/resto3.jpg" class="d-block w-100" width="600px" height="560px" alt="...">
    </div>
  </div>
 <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>



  <!-- tarjetas de restaurants-->






  <!-- footer
<footer>
    PARTE IZQUIERDA
    <div class="item-footer">
      <p> </p>
    </div>
    PARTE CENTRO
    <div class="item-footer centrar">
      <p> Hecho con <i class="bi bi-suit-heart-fill" style="font-size:0.8rem; color:red"></i></p>
      <p> por Vale, Maru y Jair<p>
    </div>
    PARTE DERECHA
    <div class="item-footer derecha">
      <a href="#">
        <i class="bi bi-github" style="font-size:2rem; color:white"></i>
        </a>
      <a href="">
        <i class="bi bi-whatsapp" style="font-size:2rem; color:green"></i>
      </a>
      <a href="#">
        <i class="bi bi-envelope" style="font-size:2rem; color:black"></i>
      </a>
    </div>

</footer>
   -->


<!-- js bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
 integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>
</html>