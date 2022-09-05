<?php

require "conexion.php";

$con = mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");

if(isset($_SESSION['usu_mail'])){
    $nomyape= $_SESSION['nombre'];
}
else{
    echo "ACCESO NO AUTORIZADO<br> DEBE INICIAR SESIÓN";
    echo '<meta http-equiv="Refresh" content="3; url=index.php">';
    exit();
}


$idResto = $_POST['idResto'];
$fecha=$_POST['fecha'];
$comensales=$_POST['comensales'];
$mesa=$_POST['mesa'];
$idUsuario=$_POST['idUsuario'];
$estrellas=$_POST['estrellas'];
$diaActual= date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
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
<div class="boton-volver m-3">
    <a class="btn btn-outline-light" href="index.php">Volver</a>
</div>


<?php
$getPuntuacion = "SELECT * FROM calificaciones WHERE rest_id=$idResto and usur_id=$idUsuario;";
$resultPuntuacion = mysqli_query($con, $getPuntuacion);
if(mysqli_affected_rows($con)>0){   //SI YA HABÍA PUNTUADO EL USU EN EL RESTO

    $conn = mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");

    if($_POST['comentario'] != ""){     // SI ACTUALIZA VOTO Y COMENTARIO
        $comentario=$_POST['comentario'];

        $updateCom = "UPDATE calificaciones SET punt_valor=$estrellas, comentario= '$comentario', fecha_comentario='$diaActual'
                       WHERE rest_id=$idResto AND usur_id=$idUsuario;";
        $resultUpdateCom = mysqli_query($conn, $updateCom);
        if(mysqli_affected_rows($conn)>0){
            echo "<h5 class='textoPrinc'> ¡Se ha actualizadon su puntuación y comentario! </h5>";
        }else{
            echo "<h5 class='textoPrinc'> No se han podido actualizar su puntuación y comentario. Intente nuevamente. </h5>";
        }
    }else{  //SI SOLO ACTUALIZA VOTO
        $updatePunt = "UPDATE calificaciones SET punt_valor=$estrellas
                       WHERE rest_id=$idResto AND usur_id=$idUsuario;";
        $resultUpdatePunt = mysqli_query($conn, $updatePunt);
        if(mysqli_affected_rows($conn)>0){
            echo "<h5 class='textoPrinc'> ¡Se ha actualizadon su puntuación! </h5>";
        }else{
            echo "<h5 class='textoPrinc'> No se ha podido actualizar su puntuación. Intente nuevamente. </h5>";
        }
    }
    
}else{      //SI NUNCA VOTÓ

    $conne = mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");


    if($_POST['comentario'] != ""){     // INSERT VOTO Y COMENTARIO
    $comentario=$_POST['comentario']; 
        $sql = "INSERT INTO  calificaciones (punt_valor, rest_id, usur_id, comentario, fecha_comentario) VALUES ($estrellas, $idResto, $idUsuario, '$comentario', '$diaActual');";
        $result = mysqli_query($conne, $sql);

        if(mysqli_affected_rows($conne)>0){
            echo "<h5 class='textoPrinc'> ¡Gracias por compartir su opinión! </h5>";
        }else{
            echo "<h5 class='textoPrinc'> Su opinión no ha podido ser guardada. Intente nuevamente. </h5>";
        }
    }else{      //INSERT SOLO VOTO
        $insertPunt = "INSERT INTO  calificaciones (punt_valor, rest_id, usur_id) VALUES ($estrellas, $idResto, $idUsuario);";
        $resultPunt = mysqli_query($conne, $insertPunt);

        if(mysqli_affected_rows($conne)>0){
            echo "<h5 class='textoPrinc'> ¡Gracias por compartir su opinión! </h5>";
        }else{
            echo "<h5 class='textoPrinc'> Su opinión no ha podido ser guardada. Intente nuevamente. </h5>";
        }
    }
}
?>

<form action="restaurantes.php" method="POST">
    <input type=hidden name=idResto value=<?php echo $idResto ?>>
    <input type=hidden name=fecha value=<?php echo $fecha ?>>
    <input type=hidden name=comensales value=<?php echo $comensales ?>>
    <input type=hidden name=mesa value=<?php echo $mesa ?>>
    <!-- <input type=hidden name=idUsuario value= <?php echo $idUsuario ?>> -->
    <input type="submit" class="btn btn-success" value="Volver">
</form>




<?php
require "./layout/footer.php";
?>



</body>
</html>











