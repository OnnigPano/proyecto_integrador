<?php

  require_once('autoload.php');
  session_start();

?>


<body>

  <div class="main-container">

    <header class="main-header">

      <nav class="main-navbar container navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand d-lg-none" href="index.php">DIGITAL <span class="orange ">STORE</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Productos</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="profile.php">Mi Cuenta<i class="fas fa-user-alt ml-2"></i></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Carrito<i class="fas fa-shopping-cart ml-1"></i></a>
              <!-- Menú dinámico para usuario registrado -->
              <?php if ( !LoginValidator::isLogged() ): ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="login.php">Iniciar Sesión</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="register.php">Registrarse</a>
                  </li>
              <?php else: ?>
                <li class="nav-item active">
                  <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                </li>
              <?php endif; ?>

          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control m-0 mr-2" type="search" placeholder="Buscar..." aria-label="Buscar">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
          </form>
        </div>
      </nav>

      <div class="logo d-none d-lg-block">
      
        <h1><a href="index.php">DIGITAL <span class="orange">STORE</span></a></h1>
      
      </div>

    </header>
