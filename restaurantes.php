<?php
session_start();
if(isset($_GET['logout'])){
  session_destroy();
  echo '<meta http-equiv="Refresh" content="0; url=index.php">';
}

require "conexion.php";

$idResto = $_POST['idResto'];
$fecha=$_POST['fecha'];
$comensales=$_POST['comensales'];
$mesa=$_POST['mesa'];

$con=mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");

$restoSelec="SELECT *
            FROM restaurantes 
            INNER JOIN disponibilidad
            WHERE disponibilidad.fecha='$fecha' AND 
            disponibilidad.idMesa = $mesa AND
            restaurantes.id = $idResto AND
            disponibilidad.estado = false AND
            disponibilidad.res_id =$idResto AND
            restaurantes.id = disponibilidad.res_id;";

$resultRest = mysqli_query($con, $restoSelec);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="cssGrid.css">
</head>
<body>
    


<?php

require "./layout/header.php";


$campos = mysqli_fetch_array($resultRest);
$nombreResto = $campos[1];
$tel =$campos['tel'];
$direc = $campos['direccion'];

if(isset($idUsuario)){

  echo "<br><h3 class='centrar divCol' > ¿Desea confirmar la reserva en el restaurante $nombreResto para el día $fecha? </h3> <br>";
  ?>


  <form method=post class="centrar"> 
      <input type=hidden name="fechaReserva" value=<?php echo $fecha ?>>
      <input type=hidden name="idRestRes" value=<?php echo $idResto ?>>
      <input type=hidden name="idMesaRes" value=<?php echo $mesa ?>>
      <input type=hidden name="idUsuario" value=<?php echo $idUsuario ?>>
      <input class="btn btn-success" type=submit value="Si" formaction=reserva.php>
      <input class="btn btn-danger"type=submit value="No" formaction=index.php>
  </form>
  <?php
}else{
  echo "<br><h4 class='centrar divCol' > Debe iniciar sesión para confirmar la reserva en el restaurante $nombreResto para el día $fecha </h4> <br>";
}

?>

        <?php
        $getFotos= "SELECT * FROM restaurantes WHERE id= $idResto;";
        $getFotos2 = mysqli_query($con, $getFotos);
        $fotos= mysqli_fetch_array($getFotos2);
        ?>

