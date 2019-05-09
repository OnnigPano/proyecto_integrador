<?php

  $title= 'Registrate! - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');
  require_once('register-controller.php');

$errorsInRegister = [];


//Variables persistencia

$nameRegister = '';
$surnameRegister = '';
$nicknameRegister = '';
$emailRegister = '';



//PERSISTENCIA DEL FORMULARIO
  if ($_POST) {

    $nameRegister= isset($_POST["nameRegister"]) ? trim($_POST["nameRegister"]) : " " ;
    $surnameRegister= isset($_POST["surnameRegister"]) ? trim($_POST["surnameRegister"]) : " " ;
    $nicknameRegister= isset($_POST["nicknameRegister"]) ? trim($_POST["nicknameRegister"]) : " " ;
    $nicknameRegister= isset($_POST["emailRegister"]) ? trim($_POST["emailRegister"]) : " " ;
    

    $errorsInRegister = registerValidate();

    if (!$errorsInRegister) {
      $imgName = saveImg();
      $_POST['avatar'] = $imgName;


      $thisUser = saveUser();
    }
    //myDeBug($errorsInRegister);
      //FALTA LOGGEARLO.
     }




?>

    <section class="main-container-form">
        <div class="message-register">
          <h3>CREÁ TU CUENTA Y COMPRA DESDE DONDE ESTES.</h3>
          <h4>Necesitamos estos pocos datos para poder registrar tu cuenta:</h4>
        </div>

        <br>
        <form class="formRegister"  method="post" enctype="multipart/form-data">

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
            <input type="text" name="nicknameRegister" value="">
          </div>

          <div class="boxRegistry">
            <label for="">Correo electrónico</label>
            <input type="email" name="emailRegister" value="">
          </div>

          <div class="boxRegistry">
            <label for="">Contraseña</label>
            <input type="password" name="passwordRegister" value="">
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
