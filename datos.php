<?php

require "conexion.php";

$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");

$fechaInicial=$_POST['fechaInicial'];	//datos de tipo string
$fechaFinal=$_POST['fechaFinal'];	//datos de tipo string
$nuevaFechaInicial = DateTime::createFromFormat('Y-m-d', $fechaInicial);	// pasando a date
$nuevaFechaFinal = DateTime::createFromFormat('Y-m-d', $fechaFinal);		//pasando a date
$probando = $nuevaFechaInicial;
$probando = $probando->format('Y-m-d'); // pasando a string de nuevo



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

	<div class="derecha mt-3 boton-volver">
        <a href="index.php">
          <p>Volver <i class="bi bi-house-fill" style="font-size:2rem; color: rgb(78, 76, 196)"></i></p>
            
        </a>
	</div>



	<?php

	echo "<br>La fecha inicial elegida es $fechaInicial<br>";

	echo "<br>Y la fecha final elegida es $fechaFinal<br><br>";



	//fechas
	if ($nuevaFechaInicial <= $nuevaFechaFinal){
		while($nuevaFechaInicial <= $nuevaFechaFinal){

			$conn = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");
			$comprobarFecha = "SELECT * FROM disponibilidad WHERE fecha= '$probando';";
			$resultComprobarFecha = mysqli_query($conn, $comprobarFecha);
			if (mysqli_affected_rows($conn)>0){
				echo "la fecha $probando ya está registrada en el sistema.<br>";
			}else{

				$sql_restos = "SELECT * FROM restaurantes";
				$resulsetRestos = mysqli_query($con, $sql_restos);
				$cant_restos = mysqli_num_rows($resulsetRestos);
				$contador= 1;
				//restaurantes
				while($contador <=$cant_restos){
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
							VALUES ($resto, $mesa, '$probando', $comensales, false);";
						$resulset = mysqli_query($con, $sql);
						$mesa++;
					}
					$contador++;
				}

				echo "Se agregó la fecha $probando. <br>";
			}

			$nuevaFechaInicial->add(new DateInterval('P1D'));	//aumentando 1 día
			$probando = $nuevaFechaInicial;
			$probando = $probando->format('Y-m-d');
		}

	}else{
		echo "La fecha inicial debe ser mayor o igual a la fecha final.";
	} ?>



</body>


</html>



