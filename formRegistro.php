<?php

session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Experience - Registrarse</title>

    <!-- css bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<!-- header -->
<header >
    <!-- logo izq -->
    <div class="logo">
      <a href="index.php">
        <img src="./imagenes/logo.png">
      </a>
    </div>
    <!-- título central -->
    <div class="titulo">
        <h1 class="centrar">Food Experience</h1>
    </div>
    <!-- loggin -->
    <div class="loguearse">
      <div>
        <form class="derecha" action="buscarUsu.php" method="post">
        <input type="text" class="tamanio-form" name="mail" placeholder="Ingrese su mail" required>
        <input type="password" class="tamanio-form" name="contra" placeholder="Ingrese su Contraseña" required>
        <input type="submit" class="btn btn-primary btn-sm" value="Iniciar Sesión">
        </form>
      </div>
      <!-- olvidé mi contraseña -->
      <div class="centrar">
        <div class="olvide-contra ml-5 mb-2">
          <a href=""> Olvidé mi contraseña </a>
        </div>
        <div>   
          <p> </p>
          </form>
        </div>
      </div>
    </div>
</header>

<?php
//si ya inició sesión
if(isset($_SESSION['usu_mail'])){
    $nombreCompleto= $_SESSION['nombre_completo'];
?>
    <h4 class="centrar mt-3">Ya inició sesión</h3>
<?php
    echo '<meta http-equiv="Refresh" content="2; url=index.php">';
}
else{   //si aún no inició sesión
?>

<!-- botón Volver -->
<div class="derecha mt-3">
    <a href="index.php">
        <i class="bi bi-house-fill" style="font-size:2rem; color: rgb(199, 198, 255)"></i>
    </a>
</div>
    
    <!-- registro -->
    <form class="was-validated formu-registro mb-5" action="registro.php" method="post">
    <div class="login-wrap">
        <!-- <div class="login-html">
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registrarse</label>
            <div class="login-form"> -->
               
                <div class="sign-up-htm login-html login-form">

                    <div class="group input-group is-invalid">
                        <label for="user" class="label">Email</label>
                        <input id="user" type="text" class="input form-control is-invalid" aria-describedby="validatedInputGroupPrepend" pattern="[a-z0-9._]+@[a-z0-9.-]+\.[a-z]{2,4}$" maxlength="45" required name="email">
                    </div>
                    <div class="group input-group is-invalid">
                        <label for="user" class="label">Nombre</label>
                        <input id="user" type="text" class="input form-control is-invalid" aria-describedby="validatedInputGroupPrepend" pattern="[a-zA-ZñÑ\s]{2,45}" title="Solo letras sin tilde. Tamaño mínimo: 2, máximo: 45" required name="nombre">
                    </div>
                    <div class="group input-group is-invalid">
                        <label for="user" class="label">Apellido</label>
                        <input id="user" type="text" class="input form-control is-invalid" aria-describedby="validatedInputGroupPrepend" pattern="[a-zA-ZñÑ\s]{2,45}" title="Solo letras sin tilde. Tamaño mínimo: 2, máximo: 45" required name="apellido">
                    </div>
                    <div class="group input-group is-invalid">
                        <label for="pass" class="label">Contraseña</label>
                        <input id="pass" type="password" class="input form-control is-invalid" aria-describedby="validatedInputGroupPrepend" minlength="4" maxlength="45" title="La contraseña debe tener entre 4 y 45 caracteres" required data-type="password"name="contra">
                    </div>
                    <div class="group input-group is-invalid">
                        <label for="pass" class="label">Repeti Contraseña</label>
                        <input id="pass" type="password" class="input form-control is-invalid" aria-describedby="validatedInputGroupPrepend" minlength="4" maxlength="45" title="La contraseña debe tener entre 4 y 45 caracteres" required data-type="password" name="contra2">
                    </div>
                    <div class="group input-group is-invalid">
                        <label for="pass" class="label">Telefono</label>
                        <input id="pass" type="text" class="input form-control is-invalid" aria-describedby="validatedInputGroupPrepend" pattern="[0-9]{6,15}"  title="Solo números. Tamaño mínimo: 6, máximo: 15" required name="tel">
                    </div>
                    <div class="group input-group is-invalid">
                        <input type="submit" class="button" value="Registrarse">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>




<!-- footer -->
<footer>
  <!-- parte izquierda -->
  <div class="item-footer">
    <p> </p>
  </div>
    <!-- parte centro -->
  <div class="item-footer centrar">
    <p> Hecho con <i class="bi bi-suit-heart-fill" style="font-size:0.8rem; color:red"></i>
    <p> por Vale, Maru y Jair<p>
  </div>
  <!-- parte derecha -->
  <div class="item-footer derecha">
    <a href="#">
      <i class="bi bi-github" style="font-size:2rem; color:white"></i>
      </a>
    <a href="">
      <i class="bi bi-whatsapp" style="font-size:2rem; color:green"></i>
    </a>
    <a href="#">
      <i class="bi bi-envelope" style="font-size:2rem; color:black"></i>
    </a>
  </div>

  </footer>

<!-- cierre del Else -->
<?php
}
?>





</body>

</html>