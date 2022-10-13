<?php

require "conexion.php";

$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");

$id_rest = $_POST['id_rest'];
$id_rest1 = $_POST['id_rest1'];
$id_rest2 = $_POST['id_rest2'];
$id_rest3 = $_POST['id_rest3'];

if(isset($_POST["submit"])){
    if($id_rest != 0){
    if(isset($_FILES['fotoPrincipal']['name'])){
        $tipoArchivo=$_FILES['fotoPrincipal']['type'];
        $nombreArchivo=$_FILES['fotoPrincipal']['name'];
        $tamanoArchivo=$_FILES['fotoPrincipal']['size'];
        $imagenSubida=fopen($_FILES['fotoPrincipal']['tmp_name'], 'r');
        $binariosImagen=fread($imagenSubida, $tamanoArchivo);
        $binariosImagen=mysqli_escape_string($con, $binariosImagen);
        
        $sqlSubir = "UPDATE restaurantes SET imagenPrincipal='$binariosImagen', nombreImagen='$nombreArchivo',tipoImagen='$tipoArchivo'
                     WHERE id = $id_rest;";
        
        $resultSubir = mysqli_query($con, $sqlSubir);

        if($resultSubir){
            echo "Archivo Subido Correctamente en imagen Principal. <br>";
        }else{
            echo "Ha fallado la subida, reintente nuevamente.";
        } 
    }
    }

    if($id_rest1 != 0){
    if(isset($_FILES['foto1']['name'])){
        $tipoArchivo1=$_FILES['foto1']['type'];
        $nombreArchivo1=$_FILES['foto1']['name'];
        $tamanoArchivo1=$_FILES['foto1']['size'];
        $imagenSubida1=fopen($_FILES['foto1']['tmp_name'], 'r');
        $binariosImagen1=fread($imagenSubida1, $tamanoArchivo1);
        $binariosImagen1=mysqli_escape_string($con, $binariosImagen1);
        
        $sqlSubir1 = "UPDATE restaurantes SET imagen1='$binariosImagen1', tipoImagen1='$tipoArchivo1'
                     WHERE id = $id_rest1;";
        
        $resultSubir1 = mysqli_query($con, $sqlSubir1);

        if($resultSubir1){
            echo "Archivo Subido Correctamente en Foto 1.<br>";
        }else{
            echo "Ha fallado la subida, reintente nuevamente.";
        } 
    }
    }

    if($id_rest2 != 0){
    if(isset($_FILES['foto2']['name'])){
        $tipoArchivo2=$_FILES['foto2']['type'];
        $nombreArchivo2=$_FILES['foto2']['name'];
        $tamanoArchivo2=$_FILES['foto2']['size'];
        $imagenSubida2=fopen($_FILES['foto2']['tmp_name'], 'r');
        $binariosImagen2=fread($imagenSubida2, $tamanoArchivo2);
        $binariosImagen2=mysqli_escape_string($con, $binariosImagen2);
        
        $sqlSubir2 = "UPDATE restaurantes SET imagen2='$binariosImagen2', tipoImagen2='$tipoArchivo2'
                     WHERE id = $id_rest2;";
        
        $resultSubir2 = mysqli_query($con, $sqlSubir2);

        if($resultSubir2){
            echo "Archivo Subido Correctamente en Foto 2.<br>";
        }else{
            echo "Ha fallado la subida, reintente nuevamente.";
        } 
    }
    }

    if($id_rest3 != 0){
    if(isset($_FILES['foto3']['name'])){
        $tipoArchivo3=$_FILES['foto3']['type'];
        $nombreArchivo3=$_FILES['foto3']['name'];
        $tamanoArchivo3=$_FILES['foto3']['size'];
        $imagenSubida3=fopen($_FILES['foto3']['tmp_name'], 'r');
        $binariosImagen3=fread($imagenSubida3, $tamanoArchivo3);
        $binariosImagen3=mysqli_escape_string($con, $binariosImagen3);
        
        $sqlSubir3 = "UPDATE restaurantes SET imagen3='$binariosImagen3', tipoImagen3='$tipoArchivo3'
                     WHERE id = $id_rest3;";
        
        $resultSubir3 = mysqli_query($con, $sqlSubir3);

        if($resultSubir3){
            echo "Archivo Subido Correctamente en Foto 3.<br>";
        }else{
            echo "Ha fallado la subida, reintente nuevamente.";
        } 
    }
    }
}

?>