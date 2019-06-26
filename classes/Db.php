<?php

    class Db  
    {
       /* protected $name;
        protected $surname;
        protected $nickname;
        protected $password;
        protected $email;
        protected $country;
        protected $avatar; */

        public function saveUser() {
            $_POST['nameRegister'] = trim($_POST['nameRegister']);
            $_POST['surnameRegister'] = trim($_POST['surnameRegister']);
            $_POST['nicknameRegister'] = trim($_POST['nicknameRegister']);
            $_POST['emailRegister'] = trim($_POST['emailRegister']);
            $_POST['passwordRegister'] = password_hash( trim($_POST['passwordRegister']), PASSWORD_DEFAULT );
          
            unset($_POST['repassword']);
            unset($_POST['buttonRegister']);
          
            $userToSave = $_POST;
          
            $allUsers = Db::getAllUsers();
            $allUsers[] = $userToSave;
          
            file_put_contents(JSON_USERS_PATH, json_encode($allUsers));
          
            return $userToSave;
        }

        public function saveImage() {
            $extension = pathinfo($_FILES['avatarRegister']['name'], PATHINFO_EXTENSION);
            $tempFile = $_FILES['avatarRegister']['tmp_name'];
            $finalName = uniqid( 'img_') . '.' . $extension;
            $finalPath = IMAGE_FILE_PATH . $finalName;
            move_uploaded_file($tempFile, $finalPath);
          
            return $finalName;
        }

        static public function getAllUsers() {
            $fileContent = file_get_contents(JSON_USERS_PATH);
            $allUsers = json_decode($fileContent, true);
            return $allUsers;
        }

        static public function checkUserExist($nickname) {
            $allUsers = Db::getAllUsers();

            foreach ($allUsers as $user){
                if ($user['nicknameRegister'] == $nickname){
                    return true;
                }
            }
            return false;
        }

        static public function checkEmailExist($email) {
            $allUsers = Db::getAllUsers();

            foreach ($allUsers as $user) {
              if ($user['emailRegister'] == $email) {
                return true;
              }
            }
            return false;
        }

        static public function getUserByEmail($email) {
            $allUsers = Db::getAllUsers();

            foreach ($allUsers as $oneUser) {
              if ($oneUser["emailRegister"] == $email) {
                return $oneUser;
              }
            }
        }

        static public function getUserByUsername($userName) {
            $allUsers = Db::getAllUsers();

            foreach ($allUsers as $user){
                if ($user["nicknameRegister"] == $userName){
                    return $user;
                }
            }
        }


    }
    