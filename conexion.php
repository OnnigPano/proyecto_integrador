<?php
$dsn = "mysql:host=localhost;dbname=digital_store;port=3306";
$opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$base = new PDO($dsn, 'root', 'mandioca', $opt);
