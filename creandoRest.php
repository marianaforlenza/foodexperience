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


$nomR=$_POST['nomR'];
$dirR=$_POST['dirR'];
$telR=$_POST['telR'];
// $fotoPrincipal=$_POST['fotoPrincipal'];
// $foto1=$_POST['foto1'];
// $foto2=$_POST['foto2'];
// $foto3=$_POST['foto3'];
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
    // fotoPrincipal
        $tipoArchivo=$_FILES['fotoPrincipal']['type'];
        $nombreArchivo=$_FILES['fotoPrincipal']['name'];
        $tamanoArchivo=$_FILES['fotoPrincipal']['size'];
        $imagenSubida=fopen($_FILES['fotoPrincipal']['tmp_name'], 'r');
        $binariosImagen=fread($imagenSubida, $tamanoArchivo);
        $binariosImagen=mysqli_escape_string($con, $binariosImagen);
    // FOTO1
        $tipoArchivo1=$_FILES['foto1']['type'];
        $nombreArchivo1=$_FILES['foto1']['name'];
        $tamanoArchivo1=$_FILES['foto1']['size'];
        $imagenSubida1=fopen($_FILES['foto1']['tmp_name'], 'r');
        $binariosImagen1=fread($imagenSubida1, $tamanoArchivo1);
        $binariosImagen1=mysqli_escape_string($con, $binariosImagen1);
    //FOTO2
        $tipoArchivo2=$_FILES['foto2']['type'];
        $nombreArchivo2=$_FILES['foto2']['name'];
        $tamanoArchivo2=$_FILES['foto2']['size'];
        $imagenSubida2=fopen($_FILES['foto2']['tmp_name'], 'r');
        $binariosImagen2=fread($imagenSubida2, $tamanoArchivo2);
        $binariosImagen2=mysqli_escape_string($con, $binariosImagen2);
    //FOTO3
        $tipoArchivo3=$_FILES['foto3']['type'];
        $nombreArchivo3=$_FILES['foto3']['name'];
        $tamanoArchivo3=$_FILES['foto3']['size'];
        $imagenSubida3=fopen($_FILES['foto3']['tmp_name'], 'r');
        $binariosImagen3=fread($imagenSubida3, $tamanoArchivo3);
        $binariosImagen3=mysqli_escape_string($con, $binariosImagen3);

    $sqlSubir="INSERT INTO restaurantes (nombre, direccion, tel, imagenPrincipal, nombreImagen, tipoImagen,
                imagen1, tipoImagen1, imagen2, tipoImagen2, imagen3, tipoImagen3, estado, zon_id, cat_id)
                VALUES ('$nomR', '$dirR', '$telR', '$binariosImagen', '$nombreArchivo', '$tipoArchivo', '$binariosImagen1',
                '$tipoArchivo1', '$binariosImagen2', '$tipoArchivo2', '$binariosImagen3', '$tipoArchivo3', true, $zonaR, $catR);";
    $resultSubir= mysqli_query($con, $sqlSubir);


    if($resultSubir){
        // fecha actual
        $fechaInicial = date('Y-m-d');
        // Última fecha agregada a la BD
        $traerFechaMax = "SELECT * FROM disponibilidad WHERE fecha = (SELECT MAX(fecha) FROM disponibilidad);";
        $resultFechaMax= mysqli_query($con, $traerFechaMax);
        $datos = mysqli_fetch_array($resultFechaMax);
        $fechaFinal = $datos['fecha'];
        $nuevaFechaInicial = DateTime::createFromFormat('Y-m-d', $fechaInicial);	// pasando a date
        $nuevaFechaFinal = DateTime::createFromFormat('Y-m-d', $fechaFinal);		//pasando a date
        $probando = $nuevaFechaInicial;
        $probando = $probando->format('Y-m-d'); // pasando a string de nuevo
        while($nuevaFechaInicial <= $nuevaFechaFinal){
    
            $conn = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");
            $comprobarFecha = "SELECT * FROM disponibilidad WHERE fecha= '$probando';";
            $resultComprobarFecha = mysqli_query($conn, $comprobarFecha);
                $connec = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");
                $sql_restos = "SELECT * FROM restaurantes WHERE id= (SELECT MAX(id) FROM restaurantes);";
                $resulsetRestos = mysqli_query($connec, $sql_restos);
                $row = mysqli_fetch_row($resulsetRestos);
                $resto= $row[0];
                $mesa = 1;
                $comensales;
                    while($mesa <6){
                        //cantidad de comensales
                        switch($mesa){
                            case 1:
                                $comensales= 2;
                                break;
                            case 2:
                                $comensales= 2;
                                break;
                            case 3:
                                $comensales= 4;
                                break;
                            case 4:
                                $comensales= 6;
                                break;
                            case 5:
                                $comensales= 8;
                                break;
                            default:
                                echo "La mesa $mesa es inexistente";
                                break;
                        }
                        $sql = "INSERT INTO disponibilidad (res_id, idMesa, fecha, cant_comensales, estado)
                            VALUES ($resto, $mesa, '$probando', $comensales, false);";
                        $resulset = mysqli_query($con, $sql);
                        $mesa++;
                    }

            $nuevaFechaInicial->add(new DateInterval('P1D'));	//aumentando 1 día
            $probando = $nuevaFechaInicial;
            $probando = $probando->format('Y-m-d');
        }
        ?>
        <p class="textoPrinc m-5"> Se ha agregado el nuevo restaurante y ya está listo para reservar.</p>
        <?php
    }else{
        echo "<p class='mt-5'>Ha fallado la creación del nuevo restaurante. Intente nuevamente.<p>";
    }



?>










<?php
require "./layout/footer.php";
?>


</body>
</html>