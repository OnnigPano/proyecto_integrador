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
    <title>Registro | Digital Sotre </title>
  </head>
  <body>
    <div class="container">
        <div class="onlyText-regiter margin-top">
          <h3>CREÁ TU CUENTA Y COMPRA DESDE DONDE ESTES</h3>
          <h4>Necesitamos estos pocos datos para poder registrar tu cuenta</h4>
        </div>
        </div>
        <br>
        <form class="formRegister" action="/.html" method="post" >
          <div class="inputRegister">
            <label for="nameRegister">Nombre</label>
            <input type="text" name="nameRegister" value="">
          </div>
          <div class="inputRegister">
            <label for="surnameRegister">Apellido</label>
            <input type="text" name="surnameRegister" value="">
          </div>
          <div class="inputRegister">
            <label for="userName">Usuario</label>
            <input type="text" name="userName" value="">
          </div>
          <div class="inputRegister">
            <label for="emailUser">Correo electrónico</label>
            <input type="email" name="emailUser" value="">
          </div>
          <div class="inputRegister">
            <label for="userPassword">Contraseña</label>
            <input type="password" name="userPassword" value="">
          </div>
          <div class="inputRegister">
            <label for="avatarRegister">Imagen</label>
            <input type="file" name="avatarRegister" value="">
          </div>
          <div class="buttonRegister">
              <button class="buttonLogin" type="submit" name="buttonRegister">CREAR CUENTA</button>
          </div>
        </form>
      </div>
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
