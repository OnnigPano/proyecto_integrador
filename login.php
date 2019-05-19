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

  if ($_POST) {

    $email = trim($_POST['email']);

    $errorsInLogin = loginValidate();

    if (!$errorsInLogin) {
      $userToLogin = getUserByEmail($email);

      if ( isset($_POST["rememberUser"]) ) {
        setcookie("userLoged",$email,time() + 3000);
      }

      login($userToLogin);
    }
  }


?>

      <section class="main-container-form">
        <h2>¿TENES UNA CUENTA?</h2>
        <form class="container-form" action="profile.php" method="post">

          <div class="email">
            <input
            type="text"
            name="email"
            class="form-control <?= isset( $errorsInLogin['email'] ) ? "is-invalid" : null ?> "
            value="<?= $email; ?>"
            placeholder="Correo electrónico"
            required>
          </div>
          <div class="invalid-feedback">
            <?= isset( $errorsInLogin['email'] ) ? $errorsInLogin['email'] : null ?>
          </div>

          <div class="password">
            <input
            type="password"
            name="password"
            placeholder= "Contraseña"
            required>
          </div>
          <div class="invalid-feedback">
            <?= isset( $errorsInLogin['password'] ) ? $errorsInLogin['password'] : null ?>
          </div>


          <div class="">
            <label for=""><input  type="checkbox" name="rememberUser">
            Recordarme
          </label>

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
