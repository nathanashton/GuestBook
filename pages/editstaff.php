<?php
error_reporting(0);
include ("../config/database.class.php");
include ("../objects/staff.class.php");

$database = new Database();
$db = $database->getConnection();

$originalOption = new Staff($db);


if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $originalOption->Id = $id;
    $originalOption->selectById();
}

if (isset($_POST['update']))
{
    $updatedOption = new Staff($db);
    $updatedOption->Id = $_POST['id'];
    $updatedOption->FirstName = $_POST['firstname'];
    $updatedOption->LastName = $_POST['lastname'];

    if ($updatedOption->update() == true)
    {
        header("location:staff.php");
    } else
    {
        echo "<script>alert('There was an error updating this item');window.location = 'staff.php' </script>";
    }
}

if (isset($_POST['delete'])) {
    $updatedOption = new Staff($db);
    $updatedOption->Id = $_POST['id'];

    if($updatedOption->delete() == true)
    {
        header("location:staff.php");
    } else
    {
        echo "<script>alert('There was an error deleting this item');window.location = 'staff.php' </script>";
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
<form method="post" action="editstaff.php" id="editform" role="form">
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
