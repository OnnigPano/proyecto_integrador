<?php

  $title= 'Registrate! - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');
  require_once('register-controller.php');

  require_once('classes/Validator.php');
  require_once('classes/RegisterValidator.php');

  $regvalidator = new RegisterValidator();

  if ( isLogged() ) {
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


//PERSISTENCIA DEL FORMULARIO
  if ($_POST) {

    $regvalidator->isValid();

    $errorsInRegister = registerValidate();

    if (!$errorsInRegister) {

      $imgName = saveImg();

      $_POST['avatarRegister'] = $imgName;
      $_POST['id'] = generateId();


      $thisUser = saveUser();

      setcookie( 'userLoged', $thisUser['email'], time() + 3600000 );

      login($thisUser);

    }

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
              class="form-control <?= $regvalidator->hasError('name') ? "is-invalid" : null ?> "
              name="nameRegister"
              value="<?= $regvalidator->getName() ?>"
            >
            <div class="invalid-feedback">
              <?= $regvalidator->hasError('name') ? $regvalidator->getError('name') : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Apellido</label>
            <input
              type="text"
              class="form-control <?= $regvalidator->hasError('surname') ? "is-invalid" : null ?> "
              name="surnameRegister"
              value="<?= $regvalidator->getSurname() ?>"
            >
            <div class="invalid-feedback">
              <?= $regvalidator->hasError('surname') ? $regvalidator->getError('surname') : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="userName">Usuario</label>
            <input
              type="text"
              class="form-control <?= $regvalidator->hasError('nickname') ? "is-invalid" : null ?> "
              name="nicknameRegister"
              value="<?= $regvalidator->getNickname() ?>"
              >
              <div class="invalid-feedback">
                <?= $regvalidator->hasError('nickname') ? $regvalidator->getError('nickname') : null ?>
              </div>
          </div>

          <div class="boxRegistry">
            <label for="">Correo electrónico</label>
            <input
              type="email"
              class="form-control <?= $regvalidator->hasError('email') ? "is-invalid" : null ?> "
              name="emailRegister"
              value="<?= $regvalidator->getEmail() ?>"
            >
            <div class="invalid-feedback">
              <?= $regvalidator->hasError('email') ? $regvalidator->getError('email') : null ?>
            </div>
          </div>



          <div class="boxRegistry">
            <label for="">Contraseña</label>
            <input
              type="password"
              class="form-control <?= $regvalidator->hasError('password') ? "is-invalid" : null ?> "
              name="passwordRegister"
              value=""
            >
            <div class="invalid-feedback">
              <?= $regvalidator->hasError('password') ? $regvalidator->getError('password') : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Repetir contraseña</label>
            <input
              type="password"
              class="form-control <?= $regvalidator->hasError('repassword') ? "is-invalid" : null ?> "
              name="repassword"
              value=""
              >
              <div class="invalid-feedback">
                <?= $regvalidator->hasError('repassword') ? $regvalidator->getError('repassword') : null ?>
              </div>
          </div>

            <div class="boxRegistry">
                <label for="">País</label> <br><br>
                <select class="custom-select form-control <?= $regvalidator->hasError('country') ? "is-invalid" : null ?> " name="countryRegister">
                    <option value="">Elegí un país</option>
                    <?php foreach ($countries as $code => $country): ?>
                        <option
                                value="<?= $code ?>"
                            <?= $code == $regvalidator->getCountry() ? 'selected' : null ?>
                        > <?= $country ?> </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $regvalidator->hasError('country') ? $regvalidator->getError('country') : null ?>
                </div>
            </div>

          <div class="boxRegistry">
            <label for="">Imagen</label>
            <input
              class="avatarInput form-control <?= $regvalidator->hasError('avatar') ? "is-invalid" : null ?> "
              type="file"
              name="avatarRegister"
              value=""
            >
            <div class="invalid-feedback">
              <?= $regvalidator->hasError('avatar') ? $regvalidator->getError('avatar') : null ?>
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
