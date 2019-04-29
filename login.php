<?php

  $title = 'Iniciar Sesión - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');

?>

    <div class="container">
      <section class="margin-top">
        <h2>¿TENES UNA CUENTA?</h2>
        <form class="" action="profile.php" method="post">
          <div class="email">
            <input type="text" name="email" value="" placeholder="Correo electrónico" required>
          </div>
          <div class="password">
            <input type="password" name="password" value="" placeholder= "Contraseña" required>
          </div>
          <div class="button">
            <button class="buttonLogin" type="submit" name="buttonLogin">Inicia sesión</button>
          </div>
          <a class="forgot-password" href="##">¿Has olvidado tu contraseña? </a>
          <br>
          <span class="join" style="padding-bottom: 5%">
           ¿Todavía no eres miembro?
            <a href="register.php">¡Únete ahora! </a>
          </span>
        </form>
      </section>

    </div>

    <?php

      require_once('./partials/footer.php');

    ?>
