<?php
error_reporting(0);
include ("../config/database.class.php");
include ("../objects/access.class.php");
include ("../objects/guest.class.php");

$database = new Database();
$db = $database->getConnection();

$originalOption = new Access($db);

if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $originalOption->Id = $id;
    $originalOption->selectById();
}

if (isset($_POST['update']))
{
    $updatedOption = new Access($db);
    $updatedOption->Id = $_POST['id'];
    $updatedOption->Code = $_POST['code'];
    $updatedOption->Staff_Id = null;
    $updatedOption->Staff = '';
    $updatedOption->Guest_Id = $_POST['guestid'];

    if ($updatedOption->update() == true)
    {
        header("location:access.php");
    } else
    {
        echo "<script>alert('There was an error updating this item');window.location = 'access.php' </script>";
    }
}

if (isset($_POST['delete'])) {
    $updatedOption = new Access($db);
    $updatedOption->Id = $_POST['id'];

    if($updatedOption->delete() == true)
    {
        header("location:access.php");
    } else
    {
        echo "<script>alert('There was an error deleting this item');window.location = 'access.php' </script>";
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
<form method="post" action="editguestaccess.php" id="editform" role="form">
    <input type="hidden" id="id" name="id" value="<?php echo $originalOption->Id?>"/>
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Access Code
                <input class="form-control" type="text" id="code" name="code" value="<?php echo $originalOption->Code?>"/>
            </label>
        </div>
        <div class="form-group">
            <label>Staff</label>
            <select class="form-control" name="guestid" id="guestid">

                <?php
                $access = new Guest($db);
                $stmt = $access->selectAll();
                while ($row_access = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row_access);
                    if ($originalOption->Guest_Id == $Id)
                    {
                        echo "<option value='{$Id}' selected='selected'>{$FirstName} {$LastName}</option>";

                    } else
                    {
                        echo "<option value='{$Id}'>{$FirstName} {$LastName}</option>";
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
                guestid: {
                    required: true
                },
                code: {
                    required: true
                }
            }
        });
    });
</script>
