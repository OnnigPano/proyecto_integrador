<?php

    require_once('conexion.php');
    require_once('autoload.php');

    if ($_GET) {

        if ($_GET['import'] == true) {
            
            //METODOS PARA CARGAR LOS USUARIOS DEL JSON AL DB------------------------------------------------------
            $usersFromJson = DB::getUsersFromJson();
            DB::saveUsersFromJson($usersFromJson);

            header('location: index.php');
        }
    }