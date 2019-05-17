<?php

  $title= 'Registrate! - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');
  require_once('register-controller.php');

  if ( isLoged() ) {
    header('location: index.php');
    exit;
  }

  $errorsInRegister = [];

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


  //Variables persistencia

  $nameRegister = '';
  $surnameRegister = '';
  $nicknameRegister = '';
  $emailRegister = '';
  $countryFromPost = '';



//PERSISTENCIA DEL FORMULARIO
  if ($_POST) {

    $nameRegister= isset($_POST["nameRegister"]) ? trim($_POST["nameRegister"]) : " " ;
    $surnameRegister= isset($_POST["surnameRegister"]) ? trim($_POST["surnameRegister"]) : " " ;
    $nicknameRegister= isset($_POST["nicknameRegister"]) ? trim($_POST["nicknameRegister"]) : " " ;
    $emailRegister= isset($_POST["emailRegister"]) ? trim($_POST["emailRegister"]) : " " ;
    $countryFromPost = $_POST['countryRegister'];


    $errorsInRegister = registerValidate();

    if (!$errorsInRegister) {

      $imgName = saveImg();

      $_POST['avatarRegister'] = $imgName;
      $_POST['id'] = generateId();


      $thisUser = saveUser();

      setcookie( 'userLoged', $thisUser['email'], time() + 3600000 );

      login($thisUser);

    }

    //myDeBug($errorsInRegister);

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
            <input
              type="text"
              class="form-control <?= isset( $errorsInRegister['nameRegister'] ) ? "is-invalid" : null ?> "
              name="nameRegister"
              value="<?= $nameRegister ?>"
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInRegister['nameRegister'] ) ? $errorsInRegister['nameRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Apellido</label>
            <input
              type="text"
              class="form-control <?= isset( $errorsInRegister['surnameRegister'] ) ? "is-invalid" : null ?> "
              name="surnameRegister"
              value="<?= $surnameRegister ?>"
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInRegister['surnameRegister'] ) ? $errorsInRegister['surnameRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="userName">Usuario</label>
            <input
              type="text"
              class="form-control <?= isset( $errorsInRegister['nicknameRegister'] ) ? "is-invalid" : null ?> "
              name="nicknameRegister"
              value="<?= $nicknameRegister ?>"
              >
              <div class="invalid-feedback">
                <?= isset( $errorsInRegister['nicknameRegister'] ) ? $errorsInRegister['nicknameRegister'] : null ?>
              </div>
          </div>

          <div class="boxRegistry">
            <label for="">Correo electrónico</label>
            <input
              type="email"
              class="form-control <?= isset( $errorsInRegister['emailRegister'] ) ? "is-invalid" : null ?> "
              name="emailRegister"
              value="<?= $emailRegister ?>"
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInRegister['emailRegister'] ) ? $errorsInRegister['emailRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">País</label>
            <select class="custom-select form-control <?= isset( $errorsInRegister['countryRegister'] ) ? "is-invalid" : null ?> " name="countryRegister">
              <option value="">Elegí un país</option>
              <?php foreach ($countries as $code => $country): ?>
                <option
                  value="<?= $code ?>"
                  <?= $code == $countryFromPost ? 'selected' : null ?>
                > <?= $country ?> </option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
              <?= isset( $errorsInRegister['countryRegister'] ) ? $errorsInRegister['countryRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Contraseña</label>
            <input
              type="password"
              class="form-control <?= isset( $errorsInRegister['passwordRegister'] ) ? "is-invalid" : null ?> "
              name="passwordRegister"
              value=""
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInRegister['passwordRegister'] ) ? $errorsInRegister['passwordRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Repetir contraseña</label>
            <input
              type="password"
              class="form-control <?= isset( $errorsInRegister['repassword'] ) ? "is-invalid" : null ?> "
              name="repassword"
              value=""
              >
              <div class="invalid-feedback">
                <?= isset( $errorsInRegister['repassword'] ) ? $errorsInRegister['repassword'] : null ?>
              </div>
          </div>

          <div class="boxRegistry">
            <label for="">Imagen</label>
            <input
              class="avatarInput form-control <?= isset( $errorsInRegister['avatarRegister'] ) ? "is-invalid" : null ?> "
              type="file"
              name="avatarRegister"
              value=""
            >
            <div class="invalid-feedback">
              <?= isset( $errorsInRegister['avatarRegister'] ) ? $errorsInRegister['avatarRegister'] : null ?>
            </div>
          </div>

          <div class="boxRegistry">
              <button class="button-form" type="submit" name="buttonRegister">CREAR CUENTA</button>
          </div>

        </form>
      </section>

        <?php

          require_once('./partials/footer.php');

        ?>
