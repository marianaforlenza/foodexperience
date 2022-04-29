<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    
    <form action="registro.php" method="post">
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registrarse</label>
            <div class="login-form">
               
                <div class="sign-up-htm">
                    <div class="group">
                        <label for="user" class="label">Email</label>
                        <input id="user" type="text" class="input" name="email">
                    </div>
                    <div class="group">
                        <label for="user" class="label">Nombre</label>
                        <input id="user" type="text" class="input" name="nombre">
                    </div>
                    <div class="group">
                        <label for="user" class="label">Apellido</label>
                        <input id="user" type="text" class="input" name="apellido">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Contraseña</label>
                        <input id="pass" type="password" class="input" data-type="password"name="contra">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeti Contraseña</label>
                        <input id="pass" type="password" class="input" data-type="password" name="contra2">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Telefono</label>
                        <input id="pass" type="number" class="input" name="tel">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Registrarse">
                    </div>
                
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Olvidaste tu contraseña?</a> </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
