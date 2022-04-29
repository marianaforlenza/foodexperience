



<?php



require "conexion.php";

$mail=$_POST['mail'];
$contra=$_POST['contra'];

require "conexion.php";


$con=mysqli_connect($servidorBD, $usuarioBD,$contraBD,$baseDatosBD) or die ("no se puede conectar a la base de datos");


$sqlVerifica="select * from usuarios where usu_email='$mail';";

$resulset=mysqli_query($con, $sqlVerifica);

$registro=mysqli_fetch_assoc($resulset);



if(mysqli_affected_rows($con)>0){
    echo "Se encontró el usuario";

    $usu=$registro['usu_email'];
    $contra= $registro['usu_contra'];
    $nomyape= $registro['usu_nombre']." ".$registro['usu_apellido'];
    $id= $registro['usu_id'];
    //verifico pass
    if($registro['usu_contra']==$contra){
        session_start();
        //echo "<br><br><br><h3> Inicia sesión <h3>";
        //cargar variables de sesion
      //  $_SESSION['usu_id']=$id;
        //$_SESSION['usu_mail']=$usu;
        //$_SESSION['usu_nombre']=$nomyape;  
        ?>
    <meta http-equiv="Refresh" content="2; url=index.php">

<?php

    }
    else{
        echo "<br><br><br><h3> La contraseña es incorrecta <h3>";
        echo '<meta http-equiv="Refresh" content="1; url=index.php">';
    }
    
?>


<?php

}
else{
    echo "<br><br><br><h3> No existe el usuario $mail <h3>";
    echo '<meta http-equiv="Refresh" content="1; url=index.php">';
}

?>
