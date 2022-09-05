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

<div class="textoPrinc formul">
    <h4 class="mb-2">Agregar un nuevo restaurante</h4>
    <form method="POST" action="creandoRest.php" enctype="multipart/form-data">
        <div class="formR">
            <div class="formR-input">
                <div>
                    <label for="nomR"><i class="bi bi-pencil"></i> Nombre del Restaurante: </label>
                </div>
                <div>
                    <input class="formI inputCap" type="text" id="nomR" maxlength="45" minlength="2" name="nomR" required style="width:100%"><br>
                </div>
                <div>
                    <label for="dirR"><i class="bi bi-pin-map-fill"></i> Dirección</label>
                </div>
                <div>
                    <input class="formI inputCap" type="text" id="dirR" maxlength="45" minlength="5" name="dirR" required style="width:100%"><br>
                </div>
                <div>
                    <label for="telR" class=""><i class="bi bi-telephone-fill"></i> Telefono</label>
                </div>
                <div>
                    <input class="formI" id="telR" type="text" class="" pattern="[0-9]{6,15}" title="Solo números. Tamaño mínimo: 6, máximo: 15" required name="telR" style="width:100%"><br>
                </div>
                    <!-- IMAGEN PRINCIPAL -->
                <div>
                    <label for="fotoPrincipal"><i class="bi bi-image"></i> Imagen Principal</label>
                </div>
                <div>
                    <input type="file" id="fotoPrincipal" name="fotoPrincipal" multiple required><br><br>
                </div>
                    <!-- IMAGEN 1 -->
                <div>
                    <label for="foto1"><i class="bi bi-image"></i> Imagen 1</label>
                </div>
                <div>
                    <input type="file" id="foto1" name="foto1" multiple required><br><br>
                </div>
                <!-- IMAGEN 2 -->
                <div>
                    <label for="foto2"><i class="bi bi-image"></i> Imagen 2</label>
                </div>
                <div>
                    <input type="file" id="foto2" name="foto2" multiple required><br><br>
                </div>
                <!-- IMAGEN3 -->
                <div>
                    <label for="foto3"><i class="bi bi-image"></i> Imagen 3</label>
                </div>
                <div>
                    <input type="file" id="foto3" name="foto3" multiple required><br><br>
                </div>
                <div>
                    <label for="zonaR"><i class="bi bi-geo-alt-fill"></i> Zona </label>
                    <select class="ml-2" id="zonaR" name="zonaR" required>
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
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agrZ">Agregar zona</button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#elimZ">Eliminar zona</button>
                </div>
                <div>
                    <label for="catR"><i class="bi bi-tag"></i> Categoría</label>
                    <select class="ml-2" id="catR" name="catR" required>
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
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agrC">Agregar categoría</button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#elimC">Eliminar categoría</button>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <p> El tamaño máximo total de los archivos debe ser menor a 3MB. Si los archivos superan ese peso, agregue solo unas imágenes y las restantes en Editar restaurante.<p>
        </div>
        <div>
            <input type="submit" class="btn btn-success" value="Agregar Restaurante">
        </div>
    </form>
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
                <h5 class="modal-title" id="exampleModalLabel">Seleccione la Zona a eliminar</h5>
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