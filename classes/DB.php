<?php

    class DB  
    {   
        protected $id;
        protected $name;
        protected $surname;
        protected $nickname;
        protected $password;
        protected $email;
        protected $country;
        protected $avatar;
        protected $avatarUrl;

        public function __construct()
        {
            $this->id = $this->generateId();
            $this->name = trim($_POST['nameRegister']);
            $this->surname = trim($_POST['surnameRegister']);
            $this->nickname = trim($_POST['nicknameRegister']);
            $this->password = password_hash( trim($_POST['passwordRegister']), PASSWORD_DEFAULT );
            $this->email = trim($_POST['emailRegister']);
            $this->country = $_POST['countryRegister'];
            $this->avatar = $_FILES['avatarRegister'];
            $this->avatarUrl = $this->saveImage();
        }

        // FUNCIONES JSON

        function generateId(){

            $allUsers = self::getAllUsers();

            if (count($allUsers) == 0) {
                return 1;
            }

            $lastIdUser = array_pop($allUsers);
            return $lastIdUser['id'] + 1;
        }

        public function saveUser() {
          
            $userToSave = [
                'id' => $this->id,
                'name' => $this->name,
                'surname' => $this->surname,
                'nickname' => $this->nickname,
                'password' => $this->password,
                'email' => $this->email,
                'country' => $this->country,
                'avatar' => $this->avatarUrl
            ];
          
            $allUsers = self::getAllUsers();
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
            $allUsers = self::getAllUsers();

            foreach ($allUsers as $user){
                if ($user['nickname'] == $nickname){
                    return true;
                }
            }
            return false;
        }

        static public function checkEmailExist($email) {
            $allUsers = self::getAllUsers();

            foreach ($allUsers as $user) {
              if ($user['email'] == $email) {
                return true;
              }
            }
            return false;
        }

        static public function getUserByEmail($email) {
            $allUsers = self::getAllUsers();

            foreach ($allUsers as $oneUser) {
              if ($oneUser["email"] == $email) {
                return $oneUser;
              }
            }
        }

        static public function getUserByUsername($userName) {
            $allUsers = self::getAllUsers();

            foreach ($allUsers as $user){
                if ($user["nickname"] == $userName){
                    return $user;
                }
            }
        }

        //FIN FUNCIONES JSON

        //FUNCIONES MySQL


        public function insertUser()
        {
            require_once('conexion.php');
            try {

                $sql = "INSERT INTO users(name, surname, nickname, email, country, password, avatar, registration_date) 
                        VALUES (:name, :surname, :nickname, :email, :country, :password, :avatar, NOW() )";
                

                $stmt = $db->prepare($sql);
                $stmt->bindValue(':name', $this->name);
                $stmt->bindValue(':surname', $this->surname);
                $stmt->bindValue(':nickname', $this->nickname);
                $stmt->bindValue(':email', $this->email);
                $stmt->bindValue(':country', $this->country);
                $stmt->bindValue(':password', $this->password);
                $stmt->bindValue(':avatar', $this->avatarUrl);
                $stmt->execute();

                
            } catch (\PDOException $e) {
                var_dump($e->getMessage());
                exit;
            }
            
        }




        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }
    }
    