<?php

    $dsn = 'mysql:host=localhost;dbname=digital_store;port=3306';
    $db_user= '';
    $db_pass = '';
    $opt = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
    

    try {
        $db = new PDO($dsn, $db_user, $db_pass, $opt);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die('Error en la base de datos');
    }