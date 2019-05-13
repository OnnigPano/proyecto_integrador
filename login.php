<?php

  $title = 'Iniciar Sesión - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');
  require_once'register-controller.php';

  if (isLoged()) {
    header('location: index.php');
    exit;
  }

?>

      <section class="main-container-form">
        <h2>¿TENES UNA CUENTA?</h2>
        <form class="container-form" action="profile.php" method="post">

          <div class="email">
            <input type="text" name="email" value="" placeholder="Correo electrónico" required>
          </div>

          <div class="password">
            <input type="password" name="password" value="" placeholder= "Contraseña" required>
          </div>

          <div class="">
            <button class="button-form" type="submit" name="buttonLogin">Inicia sesión</button>
          </div>

          <a class="forgot-password" href="##">¿Has olvidado tu contraseña? </a>

          <br>

          <span class="join-formLogin" >
           ¿Todavía no eres miembro?
            <a href="register.php">¡Únete ahora! </a>
          </span>
        </form>
      </section>
    <?php

      require_once('./partials/footer.php');

    ?>
