<?php

  $title = 'Iniciar Sesión - DS';
  require_once './partials/head.php';
  require_once './partials/header.php';
  require_once('autoload.php');


  if ( LoginValidator::isLogged() ) {
    header('location: profile.php');
    exit;
  }
  //Instanciamos el Validador del Login
  $loginValidator = new LoginValidator();

  if ($_POST) {
    //Almacenamos el campo de usuario o mail.
    $userField = $loginValidator->getUserField();
    //Seteamos los errores si existen
    $loginValidator->isValid();
    //Almacenamos los errores si existen
    $errorsInLogin = $loginValidator->getAllErrors();
  

    if (!$errorsInLogin) {
        //Validamos si se quiere logear por mail o nickname
        if ($loginValidator->isMailOrIsNickname($userField) == 'isMail'){
            $userToLogin = DB::getUserByEmail($userField);
        }else{
            $userToLogin = DB::getUserByUsername($userField);
        }
        //Si quiere mantener la session, generamos una cookie
        if ( isset($_POST["rememberUser"]) ) {
          setcookie("userLoged", $userToLogin['email'],time() + 3000);
        }
        //Logeamos al usuario que ingresa al sitio.
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
