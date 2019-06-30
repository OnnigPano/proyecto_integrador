<?php 

    class RegisterValidator extends Validator
    {
       private $name;
       private $surname;
       private $nickname;
       private $password;
       private $repassword;
       private $email;
       private $country;
       private $avatar;

       public function __construct()
       {
            parent::__construct();
            $this->name = isset($_POST['nameRegister']) ?  trim($_POST['nameRegister']) : null;
            $this->surname = isset($_POST['surnameRegister']) ? trim($_POST['surnameRegister']) : null;
            $this->nickname = isset($_POST['nicknameRegister']) ? trim($_POST['nicknameRegister']) : null;
            $this->password = isset($_POST['passwordRegister']) ? trim($_POST['passwordRegister']) : null;
            $this->repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : null;
            $this->email = isset($_POST['emailRegister']) ? trim($_POST['emailRegister']) : null;
            $this->country = isset($_POST['countryRegister']) ? $_POST['countryRegister'] : null;
            $this->avatar = isset($_FILES['avatarRegister']) ? $_FILES['avatarRegister'] : null;
       }

       public function isValid()
       {    
            if (empty($this->name)) {
                $this->setError('name', 'El campo nombre es OBLIGATORIO');
            }

            if (empty($this->surname)) {
                $this->setError('surname', 'El campo apellido es OBLIGATORIO');
            }

            if (empty($this->nickname)) {
                $this->setError('nickname', 'El campo usuario es OBLIGATORIO');
            } elseif(DB::checkUserExist($this->nickname)){
                $this->setError('nickname', 'El nombre de usuario ya existe en nuestra base de datos' );
            } 

            if (empty($this->email)) {
                $this->setError('email', 'El campo email es OBLIGATORIO');
            } elseif (!filter_var(($this->email), FILTER_VALIDATE_EMAIL)) {
                $this->setError('email', 'El formato de mail no es valido');
            }  elseif (DB::checkEmailExist($this->email)) {
                $this->setError('email', 'El mail ingresado ya existe en nuestra base de datos');
            } 

            if (empty($this->password)) {
                $this->setError('password', "El campo password es OBLIGATORIO");;
                } elseif ( strlen($this->password) < 5 ) {
                $this->setError('password', "La contraseña debe tener más de 5 caracteres");
                } elseif ( strpos($this->password, 'DH') === false ) {
                $this->setError('password', "Recuerde que su contraseña debe incluir DH");
                } elseif ( $this->password != $this->repassword ) {
                $this->setError('password', "Las contraseñas ingresadas deben coincidir");
                $this->setError('repassword', "Las contraseñas ingresadas deben coincidir");
                } elseif ( strpos($this->password, " ") !== false ) {
                $this->setError('password', "La contraseña no puede contener espacios");
                }

            if (empty($this->repassword)) {
                $this->setError('repassword', "Debe reingresar la contraseña");
                }

            if (empty($this->country)) {
                $this->setError('country', "Debe seleccionar un país");
            }

            if ($this->avatar['error'] != UPLOAD_ERR_OK) {
                $this->setError('avatar', 'Subí una imagen');
            } else {
                $extension = pathinfo($this->avatar['name'], PATHINFO_EXTENSION);

                if (!in_array($extension,ALLOWED_FORMAT_IMAGE)) {
                    $this->setError('avatar', 'Revise el formato de la imagen');
                }
            }

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

      
     }