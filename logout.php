<?php
    error_reporting(0);
    include 'config/database.class.php';
    include 'objects/login.class.php';

    $database = new Database();
    $db = $database->getConnection();

    $login = new Login($db);
    $login->logout();
?>