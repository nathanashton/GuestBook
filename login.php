<?php
error_reporting(0);
include 'config/database.class.php';
include 'objects/login.class.php';

$database = new Database();
$db = $database->getConnection();

$error='';

    if (empty($_GET['code'])) {
        $error = "Please enter an access code";
    }
    else
    {
        $code = $_GET['code'];

        $login = new Login($db);

        if ($login->login($code) == false)
        {
            $error = "Access code is invalid";
        }
    }

?>