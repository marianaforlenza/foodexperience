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
    <link rel="stylesheet" href="cssGrid.css">
    
</head>

<body>

<?php
require "./layout/header.php";
?>
    
    <!-- registro -->
    <form class="was-validated formu-registro mb-5" action="registro.php" method="post" id="miformulario" onsubmit="verificarPasswords(); return false">
    <div class="login-wrap">               
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
                        <input id="pass1" type="password" class="input form-control is-invalid" aria-describedby="validatedInputGroupPrepend" minlength="4" maxlength="45" title="La contraseña debe tener entre 4 y 45 caracteres" required data-type="password"name="contra">
                    </div>
                    <div class="group input-group is-invalid">
                        <label for="pass" class="label">Repeti Contraseña</label>
                        <input id="pass2" type="password" class="input form-control is-invalid" aria-describedby="validatedInputGroupPrepend" minlength="4" maxlength="45" title="La contraseña debe tener entre 4 y 45 caracteres" required data-type="password" name="contra2">
                    </div>
                    <div class="group input-group is-invalid">
                        <label for="pass" class="label">Telefono</label>
                        <input id="pass" type="text" class="input form-control is-invalid" aria-describedby="validatedInputGroupPrepend" pattern="[0-9]{6,15}"  title="Solo números. Tamaño mínimo: 6, máximo: 15" required name="tel">
                    </div>
                    <div class="group input-group is-invalid">
                        <input type="submit" class="button" value="Registrarse" onClick="comprobarClave()">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

<script>
function verificarPasswords() {
 
    // Obtenemos los valores de los campos de contraseñas 
    pass1 = document.getElementById('pass1');
    pass2 = document.getElementById('pass2');
 
    // Verificamos si las constraseñas no coinciden 
    if (pass1.value != pass2.value) {
 
        // Si las constraseñas no coinciden mostramos un mensaje 
        alert ("Las contraseñas no coinciden");  

        return false;
    } else {

        // Si las contraseñas coinciden ocultamos el mensaje de error


        // Mostramos un mensaje mencionando que las Contraseñas coinciden 


      document.getElementById("login").disabled = true;
        // Deshabilitamos el botón de login 
       // document.body.innerHTML = '<meta http-equiv="Refresh" content="2; url=registro.php">'


         setTimeout(function() {
    location.reload();
    }, 3000);
        
        return true;
    }
 
}
</script>



<?php
require "./layout/footer.php";
?>

</body>
</html>