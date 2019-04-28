<?php

  require_once('./partials/head.php');
  require_once('./partials/header.php');

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/app.css">
    <meta charset="utf-8">
    <title>¡Hola! Ingresá con tu email</title>
  </head>
  <body>
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
          <span class="join">
           ¿Todavía no eres miembro?
            <a href="registry.php">¡Únete ahora! </a>
          </span>
        </form>
      </section>

      <footer class="main-footer">
        <nav class="nav-footer">
          <ul>
            <li><a href="#"></a><i class="fas fa-envelope"></i> Contacto</li>
            <li><a href="#"></a><i class="fas fa-question"></i> Preguntas Frecuentes</li>
          </ul>
        </nav>

        <p> &copy; Todos los derechos reservados</p>
      </footer>
    </div>


  </body>
</html>
