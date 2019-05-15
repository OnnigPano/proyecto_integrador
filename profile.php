<?php

  $title = 'Mi Cuenta - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');
  require_once'partials/banner.php';
  require_once'register-controller.php';
  require_once'edit-profile-controller.php';

  if ( !isLoged() ) {
    header('location: login.php');
    exit;
  }

  $errorsInProfile = [];

  // Array de países para el select

  $countries = [
		'ar' => 'Argentina',
		'bo' => 'Bolivia',
		'br' => 'Brasil',
		'co' => 'Colombia',
		'cl' => 'Chile',
		'ec' => 'Ecuador',
		'pa' => 'Paraguay',
		'pe' => 'Perú',
		'uy' => 'Uruguay',
		've' => 'Venezuela',
	];
  //myDeBug($_SESSION);
  if ($_POST) {

    if ( $_POST['buttonRegister'] == 1 ) {

      $errorsInProfile = profileValidate();

      if (!$errorsInProfile) {

        $thisUser = saveUserEdited();

        setcookie( 'userLoged', $_SESSION['userLoged']['emailRegister'], time() + 3600000 );


        login($thisUser);

      }

    }

  }

?>

  <main>

    <section class="container-form">

        <br>
        <form class="formRegister"  method="post" enctype="multipart/form-data">

          <div class="boxRegistry">
            <label for="">Nombre</label>
            <input
              type="text"
              class="form-control <?= isset( $errorsInProfile['nameRegister'] ) ? "is-invalid" : null ?> "
              name="nameRegister"
              value="<?= $_SESSION['userLoged']['nameRegister'] ?>"
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInProfile['nameRegister'] ) ? $errorsInProfile['nameRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Apellido</label>
            <input
              type="text"
              class="form-control <?= isset( $errorsInProfile['surnameRegister'] ) ? "is-invalid" : null ?> "
              name="surnameRegister"
              value="<?= $_SESSION['userLoged']['surnameRegister'] ?>"
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInProfile['surnameRegister'] ) ? $errorsInProfile['surnameRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="userName">Usuario</label>
            <input
              type="text"
              class="form-control <?= isset( $errorsInProfile['nicknameRegister'] ) ? "is-invalid" : null ?> "
              name="nicknameRegister"
              value="<?= $_SESSION['userLoged']['nicknameRegister'] ?>"
              >
              <div class="invalid-feedback">
                <?= isset( $errorsInProfile['nicknameRegister'] ) ? $errorsInProfile['nicknameRegister'] : null ?>
              </div>
          </div>

          <div class="boxRegistry">
            <label for="">Correo electrónico</label>
            <input
              type="email"
              class="form-control <?= isset( $errorsInProfile['emailRegister'] ) ? "is-invalid" : null ?> "
              name="emailRegister"
              value="<?= $_SESSION['userLoged']['emailRegister'] ?>"
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInProfile['emailRegister'] ) ? $errorsInProfile['emailRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">País</label>
            <select class="custom-select form-control <?= isset( $errorsInProfile['countryRegister'] ) ? "is-invalid" : null ?> " name="countryRegister">
              <option value="">Elegí un país</option>
              <?php foreach ($countries as $code => $country): ?>
                <option
                  value="<?= $code ?>"
                  <?= $code == $_SESSION['userLoged']['countryRegister'] ? 'selected' : null ?>
                > <?= $country ?> </option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
              <?= isset( $errorsInProfile['countryRegister'] ) ? $errorsInProfile['countryRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Cambiar contraseña</label>
            <input
              type="password"
              class="form-control <?= isset( $errorsInProfile['passwordRegister'] ) ? "is-invalid" : null ?> "
              name="passwordRegister"
              value=""
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInProfile['passwordRegister'] ) ? $errorsInProfile['passwordRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Repetir contraseña</label>
            <input
              type="password"
              class="form-control <?= isset( $errorsInProfile['repassword'] ) ? "is-invalid" : null ?> "
              name="repassword"
              value=""
              >
              <div class="invalid-feedback">
                <?= isset( $errorsInProfile['repassword'] ) ? $errorsInProfile['repassword'] : null ?>
              </div>
          </div>

          <div class="boxRegistry">
            <label for="">Imagen</label>
            <input
              class="avatarInput form-control <?= isset( $errorsInProfile['avatarRegister'] ) ? "is-invalid" : null ?> "
              type="file"
              name="avatarRegister"
              value=""
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInProfile['avatarRegister'] ) ? $errorsInProfile['avatarRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
              <button class="button-form" type="submit" name="buttonRegister" value="1">CREAR CUENTA</button>
          </div>

        </form>
      </section>

  </main>

<?php

  require_once('./partials/footer.php');

?>
