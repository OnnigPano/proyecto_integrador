<?php 

    class LoginValidator extends Validator 
    {
        private $userField;
        private $password;

        public function __construct()
        {
            parent::__construct();
            $this->userField = isset($_POST['email']) ? trim($_POST['email']) : null;
            $this->password = isset($_POST['password']) ? trim($_POST['password']) : null;
        }

        public function isValid()
        {
            if ($this->isMailOrIsNickname($this->userField) == 'isMail'){
                if ( empty($this->userField) ) {
                    $this->setError("login", "El campo de mail o usuario es OBLIGATORIO");
                } elseif (!filter_var($this->userField, FILTER_VALIDATE_EMAIL)) {
                    $this->setError("login", "El formato del correo electrónico es inválido");
                } elseif (!DB::checkEmailExist($this->userField)) {
                    $this->setError("login", "Las credenciales no coinciden");
                } else {
                    $theUser = DB::getUserByEmail($this->userField);
          
                    if ( !password_verify($this->password, $theUser["password"]) ) {
                        $this->setError("login", "Las credenciales no coinciden");
                    }
                }
            }elseif ($this->isMailOrIsNickname($this->userField) == 'isNickname'){
                if ( empty($this->userField) ) {
                    $this->setError("login", "El campo de mail o usuario es OBLIGATORIO,");
                }elseif (!DB::checkUserExist($this->userField)){
                    $this->setError("login", "Las credenciales no coinciden.");
                }else{
                    $theUser = DB::getUserByUsername($this->userField);

                    if ( !password_verify($this->password, $theUser["password"]) ) {
                        $this->setError("login", "Las credenciales no coinciden.");
                    }
                }
            }
          
            if ( empty($this->password) ) 
            {
              $this->setError('password', "El campo password es OBLIGATORIO.");
            }
        }

        static public function login($user) 
        {

            $_SESSION['userLoged'] = $user;
          
            header('location: profile.php');
            exit;
        }

        static public function isLogged() {
            return isset($_SESSION['userLoged']);
        }


        public function isMailOrIsNickname($fieldToValidate)
        {

            if (filter_var($fieldToValidate, FILTER_VALIDATE_EMAIL)){
                return 'isMail';
            }else{
                return 'isNickname';
            }
        }

        static public function loginWithCookie()
        {
            if ( isset($_COOKIE["userLoged"]) && !LoginValidator::isLogged() ) {
                $theUser = DB::getUserByEmail($_COOKIE["userLoged"]);
              
                $_SESSION["userLoged"] = $theUser;
              }
              
        }

        /**
         * Set the value of userField
         *
         * @return  self
         */ 
        public function setUserField($userField)
        {
                $this->userField = $userField;

                return $this;
        }

        /**
         * Get the value of userField
         */ 
        public function getUserField()
        {
                return $this->userField;
        }

    }
    