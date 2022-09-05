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

    <!-- TEXTO-BIENVENIDA -->
    <div class="textoPrinc">

      <br><h2> ¡Bienvenido a Food Experience! </h2><br>
      <p> La web líder en Reservas gastronómicas</p><br>

      <a class="reser" href="#pie">RESERVAR </a><br><br>
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
          <img class="carrusel-index"  src="data:<?php echo $fotos['tipoImagen1']; ?>;base64,<?php echo base64_encode($fotos['imagen1']);?>">
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
    <div id="pie" class="buscador"><br>
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

  
  <?php
require "./layout/footer.php";
?>

</body>

</html>