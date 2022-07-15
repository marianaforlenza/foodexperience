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

<!-- <div class="contenedor"> -->
  <!-- header -->
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
            <p>Bienvenida/o <?php echo $nombreCompleto ?></p>
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

    <br><h4 class="textoPrinc"> Reservas actuales: </h4><br>
    <table>
        <tr>
            <th class="filas-tabla"> Fecha </th>
            <th class="filas-tabla"> Restaurante </th>
            <th class="filas-tabla"> Zona </th>
            <th class="filas-tabla"> Dirección </th>
            <th> </th>
        </tr>

        <?php

        $sqlReservas = "SELECT * FROM disponibilidad WHERE  usu_id = $idUsuario and fecha > NOW() ORDER BY fecha;";
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



    <br><br><h4 class="textoB"> Historial de reservas: </h4><br>
    <table>

        <tr>
            <th> Fecha </th>
            <th> Restaurante </th>
            <th> Zona </th>
            <th> Dirección </th>
        </tr>

        <?php

        $sqlReservas = "SELECT * FROM disponibilidad WHERE  usu_id = $idUsuario and fecha <= NOW();";
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



















  <!-- js bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
 integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>

</html>