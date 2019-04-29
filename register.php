<?php

  $title= 'Registrate! - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');

?>

    <div class="container">
        <div class="onlyText-register margin-top">
          <h3>CREÁ TU CUENTA Y COMPRA DESDE DONDE ESTES</h3>
          <h4>Necesitamos estos pocos datos para poder registrar tu cuenta</h4>
        </div>

        <br>
        <form class="formRegister" action="index.php" method="post" style="padding-bottom: 5%">
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

        <?php

          require_once('./partials/footer.php');

        ?>
