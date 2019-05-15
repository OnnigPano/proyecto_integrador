<?php

//Validamos los campos del perfil
function profileValidate(){

   $errors = [];

   $nameRegister = trim($_POST['nameRegister']);
   $surnameRegister = trim($_POST['surnameRegister']);
   $nicknameRegister = trim($_POST['nicknameRegister']);
   $passwordRegister = trim($_POST['passwordRegister']);
   $repassword = trim($_POST['repassword']);
   $emailRegister = trim($_POST['emailRegister']);
   $countryRegister = $_POST['countryRegister'];

   //Almacenamos el campo avatar solo si el usuario quiere editarlo.
   if ( isset($_FILES) ) {
     $avatarRegister = $_FILES['avatarRegister'];

     // Validamos la subida si el usuario eligió un nuevo avatar.
     if ($avatarRegister['error'] = UPLOAD_ERR_OK) {

        $extension = pathinfo($avatarRegister['name'], PATHINFO_EXTENSION);

      if (!in_array($extension,ALLOWED_FORMAT_IMAGE)) {
          $errors['avatarRegister'] = 'Revise el formato de la imagen.';
      }
     }
   }

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
   } elseif ( $emailRegister != $_SESSION['userLoged']['emailRegister'] ) {
     if ( checkEmailExist($emailRegister) ) {
       $errors['emailRegister'] = 'El mail ingresado ya existe en nuestra base de datos';
     }
   }

   /*
   Solo validamos los campos password si el usuario decide cambiar su contraseña.
   No validamos si está vacío, ya que si no quiere cambiar la contraseña
   lo va a dejar vacío y no seteamos el error.
   */

   if ( $passwordRegister != "" ) {
     if ( strlen($passwordRegister) < 5 ) {
       $errors["passwordRegister"] = "La contraseña debe tener más de 5 caracteres";
     } elseif ( strpos($passwordRegister, 'DH') === false ) {
       $errors["passwordRegister"] = "Recuerde que su contraseña debe incluir DH";
     } elseif ( $passwordRegister != $repassword ) {
       $errors["passwordRegister"] = "Las contraseñas ingresadas deben coincidir";
       $errors["repassword"] = "Las contraseñas ingresadas deben coincidir";
     } elseif ( strpos($passwordRegister, " ") !== false ) {
       $errors['passwordRegister'] = "La contraseña no puede contener espacios";
     }

   }

    if (empty($countryRegister)) {
      $errors['countryRegister'] = "Debe seleccionar un país";
    }

   return $errors;
}

//Averiguamos quién es el usuario logueado
function getUserLoged() {
  $allUsers = getAllUsers();

  foreach ($allUsers as $oneUser) {
    if ($oneUser['emailRegister'] == $_SESSION['userLoged']['emailRegister']) {
      return $oneUser;
    }
  }
}

//Editamos y guardamos los datos del usuario
function saveUserEdited() {

  //Traemos al usuario activo
  $userToEdit = getUserLoged();
  //Traemos todos los usuarios del JSON
  $allUsers = getAllUsers();

  //Buscamos al usuario a editar en el JSON y reemplazamos sus valores
  foreach ($allUsers as $key => $oneUser) {
    if ( $oneUser['id'] == $userToEdit['id']  ) {

      $allUsers[$key]['nameRegister'] = trim($_POST['nameRegister']);
      $allUsers[$key]['surnameRegister'] = trim($_POST['surnameRegister']);
      $allUsers[$key]['nicknameRegister'] = trim($_POST['nicknameRegister']);
      $allUsers[$key]['emailRegister'] = trim($_POST['emailRegister']);
      //Si el usuario cambia el password, hasheamos y almacenamos.
      if ( $_POST['passwordRegister'] != "" ) {
      $allUsers[$key]['passwordRegister'] = password_hash( trim($_POST['passwordRegister']), PASSWORD_DEFAULT );
      }

      /*
      si el usuario eligió un nuevo avatar, vamos a almacenar el valor para luego reemplazar su antiguo avatar
      */
      if ( isset($_FILES) ) {
      $imgName = saveImg();
      $allUsers[$key]['avatar'] = $imgName;
      //aca se guarda el nuevo avatar, PERO EL ANTERIOR NO SE ELIMINA DE LA CARPETA DATA
      }

      //guardamos al usuario editado
      $userEdited = $allUsers[$key];
    }
  }


  file_put_contents(JSON_USERS_PATH, json_encode($allUsers));

  return $userEdited;
}
