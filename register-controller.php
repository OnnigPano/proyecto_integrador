<?php


session_start();

define('ALLOWED_FORMAT_IMAGE', ['jpg','jpeg','png']);
define('IMAGE_FILE_PATH', dirname(__FILE__) . '/data/avatars/');
define('JSON_USERS_PATH', dirname(__FILE__) . '/data/users.json');



function registerValidate(){

   $errors = [];

   $nameRegister= trim($_POST['nameRegister']);
   $surnameRegister= trim($_POST['surnameRegister']);
   $nicknameRegister= trim($_POST['nicknameRegister']);
   $passwordRegister= trim($_POST['passwordRegister']);
   $emailRegister = trim($_POST['emailRegister']);

   $avatarRegister = $_FILES['avatarRegister'];

   if (empty($nameRegister)) {
      $errors['nameRegister'] = 'El campo nombre es OBLIGATORIO';
   }

   if (empty($surnameRegister)) {
      $errors['surnameRegister'] = 'El campo apellido es OBLIGATORIO';
   }

   if (empty($nicknameRegister)) {
      $errors["nicknameRegister"] = "El campo nickname es OBLIGATORIO";
    } //FALTA UN "ELSE" QUE VERIFIQUE QUE NO HAYA UN MISMO USUARIO EN LA BASE

   if (empty($emailRegister)) {
      $errors['emailRegister'] = 'El campo email es OBLIGATORIO';
   }elseif (!filter_var($emailRegister, FILTER_VALIDATE_EMAIL)) {
      $errors['emailRegister'] = 'El formato de mail no es valido';
   } elseif (checkEmailExist($emailRegister)) {
     $errors['emailRegister'] = 'El mail ingresado ya existe en nuestra base de datos';
   }

   if (empty($passwordRegister)) {
      $errors["$passwordRegister"] = "El campo password es OBLIGATORIO";
    } //COMPARAR CON RE-PASSWORD

    if ($avatarRegister['error'] != UPLOAD_ERR_OK) {
      $errors['avatarRegister'] = 'Subí una imagen';
    }else{
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

  $nameRegister= trim($_POST['nameRegister']);
  $surnameRegister= trim($_POST['surnameRegister']);
  $nicknameRegister= trim($_POST['nicknameRegister']);
  $emailRegister = trim($_POST['emailRegister']);

  unset($_POST['passwordRegister']);

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


//FUNCION PARA DEBAGUEAR
function myDeBug($data){
      echo "<pre>";
		var_dump($data);
		echo "</pre>";
		exit;
}

?>
