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

    $getRest = "SELECT * FROM restaurantes WHERE id= $idResto;";
    $resultSet = mysqli_query ($con, $getRest);
    $resto = mysqli_fetch_array($resultSet);
    $id = $resto[0];
    $foto_P_1= $resto[6];
    $foto_P_2= $resto[4];
    $foto_1_1= $resto[8];
    $foto_1_2= $resto[7];
    $foto_2_1= $resto[10];
    $foto_2_2= $resto[9];
    $foto_3_1= $resto[12];
    $foto_3_2= $resto[11];
?>


<div class="textoPrinc formul">
    <h4 class="mb-2">Editar datos del restaurante <?php echo $resto[1] ?> </h4>
    <form method="POST" action="editarRestOK.php" enctype="multipart/form-data">
        <div class="formR">
            <div class="editR-input">
                <div>
                    <label for="nomR"><i class="bi bi-pencil"></i> Nombre del Restaurante: </label>
                </div>
                <div>
                    <input class="formI inputCap" type="text" id="nomR" maxlength="45" minlength="2" name="nomR" required style="width:100%" value="<?php echo $resto[1] ?>"><br>
                </div>
                <div>
                    <label for="dirR"><i class="bi bi-pin-map-fill"></i> Dirección</label>
                </div>
                <div>
                    <input class="formI inputCap" type="text" id="dirR" maxlength="45" minlength="5" name="dirR" required style="width:100%" value="<?php echo $resto[2] ?>"><br>
                </div>
                <div>
                    <label for="telR" class=""><i class="bi bi-telephone-fill"></i> Telefono</label>
                </div>
                <div>
                    <input class="formI" id="telR" type="text" class="" pattern="[0-9]{6,15}" title="Solo números. Tamaño mínimo: 6, máximo: 15" required name="telR" style="width:100%"  value="<?php echo $resto[3] ?>"><br>
                </div>
                    <!-- IMAGEN PRINCIPAL -->
                <div>
                    <label><span class="centrarT"><i class="bi bi-image"></i> Foto Principal </span> <button type="button" data-toggle="modal" data-target="#foto_Princ<?= $id; ?>">
                        <img width="50" height="25" class="card-img-top" src="data:<?php echo $foto_P_1; ?>
                        ;base64,<?php echo base64_encode($foto_P_2);?>"></button></label>
                </div>
                <div>
                    <input type="file" name="fotoPrincipal" multiple><br><br>
                </div>
                    <!-- IMAGEN 1 -->
                <div>
                    <label><span class="centrarT"><i class="bi bi-image"></i> Imagen 1 </span><button type="button" data-toggle="modal" data-target="#foto_1<?= $id; ?>">
                        <img width="50" height="25" class="card-img-top" src="data:<?php echo $foto_1_1; ?>
                        ;base64,<?php echo base64_encode($foto_1_2);?>"></button></label>
                </div>
                <div>
                    <input type="file" name="foto1" multiple><br><br>
                </div>
                <!-- IMAGEN 2 -->
                <div>
                    <label><span class="centrarT"><i class="bi bi-image"></i> Imagen 2 </span><button type="button" data-toggle="modal" data-target="#foto_2<?= $id; ?>">
                        <img width="50" height="25" class="card-img-top" src="data:<?php echo $foto_2_1; ?>
                        ;base64,<?php echo base64_encode($foto_2_2);?>"></button></label>
                </div>
                <div>
                    <input type="file" name="foto2" multiple><br><br>
                </div>
                <!-- IMAGEN3 -->
                <div>
                    <label><span class="centrarT"><i class="bi bi-image"></i> Imagen 3 </span><button type="button" data-toggle="modal" data-target="#foto_3<?= $id; ?>">
                        <img width="50" height="25" class="card-img-top" src="data:<?php echo $foto_3_1; ?>
                        ;base64,<?php echo base64_encode($foto_3_2);?>"></button></label>
                </div>
                <div>
                    <input type="file" name="foto3" multiple><br><br>
                </div>
                <!-- ZONA -->
                <div>
                    <label for="zonaR"><i class="bi bi-geo-alt-fill"></i> Zona </label>
                    <select class="ml-2" id="zonaR" name="zonaR">
                        <?php
                        $getZona="SELECT * FROM zonas;";
                        $sqlZona=mysqli_query($con, $getZona);
                        $idZona = $resto[14];
                        $nroZona = 0;
                        while($zona = mysqli_fetch_array($sqlZona)){ 
                            $sel = "";
                            if($nroZona == $idZona){
                                $sel = "selected";
                            }?>
                            <option value="<?php echo $zona[0] ?>" <?php echo $sel ?>> <?php echo $zona['descripcion'] ?> </option>
                        <?php
                        $nroZona++;
                    }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agrZ">Agregar zona</button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#elimZ">Eliminar zona</button>
                </div>
                    <!-- CATEGORÍA -->
                <div>       
                    <label for="catR"><i class="bi bi-tag"></i> Categoría</label>
                    <select class="ml-2" id="catR" name="catR">
                        <?php
                        $getCat="SELECT * FROM categorias;";
                        $sqlCat=mysqli_query($con, $getCat);
                        $idCat = $resto[15];
                        $nroCat = 0;
                        while($cat = mysqli_fetch_array($sqlCat)){ 
                            $selec = "";
                            if( $nroCat == $idCat){
                                $selec = "selected";
                            }?>
                            <option value="<?php echo $cat[0] ?>" <?php echo $selec ?>> <?php echo $cat['descripcion'] ?> </option>
                        <?php
                        $nroCat++;
                    }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agrC">Agregar categoría</button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#elimC">Eliminar categoría</button>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <p> El tamaño máximo total de los archivos debe ser menor a 3MB. Si los archivos superarán ese peso, agregue solo unas imágenes y, posteriormente, las restantes.<p>
        </div>
        <div>
            <input type=hidden name="idResto" value=<?php echo $idResto ?>>
            <input type="submit" class="btn btn-success" value="Editar Restaurante">
        </div>
    </form>   
