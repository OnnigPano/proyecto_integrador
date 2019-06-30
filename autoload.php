<?php

    define('ALLOWED_FORMAT_IMAGE', ['jpg','jpeg','png']);
    define('IMAGE_FILE_PATH', dirname(__FILE__) . '/data/avatars/');
    define('JSON_USERS_PATH', dirname(__FILE__) . '/data/users.json');

    require_once('classes/DB.php');
    require_once('classes/Validator.php');
    require_once('classes/RegisterValidator.php');
    require_once('classes/LoginValidator.php');