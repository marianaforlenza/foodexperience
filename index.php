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

<div class="contenedor">
  <!-- HEADER -->
  <header>
    <!-- Parte Izquierda - logo -->
    <div class="headerI">
      <a href="index.php">
        <img src="./imagenes/logo.png">
      </a>
    </div>
    <!-- Parte central - Título -->
    <div class="headerC titulo">
      <h1 class="titu">Food Experience</h1>
    </div>
    <div class="headerD"> <!-- Parte Derecha -->
      <?php //comprobando si ya inició sesión
      if(isset($_SESSION['usu_mail'])){
        $nombreCompleto= $_SESSION['nombre_completo'];
        $idUsuario = $_SESSION['idUsuario'];
        ?>
        <div class="mr-3">
          <div>
            <p>¡Hola <?php echo $nombreCompleto?>!</p>
          </div>
          <!-- barra de opciones -->
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
              Opciones
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="misReservas.php">Mis Reservas</a>
              <a class="dropdown-item" href="#">Mis Opiniones</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="index.php?logout">Cerrar Sesión</a>
            </div>
          </div>
        </div>
        <?php
      }else{
        ?>
        <!-- pantalla de login -->
        <div>
          <div>
            <form action="buscarUsu.php" method="post">
              <input type="text" class="tamanio-form" name="mail" placeholder="Ingrese su mail" required>
              <input type="password" class="tamanio-form" name="contra" placeholder="Ingrese su Contraseña" required>
              <input type="submit" class="btn btn-primary btn-sm" value="Iniciar Sesión">
            </form>
          </div>
          <div class="olvide-registro">
            <div class="mr-5">   <!-- olvidé mi contraseña -->
              <a href=""> Olvidé mi contraseña </a>
            </div>
            <div>   <!-- botón Registrarse -->
              <form action="formRegistro.php">
                <input type="submit" class="btn btn-outline-info btn-sm" value="Registrarse">
              </form>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </header>
  <!-- FIN HEADER -->

  <div class="main">

    <!-- TEXTO-BIENVENIDA -->
    <div class="textoPrinc">

      <br><h2> ¡Bienvenido a Food Experience! </h2><br>
      <p> Contamos con el catálogo más completo de los mejores restaurantes de zona sur.</p>

      <p> Podés hacer tus reservas para el día y restaurante que quieras. Utilizá el
        buscador y te aparecerán los restaurantes disponibles. </p><br>
    </div>

    <!-- CAROUSEL-->
    <div id="carouselExampleControls" class="carousel slide carrusel" data-ride="carousel">
      <div class="carousel-inner">
        <?php
        $getFotos= "SELECT * FROM restaurantes;";
        $getFotos2 = mysqli_query($con, $getFotos);
        $cont_slide= 0;
        while($fotos = mysqli_fetch_array($getFotos2)){
          $activo = "";
          if($cont_slide == 0){
            $activo = "active";
          } ?>
        <div class="carousel-item <?php echo $activo?>">
          <img class="" width="850px" height="637px" src="data:<?php echo $fotos['tipoImagen1']; ?>;base64,<?php echo base64_encode($fotos['imagen1']);?>">
        </div>
        <?php
        $cont_slide++;
        } ?>
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

    <!-- BUSCADOR -->
    <div class="buscador"><br>
      <form class="buscador2" action="buscarRest.php" method="post">
        <!-- calendario -->
        <?php $diaActual= date('Y-m-d');
        ?>
        <div class="calendario"><br>
          <label for="fecha">Seleccione un día:</label>
          <input type="date" id="fecha" name="fecha"
          value=<?php echo "$diaActual" ?>
          min=<?php echo "$diaActual" ?> max="2022-12-31">
        </div>
        <!-- fin calendario -->

        <!-- elegir zona -->
        <div class="col-md-3 mb-3 mt-5 ml-5 was-validated zona">
          <label >Zona </label>
          <select  class="custom-select is-invalid" id="elegir-zona" name="zona" required>
          <?php
          $getZona = "select * from zonas order by descripcion asc";
          $getZona2 = mysqli_query($con, $getZona);
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

        <!-- elegir cantidad comensales -->
        <div class="mt-5 was-validated comensales">
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
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline7" name="comensales" value="7" class="custom-control-input" required>
            <label class="custom-control-label" for="customRadioInline7">7</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline8" name="comensales" value="8" class="custom-control-input" required>
            <label class="custom-control-label" for="customRadioInline8">8</label>
          </div>
          <div class="invalid-feedback"> Campo obligatorio</div>
        </div>

        <!-- elegir categoria -->
        <div class="col-md-3 mb-3 mt-5 ml-5 categoria">
          <label >Tipo de restaurante (opcional) </label>
          <select  class="custom-select" id="elegir-cat" name="cat">
          <?php
          $getCat = "select * from categorias order by descripcion asc";
          $getCat2 = mysqli_query($con, $getCat);
          ?>
          <option selected value="0">Elija...</option>
          <?php
          while($row2 = mysqli_fetch_row($getCat2)){
          $id2 = $row2[0];
          $descripcion2 = $row2[1];
          ?>
          <option value = "<?php echo $id2; ?>"> <?php echo $descripcion2 ?> </option>
          <?php
          }
          ?>
          </select><br><br>
        </div>
        <!-- BOTON ENVIAR BUSCADOR -->
        <div class="centrar mb botonBuscador">
          <input type="submit" class="btn btn-primary" value="Buscar restaurantes">
        </div><br><br><br>
      </form>
    </div>

  </div>

  <!-- FOOTER -->
  <footer>
    <!-- PARTE IZQUIERDA -->
    <div class="footerI">
      <p> </p>
    </div>
    <!-- PARTE CENTRO -->
    <div class="footerC">
      <p> Hecho con <i class="bi bi-suit-heart-fill" style="font-size:0.8rem; color:red"></i></p>
      <p> por Vale, Maru y Jair<p>
    </div>
    <!-- PARTE DERECHA -->
    <div class="footerD mr-3"> 
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

</div>


<!-- js bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
 integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>

</html>