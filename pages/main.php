<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['loggedin']))
{
    header("Location: ../index.php");
}

include('../header.php');
echo "<h3>Octavian's Pizza Restaurant</h3><br/><br/>
<img class='img-responsive center-block' src='../pizza.png'/>
<br/>";
    include('../footer.php');

?>