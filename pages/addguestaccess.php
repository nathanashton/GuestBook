<?php
error_reporting(0);
include ("../config/database.class.php");
include ("../objects/access.class.php");
include ("../objects/guest.class.php");

$database = new Database();
$db = $database->getConnection();


if (isset($_POST['add']))
{
    $updatedOption = new Access($db);
    $updatedOption->Code = $_POST['code'];
    $updatedOption->Staff = '';
    $updatedOption->Staff_Id = NULL;
    $updatedOption->Guest_Id = $_POST['guestid'];

print_r($updatedOption);

    if ($updatedOption->insert() == true)
    {
        header("location:access.php");
    } else
    {
        echo "<script>alert('There was an error adding this item');window.location = 'access.php' </script>";
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
<form method="post" action="addguestaccess.php" id="editform" role="form">
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Access Code
                <input class="form-control" type="text" id="code" name="code"/>
            </label>
        </div>
        <div class="form-group">
            <label>Guest</label>
            <select class="form-control" name="guestid" id="guestid">

                <?php
                $guest = new Guest($db);
                $stmt = $guest->selectAll();
                while ($row_guest = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row_guest);
                    {
                        echo "<option value='{$Id}'>{$FirstName} {$LastName}</option>";
                    }
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
                guestid: {
                    required: true
                },
                code: {
                    required: true,
                }
            }
        });
    });
</script>
