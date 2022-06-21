<?php

require "conexion.php";

$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");



$fechaInicial="2022/06/21";	//datos de tipo string
$fechaFinal="2022/07/03";	//datos de tipo string
$nuevaFechaInicial = DateTime::createFromFormat('Y/m/d', $fechaInicial);	// pasando a date
$nuevaFechaFinal = DateTime::createFromFormat('Y/m/d', $fechaFinal);		//pasando a date
$probando = $nuevaFechaInicial;
$probando = $probando->format('Y/m/d'); // pasando a string de nuevo



echo "La fecha inicial es $fechaInicial<br>";
// echo $nuevaFechaInicial;
echo "<br>Y la fecha final es $fechaFinal<br>";




//fechas
while($nuevaFechaInicial < $nuevaFechaFinal){
	

	$sql_restos = "SELECT * FROM restaurantes";
	$resulsetRestos = mysqli_query($con, $sql_restos);
	$cant_filas = mysqli_num_rows($resulsetRestos);
	$contador= 1;


	//restaurantes
	while($contador <=$cant_filas){

		$row = mysqli_fetch_row($resulsetRestos);
		
		$resto = $row[0];

		$mesa=1;
		$comensales;

		//mesas
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
		        VALUES ($resto, $mesa, '$probando', $comensales, 'false');";
			$resulset = mysqli_query($con, $sql);
	
			$mesa++;
		}

		$contador++;
	}


	echo "La fecha actualizada es $probando<br>";
	$nuevaFechaInicial->add(new DateInterval('P1D'));	//aumentando 1 día
	$probando = $nuevaFechaInicial;
	$probando = $probando->format('Y/m/d');
	echo "la fecha mas reciente colocada amigo mio es: $probando<br>";
}







?>