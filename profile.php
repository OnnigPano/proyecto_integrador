<?php

  $title = 'Mi Cuenta - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');
  require_once('autoload.php');

  //Si no está loggeado, redirige.
  if ( !LoginValidator::isLogged() ) {
    header('location: login.php');
    exit;
  }
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

    $editValidator = new EditValidator();
    

    if ( $_POST['buttonRegister'] == 1 ) {

      
      //Validamos el edit y seteamos los errores si existen.
      $editValidator->isValid();
      //Traemos los errores si existen
      $errorsInProfile = $editValidator->getAllErrors();

      if (!$errorsInProfile) {
        //User ID
        $id = $_SESSION['userLoged']['id'];
        //instanciamos controlador del DB
        $database = new DB();
        //seteamos la Url que viene desde la Session
        $editValidator->setAvatarUrl();
        //Almacenamos nuevo url si cambió el avatar
        if ( $_FILES['avatarRegister']['name'] != "" ) {
          $url = $database->saveImage();
          $editValidator->setNewAvatarUrl($url);
        }
        //Seteamos nueva password si la cambió
        $editValidator->setPassword();
        
        //Editamos la información del usuario en la BD
        $database->updateUser($editValidator->getName(), $editValidator->getSurname(), $editValidator->getNickname(), 
                  $editValidator->getEmail(), $editValidator->getCountry(), $editValidator->getPassword(), 
                  $editValidator->getAvatarUrl(), $id);
        //Traemos al usuario con sus nuevos datos y lo logueamos
        $thisUser = DB::getUserByID($id);

        setcookie( 'userLoged', $editValidator->getEmail(), time() + 3600000 );

        LoginValidator::login($thisUser);

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

        <h2 class="text-center">Bienvenid@ <?= $_SESSION['userLoged']['name'] ?>!</h2>
        <h4 class="text-center">En ésta sección podrás ver y editar tus datos de cuenta</h4>

        <div class="img-thumbnail mt-4" style="background-image:url('data/avatars/<?=$_SESSION["userLoged"]['avatar'] ?>');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
                height: 200px;
                max-width: 200px;
                display: block;
                margin: auto">
        </div>

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
                class="form-control text-capitalize <?= isset( $errorsInProfile['nickname'] ) ? "is-invalid" : null ?> "
                name="nicknameRegister"
                value="<?= $_SESSION['userLoged']['nickname']?>" <?= $disableForm ?>
                >
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['nickname'] ) ? $errorsInProfile['nickname'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Nombre</label>
              <div class="col-sm-6">
                <input
                type="text"
                class="form-control text-capitalize <?= isset( $errorsInProfile['name'] ) ? "is-invalid" : null ?> "
                name="nameRegister"
                value="<?= $_SESSION['userLoged']['name']; ?>"
                >
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['name'] ) ? $errorsInProfile['name'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Apellido</label>
              <div class="col-sm-6">
                <input
                type="text"
                class="form-control text-capitalize <?= isset( $errorsInProfile['surname'] ) ? "is-invalid" : null ?> "
                name="surnameRegister"
                value="<?= $_SESSION['userLoged']['surname'] ?>"
                >
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['surname'] ) ? $errorsInProfile['surname'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Correo electrónico</label>
              <div class="col-sm-6">
                <input
                type="email"
                class="form-control <?= isset( $errorsInProfile['email'] ) ? "is-invalid" : null ?> "
                name="emailRegister"
                value="<?= $_SESSION['userLoged']['email'] ?>"
                >
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['email'] ) ? $errorsInProfile['email'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">País</label>
              <div class="col-sm-6">
                <select class="custom-select form-control-lg <?= isset( $errorsInProfile['country'] ) ? "is-invalid" : null ?> " name="countryRegister">
                  <option value="">Elegí un país</option>
                  <?php foreach ($countries as $code => $country): ?>
                    <option
                    value="<?= $code ?>"
                    <?= $code == $_SESSION['userLoged']['country'] ? 'selected' : null ?>
                    > <?= $country ?> </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['country'] ) ? $errorsInProfile['country'] : null ?>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-sm-2">Cambiar contraseña</label>
              <div class="col-sm-6">
                <input
                type="password"
                class="form-control <?= isset( $errorsInProfile['password'] ) ? "is-invalid" : null ?> "
                name="passwordRegister"
                value=""
                >
                <span class="form-text">Debe contener más de 5 caracteres e incluir "DH". No utilices espacios. </span>
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['password'] ) ? $errorsInProfile['password'] : null ?>
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
                class="avatarInput form-control-file <?= isset( $errorsInProfile['avatar'] ) ? "is-invalid" : null ?> "
                type="file"
                name="avatarRegister"
                >
                <div class="invalid-feedback">
                  <?= isset( $errorsInProfile['avatar'] ) ? $errorsInProfile['avatar'] : null ?>
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
