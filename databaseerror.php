<?php
error_reporting(0);
include('header.php');

echo "
<link href='css/bootstrap.min.css' rel='stylesheet'>
<link href='css/navbar.css' rel='stylesheet'>
<br/>
<img class='img-responsive center-block' src='pizza.png'/>
<br/>
<h3 class='text-center'>Oops! There has been a problem. Please try logging in again.</h3>
<br/>
<a href='index.php' name='new' class='btn btn-lg btn-primary center-block'>Retry</a>";
include('footer.php');
?>