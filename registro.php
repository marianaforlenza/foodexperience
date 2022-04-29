



<?php




require "conexion.php";

$email=$_POST['email'];
$nombre=$_POST['nombre'];
$contra=$_POST['contra'];
$contra2=$_POST['contra2'];
$tel=$_POST['tel'];

echo $email;

$con = mysqli_connect($servidorBD, $usuarioBD, $contraBD, $baseDatosBD) or die ("no se pudo conectar a la Base de datos");

$sql= "INSERT into usuarios (usu_nombre,usu_apellido,usu_email,usu_contra,usu_cel)
values ('$nombre','$apellido','$email','$contra','$tel');";


//hacer un  if para compaar contra 1 y contra 2

$resulset= mysqli_query($con,$sql);

if (mysqli_affected_rows ($con)>0){

?>

 <h1>El usuario <?php echo $mail ?> se cargó correctamente </h1>  
   
    
<?php    
}
else{
   
   ?>

<h1>El usuario <?php echo $mail ?> no se pudo cargar </h1>
   
    
<?php 
}

?>
