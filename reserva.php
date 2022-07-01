<?php

require "conexion.php";

$idResto = $_POST['idRestRes'];
$fecha=$_POST['fechaReserva'];
$mesa=$_POST['idMesaRes'];

$con=mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");

$sqlReservar = "UPDATE disponibilidad SET estado = true
                WHERE fecha = '$fecha' and res_id = $idResto and idMesa = $mesa;";

$resultado = mysqli_query($con, $sqlReservar);

if(mysqli_affected_rows($con)>0){
    echo "La reserva ha sido realizada";
}else{
    echo "No se ha podido llevar a cabo la reserva";
}

?>