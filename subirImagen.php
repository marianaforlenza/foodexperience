<?php

require "conexion.php";

$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>



<body>
    
<div >





    <h4 >Seleccione imagen a cargar</h4>
    <form name="MiForm" id="MiForm" method="POST" action="subiendoImagen.php" enctype="multipart/form-data">
        <!-- IMAGEN PRINCIPAL -->
        <div>
        <label >Archivos de imagenPrincipal</label>
            <input type="file"  id="image" name="fotoPrincipal" multiple><br><br>
        </div>

        <div class="col-md-3 mb-3 mt-5 ml-5">
            <label for="id_rest">ID del restaurante a agregar/actualizar imagen </label>
            <select class="custom-select is-invalid" id="id_rest" name="id_rest">
                <option selected  value="0">Elija...</option>
                <?php
                $getId = "SELECT * FROM restaurantes";
                $getIdResto = mysqli_query($con, $getId);
                while($row = mysqli_fetch_array($getIdResto)){
                $id = $row[0];
                $descripcion = $row[1];
                ?>
                <option value = "<?php echo $id; ?>"> <?php echo $id. " " . $descripcion ?> </option>
                <?php } ?>
            </select><br><br>
        </div>

        <!-- IMAGEN 1 -->
        <label >Archivos de imagen1</label>
        <div >
            <input type="file"  id="image" name="foto1" multiple><br><br>
        </div>

        <div class="col-md-3 mb-3 mt-5 ml-5">
            <label for="id_rest1">ID del restaurante a agregar/actualizar imagen </label>
            <select class="custom-select is-invalid" id="id_rest1" name="id_rest1">
                <option selected  value="0">Elija...</option>
                <?php
                $getId1 = "SELECT * FROM restaurantes";
                $getIdResto1 = mysqli_query($con, $getId1);
                while($row1 = mysqli_fetch_array($getIdResto1)){
                $id1 = $row1[0];
                $descripcion1 = $row1[1];
                ?>
                <option value = "<?php echo $id1; ?>"> <?php echo $id1. " " . $descripcion1 ?> </option>
                <?php } ?>
            </select><br><br>
        </div>

        <!-- IMAGEN 2 -->
        <label >Archivos de imagen2</label>
        <div >
            <input type="file"  id="image" name="foto2" multiple><br><br>
        </div>

        <div class="col-md-3 mb-3 mt-5 ml-5">
            <label for="id_rest2">ID del restaurante a agregar/actualizar imagen </label>
            <select class="custom-select is-invalid" id="id_rest2" name="id_rest2">
                <option selected  value="0">Elija...</option>
                <?php
                $getId2 = "SELECT * FROM restaurantes";
                $getIdResto2 = mysqli_query($con, $getId2);
                while($row2 = mysqli_fetch_array($getIdResto2)){
                $id2 = $row2[0];
                $descripcion2 = $row2[1];
                ?>
                <option value = "<?php echo $id2; ?>"> <?php echo $id2. " " . $descripcion2 ?> </option>
                <?php } ?>
            </select><br><br>
        </div>

        <!-- IMAGEN3 -->
        <label >Archivos de imagen3</label>
        <div >
            <input type="file"  id="image" name="foto3" multiple><br><br>
        </div>
        <div class="col-md-3 mb-3 mt-5 ml-5">
            <label for="id_rest3">ID del restaurante a agregar/actualizar imagen </label>
            <select class="custom-select is-invalid" id="id_rest3" name="id_rest3">
                <option selected value="0">Elija...</option>
                <?php
                $getId3 = "SELECT * FROM restaurantes";
                $getIdResto3 = mysqli_query($con, $getId3);
                while($row3 = mysqli_fetch_array($getIdResto3)){
                $id3 = $row3[0];
                $descripcion3 = $row3[1];
                ?>
                <option value = "<?php echo $id3; ?>"> <?php echo $id3. " " . $descripcion3 ?> </option>
                <?php } ?>
            </select><br><br><br><br>
        </div>

        <!-- <label for="id_rest" >ID de restaurante a agregar imagen</label>
        <input id="id_rest" type="text" pattern="[0-9]{1,7}"  title="Solo números. Tamaño mínimo: 1, máximo: 7" required name="id_rest"><br><br> -->

        <button name="submit" class="btn btn-primary">Cargar Imagen</button>
    </form>
</div>











</body>
</html>