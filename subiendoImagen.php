<?php

require "conexion.php";

$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");

$id_rest = $_POST['id_rest'];


if(isset($_POST["submit"])){
    if(isset($_FILES['foto']['name'])){
        $tipoArchivo=$_FILES['foto']['type'];
        $nombreArchivo=$_FILES['foto']['name'];
        $tamanoArchivo=$_FILES['foto']['size'];
        $imagenSubida=fopen($_FILES['foto']['tmp_name'], 'r');
        $binariosImagen=fread($imagenSubida, $tamanoArchivo);
        $binariosImagen=mysqli_escape_string($con, $binariosImagen);
        

        $sqlSubir = "UPDATE restaurantes SET imagenPrincipal='$binariosImagen', nombreImagen='$nombreArchivo',tipoImagen='$tipoArchivo'
                     WHERE id = $id_rest;";
        
        $resultSubir = mysqli_query($con, $sqlSubir);

        if($resultSubir){
            echo "Archivo Subido Correctamente.";
        }else{
            echo "Ha fallado la subida, reintente nuevamente.";
        } 
    }
}

?>