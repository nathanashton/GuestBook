<?php
error_reporting(0);
session_start();
include ("../config/database.class.php");
include ("../objects/rating.class.php");
include ("../objects/menuoption.class.php");

$database = new Database();
$db = $database->getConnection();

if (isset($_POST['add']))
{
    $updatedOption = new Rating($db);
    $updatedOption->Rating = $_POST['rating'];
    $updatedOption->Comment = $_POST['comment'];
    $updatedOption->Guest_Id = $_SESSION['id'];
    $updatedOption->MenuOption_Id = $_POST['menuitemid'];


    if ($updatedOption->insert() == true)
    {
        header("location:guest.php");
    } else
    {
        echo "<script>alert('There was an error adding this item');window.location = 'guest.php' </script>";
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
<form method="post" action="addrating.php" id="editform" role="form">
    <div class="modal-body">
        <div class="form-group">

            <div class="form-group">
                <label>Rating
                    <input id="rating" name="rating" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" >
                </label>
            </div>
        </div>
        <div class="form-group">
            <label>Comment
                <input class="form-control"  type="text" id="comment" name="comment" required/>
            </label>
        </div>

        <div class="form-group">
            <label>Menu Item
                <select class="form-control" name="menuitemid" id="menuitemid">
                    <?php
                    $menuItem = new MenuOption($db);
                    $stmt = $menuItem->selectAll();
                    while ($row_menuItem = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row_menuItem);
                        echo "<option value='{$Id}'>{$MenuItem}</option>";
                    }
                    ?>
                </select>
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
                rating: {
                    required: true,
                    number: true
                },
                comment: {
                    required: true,
                },
                menuitemid: {
                    required: true,
                }
            }
        });
    });
</script>
