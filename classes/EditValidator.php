<?php

    class EditValidator extends Validator
    {
        private $name;
        private $surname;
        private $nickname;
        private $password;
        private $repassword;
        private $email;
        private $country;
        private $avatar;
        private $avatarUrl;

        public function __construct()
        {
            parent::__construct();
            $this->name = trim($_POST['nameRegister']);
            $this->surname = trim($_POST['surnameRegister']);
            $this->nickname = trim($_POST['nicknameRegister']);
            $this->password = trim($_POST['passwordRegister']);
            $this->repassword = trim($_POST['repassword']);
            $this->email = trim($_POST['emailRegister']);
            $this->country = $_POST['countryRegister'];
        }

        
        public function isValid()
        {   
            //Almacenamos el campo avatar solo si el usuario quiere editarlo.
            if ( count($_FILES) != 0) {
                $this->avatar = $_FILES['avatarRegister'];
           
                // Validamos la subida si el usuario eligió un nuevo avatar.
                if ($this->avatar['error'] = UPLOAD_ERR_OK) {
           
                  $extension = pathinfo($this->avatar['name'], PATHINFO_EXTENSION);
           
                  if (!in_array($extension, ALLOWED_FORMAT_IMAGE)) {
                    $this->setError('avatar', 'Revise el formato de la imagen');
                  }
                }
              }

            
            if (empty($this->name)) {
                $this->setError('name', 'El campo nombre es OBLIGATORIO');
            }

            if (empty($this->surname)) {
                $this->setError('surname', 'El campo apellido es OBLIGATORIO');
            }

            if (empty($this->nickname)) {
                $this->setError('nickname', 'El campo usuario es OBLIGATORIO');
                
            }elseif(DB::checkUserExist($this->nickname) && $this->nickname != $_SESSION['userLoged']['nickname']){
                $this->setError('nickname', 'El nombre de usuario ya existe en nuestra base de datos' );
            } 

            if (empty($this->email)) {
                $this->setError('email', 'El campo email es OBLIGATORIO');
            } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->setError('email', 'El formato de email no es válido');
            } elseif ( $this->email != $_SESSION['userLoged']['email'] ) {
                if ( DB::checkEmailExist($this->email) ) {
                $this->setError('email', 'El email ingresado ya existe en nuestra base de datos');
                }
            }  

            /*
            Solo validamos los campos password si el usuario decide cambiar su contraseña.
            No validamos si está vacío, ya que si no quiere cambiar la contraseña
            lo va a dejar vacío y no seteamos el error.
            */

            if ( $this->password != "" ) {
                if ( strlen($this->password) < 5 ) {
                $this->setError('password', 'La contraseña debe tener más de 5 caracteres');
                } elseif ( strpos($this->password, 'DH') === false ) {
                $this->setError('password', 'recuerde que su contraseña debe incluir DH');
                } elseif ( $this->password != $this->repassword ) {
                $this->setError('password', 'Las contraseñas ingresadas deben coincidir ');
                $this->setError('repassword', 'Las contraseñas ingresadas deben coincidir ');
                } elseif ( strpos($this->password, " ") !== false ) {
                $this->setError('password', 'La contraseña no puede contener espacios');
                }

            }

            if (empty($this->country)) {
                $this->setError('country', 'Debe seleccionar un país');
            }
        }

        public function setPassword()
        {
            if ( $this->password != "" ) {
                $this->password = password_hash( $this->password, PASSWORD_DEFAULT );
            } else {
                $this->password = $_SESSION['userLoged']['password'];
            }
        }

        public function setAvatarUrl()
        {
            /*
            si el usuario eligió un nuevo avatar, vamos a almacenar el valor para luego reemplazar su antiguo avatar
            */
            
                $this->avatarUrl = $_SESSION['userLoged']['avatar'];
                //aca se guarda el nuevo avatar, PERO EL ANTERIOR NO SE ELIMINA DE LA CARPETA DATA
            
        }

        public function setNewAvatarUrl($url)
        {
            $this->avatarUrl = $url;
        }


        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Get the value of surname
         */ 
        public function getSurname()
        {
                return $this->surname;
        }

        /**
         * Get the value of nickname
         */ 
        public function getNickname()
        {
                return $this->nickname;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Get the value of country
         */ 
        public function getCountry()
        {
                return $this->country;
        }

        /**
         * Get the value of avatarUrl
         */ 
        public function getAvatarUrl()
        {
                return $this->avatarUrl;
        }
    }
    