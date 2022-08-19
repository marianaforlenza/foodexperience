<div class="contenedor">
  <!-- HEADER -->
  <header>
    <!-- Parte Izquierda - logo -->
    <div class="headerI">
      <a href="index.php">
        <img src="./imagenes/logo.png">
      </a>
    </div>
    <!-- Parte central - Título -->
    <div class="headerC titulo">
      <h1 class="titu">Food Experience</h1>
    </div>
    <div class="headerD"> <!-- Parte Derecha -->
      <?php //comprobando si ya inició sesión
      if(isset($_SESSION['usu_mail'])){
        $nombreCompleto= $_SESSION['nombre_completo'];
        $idUsuario = $_SESSION['idUsuario'];
        $rol = $_SESSION['rol'];
        ?>
        <div class="mr-5">
          <div>
            <p>¡Hola <?php echo $nombreCompleto?>!</p>
          </div>
          <!-- barra de opciones de usuario -->
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
              Opciones
            </button>
            <?php //SI SOY ADMINISTRADOR
            if($rol==1){ ?>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="misReservas.php">Mis Reservas</a>
              <a class="dropdown-item" href="misOpiniones.php">Mis Opiniones</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="listaReservas.php">Lista Reservas</a>
              <a class="dropdown-item" href="usuarios.php">Usuarios</a>
              <a class="dropdown-item" href="listaRestaurantes.php">Restaurantes</a>
              <a class="dropdown-item" href="diasCalendario.php">Agregar fechas</a>              
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="index.php?logout">Cerrar Sesión</a>
            </div>
            <?php
            }else{
            ?>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="misReservas.php">Mis Reservas</a>
              <a class="dropdown-item" href="misOpiniones.php">Mis Opiniones</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="index.php?logout">Cerrar Sesión</a>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php
      }else{
        ?>
        <!-- pantalla de login -->
        <div>
          <div>
            <form action="buscarUsu.php" method="post">
              <input type="text" class="tamanio-form" name="mail" placeholder="Ingrese su mail" required>
              <input type="password" class="tamanio-form" name="contra" placeholder="Ingrese su Contraseña" required>
              <input type="submit" class="btn btn-primary btn-sm" value="Iniciar Sesión">
            </form>
          </div>
          <div class="olvide-registro">
            <div class="mr-5">   <!-- olvidé mi contraseña -->
              <a href="recuperarPassword.php"> Olvidé mi contraseña </a>
            </div>
            <div>   <!-- botón Registrarse -->
              <form action="formRegistro.php">
                <input type="submit" class="btn btn-outline-info btn-sm" value="Registrarse">
              </form>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </header>
  <!-- FIN HEADER -->

  <div class="main">










