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

$idResto = $_POST['idResto'];
$nomR=$_POST['nomR'];
$dirR=$_POST['dirR'];
$telR=$_POST['telR'];
// $id_rest = $_POST['fotoPrincipal'];
// $id_rest1 = $_POST['foto1'];
// $id_rest2 = $_POST['foto2'];
// $id_rest3 = $_POST['foto3'];
$zonaR=$_POST['zonaR'];
$catR=$_POST['catR'];



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
    <a class="btn btn-outline-light" href="listaRestaurantes.php">Volver</a>
</div>

<?php
    $sqlUpdate= "UPDATE restaurantes SET nombre='$nomR', direccion='$dirR', tel='$telR', zon_id=$zonaR, cat_id=$catR WHERE id = $idResto;";
    $resultUpdate= mysqli_query($con, $sqlUpdate);
    if(mysqli_affected_rows ($con)>0){
        echo "<p class='textoPrinc'> Se actualizaron los datos correctamente.<p><br>";
    } else{
        echo "<p class='textoPrinc'> Hubo un problema con la actualización de los datos. Intente nuevamente.<p><br>";
    }


        if($_FILES['fotoPrincipal']['name']!=""){
            $tipoArchivo=$_FILES['fotoPrincipal']['type'];
            $nombreArchivo=$_FILES['fotoPrincipal']['name'];
            $tamanoArchivo=$_FILES['fotoPrincipal']['size'];
            $imagenSubida=fopen($_FILES['fotoPrincipal']['tmp_name'], 'r');
            $binariosImagen=fread($imagenSubida, $tamanoArchivo);
            $binariosImagen=mysqli_escape_string($con, $binariosImagen);
            
            $sqlSubir = "UPDATE restaurantes SET imagenPrincipal='$binariosImagen', nombreImagen='$nombreArchivo',tipoImagen='$tipoArchivo'
                         WHERE id = $idResto;";
            
            $resultSubir = mysqli_query($con, $sqlSubir);
    
            if($resultSubir){
                echo "<p class='textoPrinc'> Archivo Subido Correctamente en imagen Principal. <p><br>";
            }else{
                echo "<p class='textoPrinc'> Ha fallado la subida de la imagen Principal, intente nuevamente.<p><br>";
            } 
        }

    

        if($_FILES['foto1']['name']!=""){
            $tipoArchivo1=$_FILES['foto1']['type'];
            $nombreArchivo1=$_FILES['foto1']['name'];
            $tamanoArchivo1=$_FILES['foto1']['size'];
            $imagenSubida1=fopen($_FILES['foto1']['tmp_name'], 'r');
            $binariosImagen1=fread($imagenSubida1, $tamanoArchivo1);
            $binariosImagen1=mysqli_escape_string($con, $binariosImagen1);
            
            $sqlSubir1 = "UPDATE restaurantes SET imagen1='$binariosImagen1', tipoImagen1='$tipoArchivo1'
                         WHERE id = $idResto;";
            
            $resultSubir1 = mysqli_query($con, $sqlSubir1);
    
            if($resultSubir1){
                echo "<p class='textoPrinc'> Archivo Subido Correctamente en Foto 1.<p><br>";
            }else{
                echo "<p class='textoPrinc'> Ha fallado la subida de la imagen 1, reintente nuevamente.<p><br>";
            } 
        }

    

        if($_FILES['foto2']['name']!=""){
            $tipoArchivo2=$_FILES['foto2']['type'];
            $nombreArchivo2=$_FILES['foto2']['name'];
            $tamanoArchivo2=$_FILES['foto2']['size'];
            $imagenSubida2=fopen($_FILES['foto2']['tmp_name'], 'r');
            $binariosImagen2=fread($imagenSubida2, $tamanoArchivo2);
            $binariosImagen2=mysqli_escape_string($con, $binariosImagen2);
            
            $sqlSubir2 = "UPDATE restaurantes SET imagen2='$binariosImagen2', tipoImagen2='$tipoArchivo2'
                         WHERE id = $idResto;";
            
            $resultSubir2 = mysqli_query($con, $sqlSubir2);
    
            if($resultSubir2){
                echo "<p class='textoPrinc'> Archivo Subido Correctamente en Foto 2.<p><br>";
            }else{
                echo "<p class='textoPrinc'> Ha fallado la subida de la imagen 2, reintente nuevamente.<p><br>";
            } 
        }

    
 
        if($_FILES['foto3']['name']!=""){
            $tipoArchivo3=$_FILES['foto3']['type'];
            $nombreArchivo3=$_FILES['foto3']['name'];
            $tamanoArchivo3=$_FILES['foto3']['size'];
            $imagenSubida3=fopen($_FILES['foto3']['tmp_name'], 'r');
            $binariosImagen3=fread($imagenSubida3, $tamanoArchivo3);
            $binariosImagen3=mysqli_escape_string($con, $binariosImagen3);
            
            $sqlSubir3 = "UPDATE restaurantes SET imagen3='$binariosImagen3', tipoImagen3='$tipoArchivo3'
                         WHERE id = $idResto;";
            
            $resultSubir3 = mysqli_query($con, $sqlSubir3);
    
            if($resultSubir3){
                echo "<p class='textoPrinc'> Archivo Subido Correctamente en Foto 3.<p><br>";
            }else{
                echo "<p class='textoPrinc'> Ha fallado la subida de la imagen 3, reintente nuevamente.<p><br>";
            } 
        }



?>






<?php
require "./layout/footer.php";
?>


</body>
</html>