</div>

<!-- MODAL FOTO PRINCIPAL -->
<div class="modal fade" id="foto_Princ<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img width="450" height="350" class="img-rounded" src="data:<?php echo $foto_P_1; ?>;base64,<?php echo base64_encode($foto_P_2);?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                                                        <!-- MODAL FOTO 1 -->
<div class="modal fade" id="foto_1<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img width="450" height="350" class="img-rounded" src="data:<?php echo $foto_1_1; ?>;base64,<?php echo base64_encode($foto_1_2);?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
                                                        <!-- MODAL FOTO 2 -->
<div class="modal fade" id="foto_2<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img width="450" height="350" class="img-rounded" src="data:<?php echo $foto_2_1; ?>;base64,<?php echo base64_encode($foto_2_2);?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
                                                    <!-- MODAL FOTO 3 -->
<div class="modal fade" id="foto_3<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img width="450" height="350" class="img-rounded" src="data:<?php echo $foto_3_1; ?>;base64,<?php echo base64_encode($foto_3_2);?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR ZONA -->
<div class="modal fade" id="agrZ" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregue nueva Zona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input class="inputCap" type="text" pattern="[a-zA-ZñÑ\s]{2,40}" title="Solo letras sin tilde. Tamaño mínimo: 2, máximo: 40" required name="agrZona">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-success" value="Agregar" formaction="agrAnexos.php"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR ZONA -->
<div class="modal fade" id="elimZ" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleecione la Zona a eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <select class="ml-2"  name="elimZona" required>
                        <?php
                        $getZona="SELECT * FROM zonas ORDER BY descripcion ASC;";
                        $sqlZona=mysqli_query($con, $getZona);
                        while($zona = mysqli_fetch_array($sqlZona)){ ?>
                            <option value="<?php echo $zona[0] ?>"> <?php echo $zona['descripcion'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-success" value="Eliminar" formaction="agrAnexos.php"></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL AGREGAR CATEGORÍA -->
<div class="modal fade" id="agrC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregue nueva Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input  class="inputCap" type="text" pattern="[a-zA-ZñÑ\s]{2,40}" title="Solo letras sin tilde. Tamaño mínimo: 2, máximo: 40" required name="agrCat">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-success" value="Agregar" formaction="agrAnexos.php"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ELIMINAR CATEGORÍA -->
<div class="modal fade" id="elimC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione la Categoría a eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <select class="ml-2" name="elimCat" required>
                        <?php
                        $getCat="SELECT * FROM categorias ORDER BY descripcion ASC;";
                        $sqlCat=mysqli_query($con, $getCat);
                        while($cat = mysqli_fetch_array($sqlCat)){ ?>
                            <option value="<?php echo $cat[0] ?>"> <?php echo $cat['descripcion'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-success" value="Eliminar" formaction="agrAnexos.php"></button>
                </div>
            </form>
        </div>
    </div>
</div>




<?php
require "./layout/footer.php";
?>


</body>
</html>