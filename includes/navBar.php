 <!-- Navigation -->
 <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="./index.php">hola <?php echo $_SESSION['usuario']?></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Clientes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="./nuevo.php">Nuevo</a>
                  <a class="dropdown-item" href="./buscarM.php">Modificar</a>
                  <a class="dropdown-item" href="./buscarE.php">Eliminar</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="./read.php">Listado de clientes</a>
                </div>
              </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#team">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="logout.php">Cerrar Sesion</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>    