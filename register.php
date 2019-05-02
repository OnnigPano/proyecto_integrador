<?php

  $title= 'Registrate! - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');

?>

    <section class="main-container-form">
        <div class="message-register">
          <h3>CREÁ TU CUENTA Y COMPRA DESDE DONDE ESTES.</h3>
          <h4>Necesitamos estos pocos datos para poder registrar tu cuenta:</h4>
        </div>

        <br>
        <form class="formRegister" action="index.php" method="post">

          <div class="boxRegistry">
            <label for="">Nombre</label>
            <input type="text" name="nameRegister" value="">
          </div>

          <div class="boxRegistry">
            <label for="">Apellido</label>
            <input type="text" name="surnameRegister" value="">
          </div>

          <div class="boxRegistry">
            <label for="userName">Usuario</label>
            <input type="text" name="userName" value="">
          </div>

          <div class="boxRegistry">
            <label for="">Correo electrónico</label>
            <input type="email" name="emailUser" value="">
          </div>

          <div class="boxRegistry">
            <label for="">Contraseña</label>
            <input type="password" name="userPassword" value="">
          </div>

          <div class="boxRegistry">
            <label for="">Imagen</label>
            <input class="avatarInput" type="file" name="avatarRegister" value="">
          </div>

          <div class="boxRegistry">
              <button class="button-form" type="submit" name="buttonRegister">CREAR CUENTA</button>
          </div>

        </form>
      </section>

        <?php

          require_once('./partials/footer.php');

        ?>
