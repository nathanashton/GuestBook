<?php
error_reporting(0);
session_start();
include ("../config/database.class.php");
include ("../objects/rating.class.php");
include ("../objects/menuoption.class.php");

$database = new Database();
$db = $database->getConnection();

$originalOption = new Rating($db);

if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $originalOption->Id = $id;
    $originalOption->selectById();
}

if (isset($_POST['update']))
{
    $updatedOption = new Rating($db);
    $updatedOption->Id = $_POST['id'];
    $updatedOption->Rating = $_POST['rating'];
    $updatedOption->Comment = $_POST['comment'];
    $updatedOption->Guest_Id = $_POST['guestid'];
    $updatedOption->MenuOption_Id = $_POST['menuitemid'];

    if ($updatedOption->update() == true)
    {
        if ($_SESSION['accesslevel'] == 1)
        {
            header("location:comments.php");

        } else
        {
            header("location:guest.php");
        }
    } else
    {
        if ($_SESSION['accesslevel'] == 1)
        {
            echo "<script>alert('There was an error updating this item');window.location = 'comments.php' </script>";

        } else
        {
            echo "<script>alert('There was an error updating this item');window.location = 'guest.php' </script>";
        }
    }
}


if (isset($_POST['delete'])) {
    $updatedOption = new Rating($db);
    $updatedOption->Id = $_POST['id'];

    if($updatedOption->delete() == true)
    {
        if ($_SESSION['accesslevel'] == 1)
        {
            header("location:comments.php");

        } else
        {
            header("location:guest.php");
        }
    } else
    {
        if ($_SESSION['accesslevel'] == 1)
        {
            echo "<script>alert('There was an error deleting this item');window.location = 'comments.php' </script>";

        } else
        {
            echo "<script>alert('There was an error deleting this item');window.location = 'guest.php' </script>";
        }
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



<form method="post" action="editrating.php" id="editform" role="form">
    <div class="modal-body">
        <div class="form-group">
            <input type="hidden" id="id" name="id" value="<?php echo $originalOption->Id?>"/>
            <input type="hidden" id="guestid" name="guestid" value="<?php echo $originalOption->Guest_Id?>"/>

            <div class="form-group">
                <label>Star
                    <input id="rating" name="rating" value="<?php echo $originalOption->Rating?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" >
                </label>
            </div>
        </div>
        <div class="form-group">
            <label>Comment
                <input class="form-control" type="text" id="comment" name="comment" value="<?php echo $originalOption->Comment?>"/>
            </label>
        </div>

        <div class="form-group">
            <label>Menu Item </label>
                <select class="form-control" name="menuitemid" id="menuitemid">
                    <?php
                    $menuItem = new MenuOption($db);
                    $stmt = $menuItem->selectAll();
                    while ($row_menuItem = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row_menuItem);
                        if ($originalOption->MenuOption_Id == $Id)
                        {
                            echo "<option value='{$Id}' selected='selected'>{$MenuItem}</option>";

                        } else
                        {
                            echo "<option value='{$Id}'>{$MenuItem}</option>";
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
                menuitemid: {
                    required: true
                },
                rating: {
                    required: true
                },
                comment : {
                    required: true
                }
            }
        });
    });
</script>
