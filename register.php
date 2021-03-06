<?php

  $title= 'Registrate! - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');
  require_once('autoload.php');

  //Si existe cookie, logueamos al usuario.
  LoginValidator::loginWithCookie();

  //Si ya está logueado, redirige.
  if ( LoginValidator::isLogged() ) {
    header('location: index.php');
    exit;
  }

  //Instanciamos el Validador para el registro.
  $regValidator = new RegisterValidator();

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


  if ($_POST) {

    //Validamos el registro y seteamos los erores si existen.
    $regValidator->isValid();
    //Almacenamos los errores si existen.
    $errorsInRegister = $regValidator->getAllErrors();

    if (!$errorsInRegister) {

      //No hay errores, entonces instanciamos el controlador de la BD
      $database = new DB();
      //Hasheamos el password
      $database->passwordHash();
      //Guardamos el avatar en la carpeta data.
      $avatarDir = $database->saveImage();
      //Seteamos la URL del avatar.
      $database->setAvatarUrl($avatarDir);
      //Guardamos al usuario en la base de datos y obtenemos su ID.
      $userID = $database->insertUser();
      //Traemos al usuario registrado
      $userToLogin = $database->getUserByID($userID);
      //Generamos la cookie 
      setcookie( 'userLoged', $database->getEmail(), time() + 3600000 );
      //Logeamos al Usuario.
      LoginValidator::login($userToLogin);

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
              class="form-control <?= $regValidator->hasError('name') ? "is-invalid" : null ?> "
              name="nameRegister"
              value="<?= $regValidator->getName() ?>"
            >
            <div class="invalid-feedback">
              <?= $regValidator->hasError('name') ? $regValidator->getError('name') : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Apellido</label>
            <input
              type="text"
              class="form-control <?= $regValidator->hasError('surname') ? "is-invalid" : null ?> "
              name="surnameRegister"
              value="<?= $regValidator->getSurname() ?>"
            >
            <div class="invalid-feedback">
              <?= $regValidator->hasError('surname') ? $regValidator->getError('surname') : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="userName">Usuario</label>
            <input
              type="text"
              class="form-control <?= $regValidator->hasError('nickname') ? "is-invalid" : null ?> "
              name="nicknameRegister"
              value="<?= $regValidator->getNickname() ?>"
              >
              <div class="invalid-feedback">
                <?= $regValidator->hasError('nickname') ? $regValidator->getError('nickname') : null ?>
              </div>
          </div>

          <div class="boxRegistry">
            <label for="">Correo electrónico</label>
            <input
              type="email"
              class="form-control <?= $regValidator->hasError('email') ? "is-invalid" : null ?> "
              name="emailRegister"
              value="<?= $regValidator->getEmail() ?>"
            >
            <div class="invalid-feedback">
              <?= $regValidator->hasError('email') ? $regValidator->getError('email') : null ?>
            </div>
          </div>



          <div class="boxRegistry">
            <label for="">Contraseña</label>
            <input
              type="password"
              class="form-control <?= $regValidator->hasError('password') ? "is-invalid" : null ?> "
              name="passwordRegister"
              value=""
            >
            <div class="invalid-feedback">
              <?= $regValidator->hasError('password') ? $regValidator->getError('password') : null ?>
            </div>
          </div>

          <div class="boxRegistry">
            <label for="">Repetir contraseña</label>
            <input
              type="password"
              class="form-control <?= $regValidator->hasError('repassword') ? "is-invalid" : null ?> "
              name="repassword"
              value=""
              >
              <div class="invalid-feedback">
                <?= $regValidator->hasError('repassword') ? $regValidator->getError('repassword') : null ?>
              </div>
          </div>

            <div class="boxRegistry">
                <label for="">País</label> <br><br>
                <select class="custom-select form-control <?= $regValidator->hasError('country') ? "is-invalid" : null ?> " name="countryRegister">
                    <option value="">Elegí un país</option>
                    <?php foreach ($countries as $code => $country): ?>
                        <option
                                value="<?= $code ?>"
                            <?= $code == $regValidator->getCountry() ? 'selected' : null ?>
                        > <?= $country ?> </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $regValidator->hasError('country') ? $regValidator->getError('country') : null ?>
                </div>
            </div>

          <div class="boxRegistry">
            <label for="">Imagen</label>
            <input
              class="avatarInput form-control <?= $regValidator->hasError('avatar') ? "is-invalid" : null ?> "
              type="file"
              name="avatarRegister"
              value=""
            >
            <div class="invalid-feedback">
              <?= $regValidator->hasError('avatar') ? $regValidator->getError('avatar') : null ?>
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
