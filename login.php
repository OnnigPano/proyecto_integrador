<?php

  $title = 'Iniciar Sesión - DS';
  require_once './partials/head.php';
  require_once './partials/header.php';
  require_once('conexion.php');

  require_once('autoload.php');


  if ( LoginValidator::isLogged() ) {
    header('location: profile.php');
    exit;
  }

  $loginValidator = new LoginValidator();

  if ($_POST) {
    
    $loginValidator->isValid();
    
    $errorsInLogin = $loginValidator->getAllErrors();

  

    if (!$errorsInLogin) {

        if ($loginValidator->isMailOrIsNickname($loginValidator->getUserField()) == 'isMail'){
            $userToLogin = DB::getUserByEmail($email);
        }else{
            $userToLogin = DB::getUserByUsername($email);
        }



      if ( isset($_POST["rememberUser"]) ) {
        setcookie("userLoged", $userToLogin['email'],time() + 3000);
      }

      LoginValidator::login($userToLogin);
    }
  }


?>

      <section class="main-container-form">
        <h2>¿TENÉS UNA CUENTA?</h2>
        <form class="container-form" method="post">

          <div class="email">
            <input
            type="text"
            name="email"
            class="form-control <?= isset( $errorsInLogin['login'] ) ? "is-invalid" : null ?> "
            value="<?= $loginValidator->getUserField() ?>"
            placeholder="Correo electrónico o Usuario"
            required>
          </div>

          <div class="password">
            <input
            type="password"
            name="password"
            class="form-control <?= isset( $errorsInLogin['login'] ) ? "is-invalid" : null ?> "
            placeholder= "Contraseña"
            required>

            <div class="invalid-feedback">
            <span>  <?= isset( $errorsInLogin['login'] ) ? $errorsInLogin['login'] : null ?> </span>
            </div>
          </div>


          <div class="chkRemember">
            <label class="labelLogin" for="">Recordarme</label>
              <input  class="chkInputRemember" type="checkbox" name="rememberUser">
          </div>

          <div class="">
            <button class="button-form" type="submit" name="buttonLogin">Iniciar sesión</button>
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
