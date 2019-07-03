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
            $this->name = isset($_POST['nameRegister']) ?  trim($_POST['nameRegister']) : null;
            $this->surname = isset($_POST['surnameRegister']) ? trim($_POST['surnameRegister']) : null;
            $this->nickname = isset($_POST['nicknameRegister']) ? trim($_POST['nicknameRegister']) : null;
            $this->password = isset($_POST['passwordRegister']) ? trim($_POST['passwordRegister']) : null;
            $this->email = isset($_POST['emailRegister']) ? trim($_POST['emailRegister']) : null;
            $this->country = isset($_POST['countryRegister']) ? $_POST['countryRegister'] : null;
            $this->avatar = isset($_FILES['avatarRegister']) ? $_FILES['avatarRegister'] : null;

        }

        //Guarda el avatar del usuario y devuelve la ruta de la imagen
        public function saveImage() {
            $extension = pathinfo($_FILES['avatarRegister']['name'], PATHINFO_EXTENSION);
            $tempFile = $_FILES['avatarRegister']['tmp_name'];
            $finalName = uniqid( 'img_') . '.' . $extension;
            $finalPath = IMAGE_FILE_PATH . $finalName;
            move_uploaded_file($tempFile, $finalPath);
          
            return $finalName;
        }
        //Hashea el password
        public function passwordHash()
        {
            $this->password = password_hash( trim($_POST['passwordRegister']), PASSWORD_DEFAULT );
        }

        //METODOS MySQL

        //Inserta el usuario en la BD
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
        //Trae al usuario de la BD por le id
        static public function getUserByID($id)
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
        //Valida si el email ya existe en la BD
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
        //Trae al usuario por su email
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
        //Valida si existe el nickname en la BD
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
        //Trae al usuario por su nickname
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
        //Actualiz(edita) al usuario según su selección de datos
        public function updateUser($name, $surname, $nickname, $email, $country, $password, $avatar, $id)
        {       
            global $db;

            try {
                $sql = "UPDATE users SET name = :name, surname = :surname, nickname = :nickname, email = :email,
                        country = :country, password = :password, avatar = :avatar WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':name', $name);
                $stmt->bindValue(':surname', $surname);
                $stmt->bindValue(':nickname', $nickname);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':country', $country);
                $stmt->bindValue(':password', $password);
                $stmt->bindValue(':avatar', $avatar);
                $stmt->bindValue(':id', $id);

                $stmt->execute();

            } catch (\PDOException $e) {
                echo $e;
                die('Error editando usuario en la BD');
            }
        }
        //Trae a todos los usuarios del archivo json
        static public function getUsersFromJson()
        {
            $fileContent = file_get_contents(JSON_USERS_PATH);
            $allUsersJson = json_decode($fileContent, true);
            return $allUsersJson;

        }
        //Guarda a los usuarios del json siempre y cuando no se repita el email o nickname en la BD 
        static public function saveUsersFromJson($jsonUsers)
        {   
            global $db;
            foreach ($jsonUsers as $oneUser) {
                if (!self::checkEmailExist($oneUser['email']) && !self::checkUserExist($oneUser['nickname'])) {
                    try {

                        $sql = "INSERT INTO users(name, surname, nickname, email, country, password, avatar, registration_date) 
                                VALUES (:name, :surname, :nickname, :email, :country, :password, :avatar, NOW() )";
                        
        
                        $stmt = $db->prepare($sql);
                        $stmt->bindValue(':name', $oneUser['name']);
                        $stmt->bindValue(':surname', $oneUser['surname']);
                        $stmt->bindValue(':nickname', $oneUser['nickname']);
                        $stmt->bindValue(':email', $oneUser['email']);
                        $stmt->bindValue(':country', $oneUser['country']);
                        $stmt->bindValue(':password', $oneUser['password']);
                        $stmt->bindValue(':avatar', $oneUser['avatar']);
        
                        $stmt->execute();        
                        
                    } catch (\PDOException $e) {
                        var_dump($e->getMessage());
                        exit;
                    }
                    
                }
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
    