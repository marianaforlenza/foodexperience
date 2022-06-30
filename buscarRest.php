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





<body>




<form method=POST>


    
<?php
   
   $fecha=$_POST['fecha'];
   $zona=$_POST['zona'];
   $comensales=$_POST['comensales'];
   
   
   // echo "La fecha seleccionada es $fecha<br>";
    //echo "La zona seleccionada es $zona<br>";
    //echo "Los comensales seleccionados son $comensales<br>";
    
    require "conexion.php";
    
    $con=mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die("no se pudo conectar a la BD");
 
     
    $sqlBuscarRest="select * from restaurantes INNER join disponibilidad where disponibilidad.fecha='$fecha' and  disponibilidad.cant_comensales >= $comensales and restaurantes.zon_id = $zona and disponibilidad.estado = false";

    $resultRest=mysqli_query($con,$sqlBuscarRest);

    if(mysqli_affected_rows($con)>0){
       // echo "Se encontro el rest<br><br>";
    }
    else{
        echo "<h3>No se encontró disponibilidad con los datos ingresados<h3><br><br>";
        
           }
           
      ?> 
      
      <div class="divCol">
      
      
      <?php
           
           
    while($row = mysqli_fetch_row($resultRest)){
        ?>
        
        <!-- <input type=radio name=selec value=<?php echo $row[0]?>> -->
        
        <div class="divCol">
        
          <!-- Columna Foto rest -->
        
        <inpunt> <img src="<?php echo $row[7]?>" class="fotoAchi" alt="..."> </input> <br>
        
        <!-- Columna Nombre rest -->
        
        <label>Nombre del Resturant:  </label><inpunt><?php echo $row[1]?></input> <br>
        
        <!-- Columna Direccion -->
        <label>Direccion:  </label><inpunt><?php echo $row[2]?></input> <br>
        
        
        <!-- Telefono-->
        <label>Telefono:  </label><inpunt><?php echo $row[3]?></input> <br>
        
        <!-- Numero de Mesa -->
        <label>Numero de Mesa:  </label><inpunt><?php echo $row[10]?></input> <br>
        
        <!-- Fecha -->
        <label>Fecha:  </label><inpunt><?php echo $row[11]?></input> <br>
        
         <!-- Cantidad de comensales -->
        <label>Cantidad de Comensales:  </label><inpunt><?php echo $row[12]?></input> <br>
           </div>     
        
    <?php
    }
    ?> 


 </div>     
        



</body>



  <!-- footer -->
  <footer>
  <!-- parte izquierda -->
  <div class="item-footer">
    <p> </p>
  </div>
    <!-- parte centro -->
  <div class="item-footer centrar">
    <p> Hecho con <i class="bi bi-suit-heart-fill" style="font-size:0.8rem; color:red"></i></p>
    <p> por Vale, Maru y Jair<p>
  </div>
  <!-- parte derecha -->
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
  
  
  




<!-- js bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
 integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>
</html>
