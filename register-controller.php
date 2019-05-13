<?php


session_start();

define('ALLOWED_FORMAT_IMAGE', ['jpg','jpeg','png']);
define('IMAGE_FILE_PATH', dirname(__FILE__) . '/data/avatars/');
define('JSON_USERS_PATH', dirname(__FILE__) . '/data/users.json');



function registerValidate(){

   $errors = [];

   $nameRegister = trim($_POST['nameRegister']);
   $surnameRegister = trim($_POST['surnameRegister']);
   $nicknameRegister = trim($_POST['nicknameRegister']);
   $passwordRegister = trim($_POST['passwordRegister']);
   $repassword = trim($_POST['repassword']);
   $emailRegister = trim($_POST['emailRegister']);
   $countryRegister = $_POST['countryRegister'];

   $avatarRegister = $_FILES['avatarRegister'];

   if (empty($nameRegister)) {
      $errors['nameRegister'] = 'El campo nombre es OBLIGATORIO';
   }

   if (empty($surnameRegister)) {
      $errors['surnameRegister'] = 'El campo apellido es OBLIGATORIO';
   }

   if (empty($nicknameRegister)) {
      $errors["nicknameRegister"] = "El campo usuario es OBLIGATORIO";
    } //FALTA UN "ELSE" QUE VERIFIQUE QUE NO HAYA UN MISMO USUARIO EN LA BASE

   if (empty($emailRegister)) {
      $errors['emailRegister'] = 'El campo email es OBLIGATORIO';
   } elseif (!filter_var($emailRegister, FILTER_VALIDATE_EMAIL)) {
      $errors['emailRegister'] = 'El formato de mail no es valido';
   } elseif (checkEmailExist($emailRegister)) {
     $errors['emailRegister'] = 'El mail ingresado ya existe en nuestra base de datos';
   }

   if (empty($passwordRegister)) {
      $errors["passwordRegister"] = "El campo password es OBLIGATORIO";
    } elseif ( strlen($passwordRegister) < 5 ) {
      $errors["passwordRegister"] = "La contraseña debe tener más de 5 caracteres";
    } elseif ( strpos($passwordRegister, 'DH') === false ) {
      $errors["passwordRegister"] = "Recuerde que su contraseña debe incluir DH";
    } elseif ( $passwordRegister != $repassword ) {
      $errors["passwordRegister"] = "Las contraseñas ingresadas deben coincidir";
      $errors["repassword"] = "Las contraseñas ingresadas deben coincidir";
    } elseif ( strpos($passwordRegister, " ") !== false ) {
      $errors['passwordRegister'] = "La contraseña no puede contener espacios";
    }

   if (empty($repassword)) {
      $errors["repassword"] = "Debe reingresar la contraseña";
    }

    if (empty($countryRegister)) {
      $errors['countryRegister'] = "Debe seleccionar un país";
    }

   if ($avatarRegister['error'] != UPLOAD_ERR_OK) {
      $errors['avatarRegister'] = 'Subí una imagen';
   } else {
      $extension = pathinfo($avatarRegister['name'], PATHINFO_EXTENSION);

    if (!in_array($extension,ALLOWED_FORMAT_IMAGE)) {
        $errors['avatarRegister'] = 'Revise el formato de la imagen.';
    }
   }


   return $errors;
}

function saveImg(){
  $extension = pathinfo($_FILES['avatarRegister']['name'], PATHINFO_EXTENSION);
  $tempFile = $_FILES['avatarRegister']['tmp_name'];
  $finalName = uniqid( 'img_') . '.' . $extension;
  $finalPath = IMAGE_FILE_PATH . $finalName;
  move_uploaded_file($tempFile, $finalPath);

  return $finalName;
}

function saveUser(){

  $_POST['nameRegister'] = trim($_POST['nameRegister']);
  $_POST['surnameRegister'] = trim($_POST['surnameRegister']);
  $_POST['nicknameRegister'] = trim($_POST['nicknameRegister']);
  $_POST['emailRegister'] = trim($_POST['emailRegister']);
  $_POST['passwordRegister'] = password_hash( trim($_POST['passwordRegister']), PASSWORD_DEFAULT );

  unset($_POST['repassword']);

  $userToSave = $_POST;

  $allUsers = getAllUsers();
  $allUsers[] = $userToSave;

  file_put_contents(JSON_USERS_PATH, json_encode($allUsers));

  return $userToSave;

}

function getAllUsers(){

  $fileContent = file_get_contents(JSON_USERS_PATH);
  $allUsers = json_decode($fileContent, true);
  return $allUsers;

}

function generateId(){

  $allUsers = getAllUsers();

  if (count($allUsers) == 0) {
    return 1;
  }

  $lastIdUser = array_pop($allUsers);
  return $lastIdUser['id'] + 1;
}

function checkEmailExist($email){

  $allUsers = getAllUsers();

  foreach ($allUsers as $user) {
    if ($user['emailRegister'] == $email) {
      return true;
    }
  }
  return false;
}

function login($user) {
  unset($user['passwordRegister']);

  $_SESSION['userLoged'] = $user;

  header('location: profile.php');
  exit;
}

function isLoged() {
  return isset($_SESSION['userLoged']);
}

//FUNCION PARA DEBAGUEAR
function myDeBug($data){
      echo "<pre>";
		var_dump($data);
		echo "</pre>";
		exit;
}

?>
