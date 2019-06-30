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
            $this->name = trim($_POST['nameRegister']);
            $this->surname = trim($_POST['surnameRegister']);
            $this->nickname = trim($_POST['nicknameRegister']);
            $this->password = password_hash( trim($_POST['passwordRegister']), PASSWORD_DEFAULT );
            $this->email = trim($_POST['emailRegister']);
            $this->country = $_POST['countryRegister'];
            $this->avatar = $_FILES['avatarRegister'];
        }

        // METODOS JSON OOP ---------------------------------------------------------------------------------------

       /* function generateId(){

            $allUsers = self::getAllUsers();

            if (count($allUsers) == 0) {
                return 1;
            }

            $lastIdUser = array_pop($allUsers);
            return $lastIdUser['id'] + 1;
        } */

       /* public function saveUser() {
          
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
        }*/


        /*static public function getAllUsers() {
            $fileContent = file_get_contents(JSON_USERS_PATH);
            $allUsers = json_decode($fileContent, true);
            return $allUsers;
        }*/

        /*static public function checkUserExist($nickname) {
            $allUsers = self::getAllUsers();

            foreach ($allUsers as $user){
                if ($user['nickname'] == $nickname){
                    return true;
                }
            }
            return false;
        }*/

       /* static public function checkEmailExist($email) {
            $allUsers = self::getAllUsers();

            foreach ($allUsers as $user) {
              if ($user['email'] == $email) {
                return true;
              }
            }
            return false;
        } */

        /* static public function getUserByEmail($email) {
            $allUsers = self::getAllUsers();

            foreach ($allUsers as $oneUser) {
              if ($oneUser["email"] == $email) {
                return $oneUser;
              }
            }
        } */

        /* static public function getUserByUsername($userName) {
            $allUsers = self::getAllUsers();

            foreach ($allUsers as $user){
                if ($user["nickname"] == $userName){
                    return $user;
                }
            }
        } */

        //FIN METODOS JSON OOP ------------------------------------------------------------------------------------------

        public function saveImage() {
            $extension = pathinfo($_FILES['avatarRegister']['name'], PATHINFO_EXTENSION);
            $tempFile = $_FILES['avatarRegister']['tmp_name'];
            $finalName = uniqid( 'img_') . '.' . $extension;
            $finalPath = IMAGE_FILE_PATH . $finalName;
            move_uploaded_file($tempFile, $finalPath);
          
            return $finalName;
        }

        public function passwordHash()
        {
            $this->password = password_hash( trim($_POST['passwordRegister']), PASSWORD_DEFAULT );
        }

        public function unsetValues()
        {
            unset($this->avatar);
            unset($this->password);
        }

        //METODOS MySQL


        public function insertUser()
        {
            global $db;
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

                $lastID = $db->lastInsertID();

                return $lastID;

                
            } catch (\PDOException $e) {
                var_dump($e->getMessage());
                exit;
            }
            
        }

        public function getUserByID($id)
        {
            global $db;

            try {
                $sql = "SELECT * FROM users WHERE id = ?";

                $stmt = $db->prepare($sql);
                $stmt->bindValue(1, $id, PDO::PARAM_INT);

                $stmt->execute();

                $results = $stmt->fetch(PDO::FETCH_ASSOC);

                return $results;

            } catch (PDOException $e) {
                die('Error buscando usuario por ID');
            }
            
        }

        static public function checkEmailExist($email)
        {
            global $db;

            try {
                $sql = "SELECT * FROM users WHERE email = ?";

                $stmt = $db->prepare($sql);
                $stmt->bindValue(1, $email, PDO::PARAM_STR);

                $stmt->execute();

                $rows = $stmt->rowCount();

                if ($rows > 0) {
                    return true;
                } else {
                    return false;
                }

            } catch (PDOException $e) {
                die('Error buscando usuario por email');
            }
            
        }

        static public function getUserByEmail($email)
        {

            global $db;

            try {
                $sql = "SELECT * FROM users WHERE email = ?";

                $stmt = $db->prepare($sql);
                $stmt->bindValue(1, $email, PDO::PARAM_STR);

                $stmt->execute();

                
                $results = $stmt->fetch(PDO::FETCH_ASSOC);

                $rows = $stmt->rowCount();

                if ($rows > 0) {
                    return $results;
                } else {
                    return false;
                }
                

            } catch (PDOException $e) {
                die('Error buscando usuario por email');
            }
            
        }

        static public function checkUserExist($nickname)
        {
            global $db;

            try {
                $sql = "SELECT * FROM users WHERE nickname = ?";

                $stmt = $db->prepare($sql);
                $stmt->bindValue(1, $nickname, PDO::PARAM_STR);

                $stmt->execute();

                $rows = $stmt->rowCount();

                if ($rows > 0) {
                    return true;
                } else {
                    return false;
                }

            } catch (PDOException $e) {
                die('Error buscando usuario por nickname');
            }
            
        }

        static public function getUserByUsername($name)
        {
            global $db;

            try {
                $sql = "SELECT * FROM users WHERE nickname = ?";

                $stmt = $db->prepare($sql);
                $stmt->bindValue(1, $name, PDO::PARAM_STR);

                $stmt->execute();

                
                $results = $stmt->fetch(PDO::FETCH_ASSOC);

                $rows = $stmt->rowCount();

                if ($rows > 0) {
                    return $results;
                } else {
                    return false;
                }
                

            } catch (PDOException $e) {
                die('Error buscando usuario por nickname');
            }
            
        }




        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of avatarUrl
         *
         * @return  self
         */ 
        public function setAvatarUrl($avatarUrl)
        {
                $this->avatarUrl = $avatarUrl;

                return $this;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Set the value of surname
         *
         * @return  self
         */ 
        public function setSurname($surname)
        {
                $this->surname = $surname;

                return $this;
        }

        /**
         * Get the value of nickname
         */ 
        public function getNickname()
        {
                return $this->nickname;
        }

        /**
         * Set the value of nickname
         *
         * @return  self
         */ 
        public function setNickname($nickname)
        {
                $this->nickname = $nickname;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of avatar
         *
         * @return  self
         */ 
        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

                return $this;
        }

        /**
         * Get the value of avatarUrl
         */ 
        public function getAvatarUrl()
        {
                return $this->avatarUrl;
        }

        /**
         * Get the value of surname
         */ 
        public function getSurname()
        {
                return $this->surname;
        }

        /**
         * Get the value of country
         */ 
        public function getCountry()
        {
                return $this->country;
        }
    }
    