<div class="fotos-mapa">
  <div class="fotosResto-tel" >
    <!-- CAROUSEL-->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="data:<?php echo $fotos['tipoImagen']; ?>;base64,<?php echo base64_encode($fotos['imagenPrincipal']);?>" width="600px" height="450px" alt="...">
        </div>
        <div class="carousel-item">
          <img src="data:<?php echo $fotos['tipoImagen1']; ?>;base64,<?php echo base64_encode($fotos['imagen1']);?>" width="600px" height="450px"  alt="...">
        </div>
        <div class="carousel-item">
          <img src="data:<?php echo $fotos['tipoImagen2']; ?>;base64,<?php echo base64_encode($fotos['imagen2']);?>" width="600px" height="450px" alt="...">
        </div>
        <div class="carousel-item">
          <img src="data:<?php echo $fotos['tipoImagen3']; ?>;base64,<?php echo base64_encode($fotos['imagen3']);?>" width="600px" height="450px" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </button>
    </div>
    <div>
      <?php echo "<h4 class='divCol'> telefono: $tel  </h4>"  ?>
    </div>
  </div>


    <!-- MAPA DEL RESTO -->
  <div class="mapa-direc">
    <div>
      <?php   
      if(isset($nombreResto)){
        switch($nombreResto){
          case "La Parrillita": ?>
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.0175275004076!2d-58.268355684241754!3d-34.72995257169632!2m3!1f0!
                  2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32e6ef6078daf%3A0xe4f8924ca48b961!2sAndr%C3%A9s%20Baranda%201527%2C%20B1878DLE%20Gran%
                  20Buenos%20Aires%2C%20Provincia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1657838885752!5m2!1ses!2sar" width="600" height="450" 
                  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "Parque de la Cervecería": ?>
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3278.721447608571!2d-58.26252678424148!3d-34.737415072092524!2m3!1f0!2f0!
                  3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32e60d854559f%3A0x7a96e6d69cf0253d!2sTriunvirato%20700%2C%20Quilmes%2C%20Provincia%20de%20Bue
                  nos%20Aires!5e0!3m2!1ses!2sar!4v1657838977303!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "Espacio Las Moras": ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.4222724204874!2d-58.25529308424205!3d-34.71974897115468!2m3!1f0!2f0!
              3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32e40a0c20fe1%3A0x9135b1a0f0f21fa5!2sAv.%20Rivadavia%20430%2C%20Quilmes%2C%20Provincia%20de%2
              0Buenos%20Aires!5e0!3m2!1ses!2sar!4v1657839016260!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "Aniceto": ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.217596413237!2d-58.254673484241806!3d-34.72490917142864!2m3!1f0!2f0!
                  3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32e43fafc6b15%3A0xc92f008b8bdc4825!2s25%20de%20Mayo%20304%2C%20Quilmes%2C%20Provincia%20de%20
                  Buenos%20Aires!5e0!3m2!1ses!2sar!4v1657839047761!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "El Amanecer": ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14711.19123246293!2d-58.24217370464947!3d-34.79221179610538!2m3!1f0!2f0!
                  3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32924d528c31b%3A0x7d4b4c97f0f75973!2sCno.%20Gral.%20Manuel%20Belgrano%202049%2C%20B1884MIS%2
                  0Berazategui%20Oeste%2C%20Provincia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1657839105352!5m2!1ses!2sar" width="600" height="450" 
                  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "Café Sur": ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3277.95967266009!2d-58.21055998424106!3d-34.75660867311193!2m3!1f0!2f0!3f
                  0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32f489c8d1e59%3A0xd4acf87e82894cac!2sAv.%20Mitre%201065%2C%20B1880EEK%20Berazategui%2C%20Provin
                  cia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1657839140019!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen=""
                  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "Un Tano y Dos Gallegos": ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3277.727863503167!2d-58.210670684240995!3d-34.76244747342195!2m3!1f0!2f0!
                  3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32f4bc6331bc5%3A0xf4f11cefd961f59a!2sC.%2015%204769%2C%20B1880GAC%20Berazategui%2C%20Provinci
                  a%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1657839167900!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" 
                  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "Antares": ?>
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3278.084547579259!2d-58.21749828424115!3d-34.753462972944575!2m3!1f0!2f0!
                  3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32f392b772923%3A0x27d61fa8c93c2355!2sC.%206%20A%204822%2C%20B1880AQF%20Berazategui%2C%20Provi
                  ncia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1657839203871!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" 
                  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "Bodegón Verdi": ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.9890799580153!2d-58.288119084242325!3d-34.705455370396336!2m3!1f0!2
                  f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a332014a71e799%3A0xe69421d85c73!2sCramer%20723%2C%20Bernal%2C%20Provincia%20de%20Buenos%20
                  Aires!5e0!3m2!1ses!2sar!4v1657839238404!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "Lo de Manu parrilla": ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.6610459817925!2d-58.29116358424216!3d-34.71372827083522!2m3!1f0!2f0
                  !3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32df974df047d%3A0xefc7f52113197076!2sAvellaneda%20401%2C%20Bernal%2C%20Provincia%20de%20Buen
                  os%20Aires!5e0!3m2!1ses!2sar!4v1657839315254!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "Cervecería Popular": ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.7793505401864!2d-58.285595684242246!3d-34.71074487067697!2m3!1f0!2f0!
                  3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32dff009c7571%3A0x54cfb1f706a85cbb!2s25%20de%20Mayo%2093%2C%20Bernal%2C%20Provincia%20de%20Bue
                  nos%20Aires!5e0!3m2!1ses!2sar!4v1657839345536!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          case "La Tavola": ?>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2318.9628391349015!2d-58.27715482960279!3d-34.71757156121424!2m3!1f0!2f0!3
                  f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a32e0f2b83acdd%3A0x128e16cd798b59d7!2sAndr%C3%A9s%20Baranda%20101%2C%20Quilmes%2C%20Provincia%20
                  de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1657839380990!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" 
                  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <?php break;
          default:
          break;
        }
      }
        ?>
    </div>
    <div>
      <?php echo "<h4 class='divCol'> dirección: $direc  </h4>"  ?>
    </div>
  </div>
</div>



























<?php
require "./layout/footer.php";
?>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
 integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


</body>
</html>