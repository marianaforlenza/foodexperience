<div class="contenedor">
  <!-- HEADER -->
  <header>
    <!-- Parte Izquierda - logo -->
    <div class="headerI logoImg">
      <a href="index.php">
        <img class="logoImg" src="./imagenes/logo.png">
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
                  <!-- mis reservas -->
                <a class="dropdown-item" href="misReservas.php"> <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                  src="https://cdn.lordicon.com/qtqvorle.json"
                  trigger="hover"
                  style="width:35px;height:35px">
                </lord-icon> Mis Reservas</a>
                <!-- mis opiniones -->
                <a class="dropdown-item" href="misOpiniones.php"><script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                  src="https://cdn.lordicon.com/snnvmbic.json"
                  trigger="morph"
                  style="width:35px;height:35px">
                </lord-icon> Mis Opiniones</a>
                <div class="dropdown-divider"></div>
                <!-- lista reservas -->
                <a class="dropdown-item" href="listaReservas.php"><script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                  src="https://cdn.lordicon.com/pqxdilfs.json"
                  trigger="hover"
                  style="width:35px;height:35px">
                </lord-icon> Lista Reservas</a>
                <!-- usuarios -->
                <a class="dropdown-item" href="usuarios.php"><script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                  src="https://cdn.lordicon.com/dqxvvqzi.json"
                  trigger="morph"
                  colors="outline:#121331,primary:#f4dc9c,secondary:#4bb3fd"
                  state="morph-group"
                  style="width:35px;height:35px">
                </lord-icon> Usuarios</a>
                <!-- restaurantes -->
                <a class="dropdown-item" href="listaRestaurantes.php"><script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                  src="https://cdn.lordicon.com/zkazkzgr.json"
                  trigger="hover"
                  style="width:35px;height:35px">
                </lord-icon> Restaurantes</a>
                <!-- agregar fechas -->
                <a class="dropdown-item" href="diasCalendario.php"><script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                  src="https://cdn.lordicon.com/osvvqecf.json"
                  trigger="hover"
                  colors="outline:#121331,primary:#f24c00,secondary:#ebe6ef,tertiary:#4bb3fd"
                  state="hover-1"
                  style="width:35px;height:35px">
                </lord-icon> Agregar fechas</a>              
                <div class="dropdown-divider"></div>
                <!-- cerrar sesion -->
                <a class="dropdown-item" href="index.php?logout"><script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/twopqjaj.json"
                    trigger="hover"
                    style="width:35px;height:35px">
                </lord-icon> Cerrar Sesión</a>
              </div>
            <?php
            }else{  //USUARIO COMÚN
            ?>
            <!-- <div class="mr-5"> -->
              <div class="dropdown-menu mr-4" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="misReservas.php"> <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                  src="https://cdn.lordicon.com/qtqvorle.json"
                  trigger="hover"
                  style="width:35px;height:35px">
                </lord-icon> Mis Reservas</a>
                <a class="dropdown-item" href="misOpiniones.php"><script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                  src="https://cdn.lordicon.com/snnvmbic.json"
                  trigger="morph"
                  style="width:35px;height:35px">
                </lord-icon> Mis Opiniones</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php?logout"><script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/twopqjaj.json"
                    trigger="hover"
                    style="width:35px;height:35px">
                </lord-icon> Cerrar Sesión</a>
              </div>
            <!-- </div> -->
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










