<?php

  $title = 'Iniciar Sesión - DS';
  require_once './partials/head.php';
  require_once './partials/header.php';
  require_once 'register-controller.php';


  if ( isLogged() ) {
   header('location: profile.php');
    exit;
  }

  $errorsInLogin= [];

  $email = "";
  $userName = "";

  if ($_POST) {

    $email = trim($_POST['email']);
    //$userName = trim($_POST['nickRegister']);

    $errorsInLogin = loginValidate();

    if (!$errorsInLogin) {

        if (isMailOrIsNickname($email) == 'isMail'){
            $userToLogin = getUserByEmail($email);
        }else{
            $userToLogin = getUserByUsername($email);
        }



      if ( isset($_POST["rememberUser"]) ) {
        setcookie("userLoged",$email,time() + 3000);
      }

      login($userToLogin);
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
            value="<?= $email; ?>"
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
