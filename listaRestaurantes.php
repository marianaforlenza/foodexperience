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
    <title>Food Experience</title>

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


<div class="btnCrearR-buscar mb-3">
    <div class="btn-agr">
        <a class="btn btn-primary" href="agrRest.php">Agregar restaurante</a>
    </div>
    <div class="buscar formul">
        <form action=listaRestaurantes.php method=POST>
            <input class="formI formC" type=text placeholder="Ingrese su búsqueda" name=buscarRest>
            <input class="btn btn-secondary" type=submit value="Buscar">
        </form>
    </div>
</div>


<!-- <div>
    <label for="ordenar"> Ordenar por </label>
    <select id="ordenar" name="ordenar">
        <option selected disabled value="">Elija...</option>
        <option value="listaRestaurantes.php?nombreAsc">Nombre Asc</option>
        <a href="index.php"><option value="">Nombre Desc</option></a>
        <option value="">Zonas</option>
        <option value="">Categorías</option>
        <option value="">Estado</option>
        <option value="">Puntuación</option>
        <option value="">Cantidad de reservas</option>
    </select>
</div> -->
    
<div class="textoPrinc tablaR">
    <br><h4> Restaurantes: </h4><br>
    <table>
        <tr>
            <th class="filas-tabla"> Nombre </th>
            <th class="filas-tabla"> Dirección </th>
            <th class="filas-tabla"> Teléfono </th>
            <th class="filas-tabla"> Zona </th>
            <th class="filas-tabla"> Categoría </th>
            <th class="filas-tabla"> Imagen del frente </th>
            <th class="filas-tabla"> Imagen 1 </th>
            <th class="filas-tabla"> Imagen 2 </th>
            <th class="filas-tabla"> Imagen 3 </th>
            <th class="filas-tabla"> Reservas realizadas </th>
            <th class="filas-tabla"> Puntuación </th>
            <th class="filas-tabla"> Estado </th>
            <th> Cambiar estado </th>
            <th>  </th>
            <th>  </th>
        </tr>

        <?php

        if(isset($_POST['buscarRest'])){        //SI SE REALIZA UNA BÚSQUEDA DE RESTAURANTES
            $buscarRest = $_POST['buscarRest'];
            $sqlBuscar = "SELECT * FROM restaurantes WHERE nombre LIKE '%".$buscarRest."%' OR estado LIKE '%".$buscarRest."%';";
            $queryBuscar = mysqli_query($con, $sqlBuscar);

            while($buscarRestaurantes = mysqli_fetch_array($queryBuscar)){
                $estado=$buscarRestaurantes['estado'];
                $id = $buscarRestaurantes[0];
                $foto_P_1= $buscarRestaurantes[6];
                $foto_P_2= $buscarRestaurantes[4];
                $foto_1_1= $buscarRestaurantes[8];
                $foto_1_2= $buscarRestaurantes[7];
                $foto_2_1= $buscarRestaurantes[10];
                $foto_2_2= $buscarRestaurantes[9];
                $foto_3_1= $buscarRestaurantes[12];
                $foto_3_2= $buscarRestaurantes[11];
                ?>
                <tr>
                    <td><?php echo $buscarRestaurantes['nombre'] ?></td>
                    <td><?php echo $buscarRestaurantes['direccion'] ?></td>
                    <td><?php echo $buscarRestaurantes['tel'] ?></td>
                    <?php  
                    $sqlZona = "SELECT * FROM zonas WHERE id='$buscarRestaurantes[14]';";
                    $recordZona = mysqli_query($con, $sqlZona);
                    $zona=mysqli_fetch_array($recordZona);
                    ?>
                    <td><?php echo $zona[1] ?></td>
                    <?php
                    $sqlCat = "SELECT * FROM categorias WHERE id='$buscarRestaurantes[15]';";
                    $recordCat = mysqli_query($con, $sqlCat);
                    $Cat=mysqli_fetch_array($recordCat);
                    ?>
                    <td><?php echo $Cat[1] ?></td>
                    <!-- FOTO PRINCIPAL -->
                    <td><button type="button" data-toggle="modal" data-target="#foto_Princ<?= $id; ?>">
                        <img width="200" height="100" class="card-img-top" src="data:<?php echo $foto_P_1; ?>
                        ;base64,<?php echo base64_encode($foto_P_2);?>">
                        </button>
                    </td> 
                    <!-- FOTO 1 -->
                    <td><button type="button" data-toggle="modal" data-target="#foto_1<?= $id; ?>">
                        <img width="200" height="100" class="card-img-top" src="data:<?php echo $foto_1_1; ?>
                        ;base64,<?php echo base64_encode($foto_1_2);?>">
                        </button>
                    </td>
                    <!-- FOTO 2 -->
                    <td><button type="button" data-toggle="modal" data-target="#foto_2<?= $id; ?>">
                        <img width="200" height="100" class="card-img-top" src="data:<?php echo $foto_2_1; ?>
                        ;base64,<?php echo base64_encode($foto_2_2);?>">
                        </button>
                    </td>
                    <!-- FOTO 3 -->
                    <td><button type="button" data-toggle="modal" data-target="#foto_3<?= $id; ?>">
                        <img width="200" height="100" class="card-img-top" src="data:<?php echo $foto_3_1; ?>
                        ;base64,<?php echo base64_encode($foto_3_2);?>">
                        </button>
                    </td>
                    <?php
                    // CANTIDAD DE RESERVAS
                    $sqlCantReservas = "SELECT * FROM disponibilidad WHERE res_id= '$buscarRestaurantes[id]' AND estado=TRUE;";
                    $recordCantReservas = mysqli_query($con, $sqlCantReservas);
                    $cantidadReservas= mysqli_num_rows($recordCantReservas);
                    ?>
                    <td><?php echo $cantidadReservas ?></td>
                    <?php   //PROMEDIO
                    $sqlProm = "SELECT AVG(punt_valor) from calificaciones WHERE rest_id=$id;";
                    $resultProm = mysqli_query($con, $sqlProm);
                    $verProm=mysqli_fetch_array($resultProm);
                    $promedio=$verProm[0]; ?>
                    <td> <?php echo number_format($promedio, 1)?> <span class="estrella-color">&#9733 </span> </td>
                    <?php
                    if($estado!=0){ ?>
                        <td bgcolor="green"> Activo </td>                    
                    <?php
                    }else{ ?>
                        <td bgcolor="red"> Deshabilitado </td>
                    <?php
                    }       // BOTON DESACTIVAR/ACTIVAR
                    if($estado!=0){?>       
                        <form action="cambiarEstadoRes.php" method="POST">
                            <input type=hidden name="idRest" value=<?php echo $id ?>>
                            <td><input type="submit" class="btn btn-danger" value="Desactivar"> </td>
                        </form>
                    <?php
                    }else{ ?>
                        <form action="cambiarEstadoRes.php" method="POST">
                            <input type=hidden name="idResto" value=<?php echo $id ?>>
                            <td><input type="submit" class="btn btn-success" value="Activar"> </td>
                        </form> <?php
                    }           // BOTON EDITAR
                    ?>      
                    <form action="editarRest.php" method="POST">
                    <input type=hidden name="idResto" value=<?php echo $id ?>>
                    <td><input type="submit" class="btn btn-outline-info" value="Editar"> </td>
                    </form>
                        <!-- BOTON ELIMINAR -->
                    <!-- <form action="pBorrarR.php" method="POST"> -->
                    <!-- <input type=hidden name="idResto" value=<?php echo $id ?>> -->
                    <td><button type="button" data-toggle="modal" data-target="#borrar_R<?= $id; ?>" style="background-color:black; border:none; font-size:2rem"><i class="bi bi-trash" style="color:#b10909" ></i></button> </td>
                    <!-- </form> -->
                    

                </tr>
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

                                    <!-- MODAL ELIMINAR -->
                <div class="modal fade" id="borrar_R<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="color:black" class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 style="color: black">Va a eliminar el restaurante <?php echo $buscarRestaurantes[1] ?>. ¿Desea continuar?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <form method="POST" action="borrarR.php">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="submit" class="btn btn-success" value="Eliminar"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{          // SIN REALIZARSE BÚSQUEDA DE RESTAURANTES
                $sqlRestaurantes = "SELECT * FROM restaurantes;";
                $recordSet = mysqli_query($con, $sqlRestaurantes);
                while($listaRestaurantes = mysqli_fetch_array($recordSet)){
                $estado=$listaRestaurantes['estado'];
                $id = $listaRestaurantes[0];
                $nombre = $listaRestaurantes[1];
                $fotoP_1= $listaRestaurantes[6];
                $fotoP_2= $listaRestaurantes[4];
                $foto1_1= $listaRestaurantes[8];
                $foto1_2= $listaRestaurantes[7];
                $foto2_1= $listaRestaurantes[10];
                $foto2_2= $listaRestaurantes[9];
                $foto3_1= $listaRestaurantes[12];
                $foto3_2= $listaRestaurantes[11];

                ?>
                <tr>
                    <td><?php echo $listaRestaurantes['nombre'] ?></td>
                    <td><?php echo $listaRestaurantes['direccion'] ?></td>
                    <td><?php echo $listaRestaurantes['tel'] ?></td>
                    <?php
                    
                    $sqlZona = "SELECT * FROM zonas WHERE id='$listaRestaurantes[14]';";
                    $recordZona = mysqli_query($con, $sqlZona);
                    $zona=mysqli_fetch_array($recordZona);
                    ?>
                    <td><?php echo $zona[1] ?></td>
                    <?php
                    $sqlCat = "SELECT * FROM categorias WHERE id='$listaRestaurantes[15]';";
                    $recordCat = mysqli_query($con, $sqlCat);
                    $Cat=mysqli_fetch_array($recordCat);
                    ?>
                    <td><?php echo $Cat[1] ?></td>
                    <!-- FOTO PRINCIPAL -->
                    <td><button type="button" data-toggle="modal" data-target="#fotoPrinc<?= $id; ?>">
                        <img class="card-img-top imgListaR" src="data:<?php echo $fotoP_1; ?>
                        ;base64,<?php echo base64_encode($fotoP_2);?>">
                        </button>
                    </td> 
                    <!-- FOTO 1 -->
                    <td><button type="button" data-toggle="modal" data-target="#foto1<?= $id; ?>">
                        <img class="card-img-top imgListaR" src="data:<?php echo $foto1_1; ?>
                        ;base64,<?php echo base64_encode($foto1_2);?>">
                        </button>
                    </td>
                    <!-- FOTO 2 -->
                    <td><button type="button" data-toggle="modal" data-target="#foto2<?= $id; ?>">
                        <img class="card-img-top imgListaR" src="data:<?php echo $foto2_1; ?>
                        ;base64,<?php echo base64_encode($foto2_2);?>">
                        </button>
                    </td>
                    <!-- FOTO 3 -->
                    <td><button type="button" data-toggle="modal" data-target="#foto3<?= $id; ?>">
                        <img class="card-img-top imgListaR" src="data:<?php echo $foto3_1; ?>
                        ;base64,<?php echo base64_encode($foto3_2);?>">
                        </button>
                    </td>
                    <?php //CANTIDAD DE RESERVAS
                    $sqlCantReservas = "SELECT * FROM disponibilidad WHERE res_id= '$listaRestaurantes[id]' AND estado=TRUE;";
                    $recordCantReservas = mysqli_query($con, $sqlCantReservas);
                    $listaRestaurantes = mysqli_fetch_array($recordCantReservas);
                    $cantidadReservas= mysqli_num_rows($recordCantReservas);
                    ?>
                    <td><?php echo $cantidadReservas ?></td>
                    <?php   //PROMEDIO
                    $sqlProm = "SELECT AVG(punt_valor) from calificaciones WHERE rest_id=$id;";
                    $resultProm = mysqli_query($con, $sqlProm);
                    $verProm=mysqli_fetch_array($resultProm);
                    $promedio=$verProm[0]; ?>
                    <td> <?php echo number_format($promedio, 1)?> <span class="estrella-color">&#9733 </span> </td>
                    <?php
                    if($estado!=0){ ?>
                        <td bgcolor="green"> Activo </td>                    
                    <?php
                    }else{ ?>
                        <td bgcolor="red"> Desactivado </td>
                    <?php
                    }
                    // BOTON ACTIVAR/DESACTIVAR
                    if($estado!=0){?>
                        <form action="cambiarEstadoRes.php" method="POST">
                            <input type=hidden name="idRest" value=<?php echo $id ?>>
                            <td><input type="submit" class="btn btn-danger" style="padding:5px" value="Desactivar"> </td>
                        </form>
                    <?php
                    }else{ ?>
                        <form action="cambiarEstadoRes.php" method="POST">
                            <input type=hidden name="idResto" value=<?php echo $id ?>>
                            <td><input type="submit" class="btn btn-success" value="Activar"> </td>
                        </form> <?php
                    }
                    ?>
                    <!-- EDITAR -->
                    <form action="editarRest.php" method="POST">
                    <input type=hidden name="idResto" value=<?php echo $id ?>>
                    <td><input type="submit" class="btn btn-outline-info" value="Editar"> </td>
                    </form>
                        <!-- ELIMINAR -->
                    <td><button type="button" data-toggle="modal" data-target="#borrarR<?= $id; ?>" style="background-color:black; border:none; font-size:2rem"><i class="bi bi-trash" style="color:#b10909" ></i></button> </td>

                    

                </tr>
                                                        <!-- MODAL FOTO PRINCIPAL -->
                <div class="modal fade" id="fotoPrinc<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img width="450" height="350" class="img-rounded" src="data:<?php echo $fotoP_1; ?>;base64,<?php echo base64_encode($fotoP_2);?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                                                                        <!-- MODAL FOTO 1 -->
                <div class="modal fade" id="foto1<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img width="450" height="350" class="img-rounded" src="data:<?php echo $foto1_1; ?>;base64,<?php echo base64_encode($foto1_2);?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                                                                        <!-- MODAL FOTO 2 -->
                <div class="modal fade" id="foto2<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img width="450" height="350" class="img-rounded" src="data:<?php echo $foto2_1; ?>;base64,<?php echo base64_encode($foto2_2);?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                                                                        <!-- MODAL FOTO 3 -->
                <div class="modal fade" id="foto3<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img width="450" height="350" class="img-rounded" src="data:<?php echo $foto3_1; ?>;base64,<?php echo base64_encode($foto3_2);?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                                <!-- MODAL ELIMINAR -->
                <div class="modal fade" id="borrarR<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="color:black" id="exampleModalLabel">Advertencia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 style="color:black">Va a eliminar de manera definitiva el restaurante <?php echo $nombre ?>. ¿Desea continuar?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <form method="POST" action="borrarR.php">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="submit" class="btn btn-success" value="Eliminar"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <?php
            } ?>

            <?php
        } ?>
    </table>
</div>











<?php
require "./layout/footer.php";
?>


</body>

</html>