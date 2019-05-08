<?php


session_start();

define(ALLOWED_FORMAT_IMAGE, ['jpg','jpeg','png']);
define(IMAGE_FILE_PATH, dirname(__FILE__) . '/data/avatars/');


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
   } //Falta revisar si ya existe

   if (empty($passwordRegister)) {
      $errors["$passwordRegister"] = "El campo password es OBLIGATORIO";
    } //COMPARAR CON RE-PASSWORD

    if ($avatarRegister['error'] != UPLOAD_ERR_OK) {
      $errors['$avatarRegister'] = 'Subí una imagen';
    }else{
      $extension = pathinfo($avatarRegister[name], PATHINFO_EXTENSION);

      if (!in_array($extension,ALLOWED_FORMAT_IMAGE)) {
        $errors[$avatarRegister] = 'Revise el formato de la imagen.';
      }
    }


   return $errors;
}

function saveImg(){
  $extension = pathinfo($_FILES['$avatarRegister']['name'], PATHINFO_EXTENSION);
  $tempFile = $_FILES['avatarRegister']['tmp_name'];
  $finalName = uniqid( 'img_') . '.' . $extension;
  $finalPath = IMAGE_FILE_PATH . $finalName;
  move_uploaded_file($tempFile, $finalPath);

  return $finalName;
}



//FUNCION PARA DEBAGUEAR
function myDeBug($data){
      echo "<pre>";
		var_dump($data);
		echo "</pre>";
		exit;
}

?>
