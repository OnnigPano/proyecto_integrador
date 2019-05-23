<?php

  $title = 'Mi Cuenta - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');
  require_once'register-controller.php';
  require_once'edit-profile-controller.php';

  if ( !isLogged() ) {
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
    //myDeBug($_FILES);

    if ( $_POST['buttonRegister'] == 1 ) {

      $errorsInProfile = profileValidate();

      if (!$errorsInProfile) {

        $thisUser = saveUserEdited();

        setcookie( 'userLoged', $_SESSION['userLoged']['emailRegister'], time() + 3600000 );

        login($thisUser);

      }
    }
  }

  $disableForm = "disabled";
  if ( $_GET ) {
    if ( $_GET['edit-profile'] == "true" ) {
      $disableForm = "";
    }
  }

?>

  <main>

    <section class="profile-container">

        <h2 class="text-center">Bienvenid@ <?= $_SESSION['userLoged']['nicknameRegister'] ?>!</h2>
        <h4 class="text-center">En ésta sección podrás ver y editar tus datos de cuenta</h4>

        <div class="img-thumbnail mt-4" style="background-image:url('data/avatars/<?=$_SESSION["userLoged"]["avatarRegister"] ?>');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
                height: 200px;
                max-width: 200px;
                display: block;
                margin: auto">
        </div>

        <!--<img src="data/avatars/<?/*= $_SESSION['userLoged']['avatarRegister'] */?>" class="profile-avatar img-thumbnail mx-auto d-block" alt="avatar usuario">-->




        <form class="text-right mt-4" method="get">
          <button class="btn btn-success mr-2" type="submit" name="edit-profile" value="true">EDITAR PERFIL</button>
        </form>

        <form class="profile-form m-3" method="post" enctype="multipart/form-data">

          <fieldset <?= $disableForm ?>>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Usuario</label>
              <div class="col-sm-6">
                <input
                type="text"
                class="form-control text-capitalize <?= isset( $errorsInProfile['nicknameRegister'] ) ? "is-invalid" : null ?> "
                name="nicknameRegister"
                value="<?= $_SESSION['userLoged']['nicknameRegister'] ?>" <?= $disableForm ?>
                >
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['nicknameRegister'] ) ? $errorsInProfile['nicknameRegister'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Nombre</label>
              <div class="col-sm-6">
                <input
                type="text"
                class="form-control text-capitalize <?= isset( $errorsInProfile['nameRegister'] ) ? "is-invalid" : null ?> "
                name="nameRegister"
                value="<?= $_SESSION['userLoged']['nameRegister'] ?>"
                >
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['nameRegister'] ) ? $errorsInProfile['nameRegister'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Apellido</label>
              <div class="col-sm-6">
                <input
                type="text"
                class="form-control text-capitalize <?= isset( $errorsInProfile['surnameRegister'] ) ? "is-invalid" : null ?> "
                name="surnameRegister"
                value="<?= $_SESSION['userLoged']['surnameRegister'] ?>"
                >
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['surnameRegister'] ) ? $errorsInProfile['surnameRegister'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Correo electrónico</label>
              <div class="col-sm-6">
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
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">País</label>
              <div class="col-sm-6">
                <select class="custom-select form-control-lg <?= isset( $errorsInProfile['countryRegister'] ) ? "is-invalid" : null ?> " name="countryRegister">
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
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Cambiar contraseña</label>
              <div class="col-sm-6">
                <input
                type="password"
                class="form-control <?= isset( $errorsInProfile['passwordRegister'] ) ? "is-invalid" : null ?> "
                name="passwordRegister"
                value=""
                >
                <span class="form-text">Debe contener más de 5 caracteres e incluir "DH". No utilices espacios. </span>
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['passwordRegister'] ) ? $errorsInProfile['passwordRegister'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Repetir contraseña</label>
              <div class="col-sm-6">
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
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Cambiar avatar</label>
              <div class="col-sm-6">
                <input
                class="avatarInput form-control-file <?= isset( $errorsInProfile['avatarRegister'] ) ? "is-invalid" : null ?> "
                type="file"
                name="avatarRegister"
                >
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['avatarRegister'] ) ? $errorsInProfile['avatarRegister'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
                <button class="button-form col col-sm-4 mx-auto" type="submit" name="buttonRegister" value="1">GUARDAR CAMBIOS</button>
            </div>

          </fieldset>

        </form>
      </section>

  </main>

<?php

  require_once('./partials/footer.php');

?>
