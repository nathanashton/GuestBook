<?php
error_reporting(0);
include ("../config/database.class.php");
include ("../objects/guest.class.php");
include ("../objects/suburb.class.php");

$database = new Database();
$db = $database->getConnection();

$originalOption = new Guest($db);

if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $originalOption->Id = $id;
    $originalOption->selectById();
}

if (isset($_POST['update']))
{
    $updatedOption = new Guest($db);
    $updatedOption->Id = $_POST['id'];
    $updatedOption->FirstName = $_POST['firstname'];
    $updatedOption->LastName = $_POST['lastname'];
    $updatedOption->Email = $_POST['email'];
    $updatedOption->Gender = $_POST['gender'];

    $updatedOption->Address = $_POST['address'];
    $updatedOption->Suburb_Id = $_POST['suburb'];

    if ($updatedOption->update() == true)
    {
        header("location:guest.php");
    } else
    {
        echo "<script>alert('There was an error updating this item');window.location = 'guest.php' </script>";
    }
}

if (isset($_POST['delete'])) {
    $updatedOption = new Guest($db);
    $updatedOption->Id = $_POST['id'];

    if($updatedOption->delete() == true)
    {
        header("location:../logout.php");
    } else
    {
        echo "<script>alert('There was an error deleting this item');window.location = 'logout.php' </script>";
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
<form method="post" action="editmydetails.php" id="editform" role="form">
    <div class="modal-body">
        <div class="form-group">
            <input type="hidden" id="id" name="id" value="<?php echo $originalOption->Id?>"/>
            <label for="name">First Name
                <input class="form-control" type="text" id="firstname" name="firstname" value="<?php echo $originalOption->FirstName?>"/>
            </label>
        </div>
        <div class="form-group">
            <label>Last Name
                <input class="form-control" type="text" id="lastname" name="lastname" value="<?php echo $originalOption->LastName?>"/>
            </label>
        </div>
        <div class="form-group">
            <label>Email
                <input class="form-control" type="email" id="email" name="email" value="<?php echo $originalOption->Email?>"/>
            </label>
        </div>
        <div class="form-group">
            <label>Gender
                <input class="form-control" type="text" id="gender" name="gender" value="<?php echo $originalOption->Gender?>"/>
            </label>
        </div>
        <div class="form-group">
            <label>Address
                <input class="form-control" type="text" id="address" name="address" value="<?php echo $originalOption->Address?>"/>
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
                    if ($originalOption->Suburb_Id == $Id)
                    {
                        echo "<option value='{$Id}' selected='selected'>{$Suburb} {$Postcode}</option>";

                    } else
                    {
                        echo "<option value='{$Id}'>{$Suburb} {$Postcode}</option>";
                    }
                }
                ?>
            </select>

        </div>

    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary" name="update" value="Update" />&nbsp;
        <input type="submit" class="btn btn-danger" name="delete" value="Delete" />&nbsp;
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
                }
            }
        });
    });
</script>
