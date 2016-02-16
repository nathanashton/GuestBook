<?php
error_reporting(0);
include ("../config/database.class.php");
include ("../objects/menuoption.class.php");

$database = new Database();
$db = $database->getConnection();

if (isset($_POST['add']))
{
    $updatedOption = new MenuOption($db);
    $updatedOption->MenuItem = $_POST['menuitem'];
    $updatedOption->MenuItemPrice = $_POST['menuitemprice'];

    if ($updatedOption->insert() == true)
    {
        header("location:menu.php");
    } else
    {
        echo "<script>alert('There was an error adding this item');window.location = 'menu.php' </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <script src="../js/jquery-2.1.3.min.js"></script>
    <script src="../js/jquery.validate.js"></script>

    <link href="../css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<form method="post" action="addmenu.php" id="editform" role="form">
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Menu Item
                <input class="form-control" type="text" id="menuitem" name="menuitem" required/>
            </label>
        </div>
        <div class="form-group">
            <label>Menu Item Price
                <input class="form-control" type="text" id="menuitemprice" name="menuitemprice" required/>
            </label>
        </div>
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary" name="add" value="Add" />&nbsp;
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
</body>
</html>

<script>
    $().ready(function() {
        $("#editform").validate({
            rules: {
                menuitem: {
                    required: true
                },
                menuitemprice: {
                    required: true,
                    number: true
                }
            }
        });
    });
</script>
