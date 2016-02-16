<?php
error_reporting(0);
include ("../config/database.class.php");
include ("../objects/guest.class.php");
include ("../objects/suburb.class.php");
include ("../objects/access.class.php");
include ("../objects/login.class.php");

$database = new Database();
$db = $database->getConnection();


if (isset($_POST['add']))
{
    $updatedOption = new Guest($db);
    $updatedOption->FirstName = $_POST['firstname'];
    $updatedOption->LastName = $_POST['lastname'];
    $updatedOption->Email = $_POST['email'];
    $updatedOption->Address = $_POST['address'];
    $updatedOption->Gender = $_POST['gender'];
    $updatedOption->Suburb_Id = $_POST['suburb'];

    if ($updatedOption->insert() == true)
    {
        $access = new Access($db);
        $access->generateRandom();
        $access->Staff='';
        $access->Staff_Id = null;
        $access->Guest_Id = $updatedOption->Id;
        $access->insert();
        $login = new Login($db);
        $login->login($access->Code);

        header("location:guest.php");

    } else
    {
        echo "<script>alert('There was an error adding this item');window.location = '../index.php' </script>";
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
    <script src="../js/star-rating.min.js"></script>

    <link href="../css/star-rating.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<form method="post" action="pages/addme.php" id="editform" role="form">
    <div class="modal-body">
        <div class="form-group">
            <label for="name">First Name
                <input class="form-control" type="text" id="firstname" name="firstname" required/>
            </label>
        </div>
        <div class="form-group">
            <label>Last Name
                <input class="form-control" type="text" id="lastname" name="lastname"/>
            </label>
        </div>
        <div class="form-group">
            <label>Email
                <input class="form-control" type="email" id="email" name="email"/>
            </label>
        </div>
        <div class="form-group">
            <label>Gender
                <input class="form-control" type="text" id="gender" name="gender"/>
            </label>
        </div>
        <div class="form-group">
            <label>Address
                <input class="form-control" type="text" id="address" name="address"/>
            </label>
        </div>

        <div class="form-group">
            <label>Suburb</label>
            <select class="form-control" name="suburb" id="suburb">
                <?php
                $suburb = new Suburb($db);
                $stmt = $suburb->selectAll();
                while ($row_suburb = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row_suburb);
                    echo "<option value='{$Id}'>{$Suburb} {$Postcode}</option>";
                }
                ?>
            </select>

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
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true
                },
                address: {
                    required: true
                },
                gender: {
                    required: true
                },
                suburb: {
                    required: true
                }
            }
        });
    });
</script>
