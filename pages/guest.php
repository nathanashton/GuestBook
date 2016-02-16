<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['loggedin']))
{
    header("Location: ../index.php");
}

include '../config/database.class.php';
$database = new Database();
$db = $database->getConnection();

include ('../objects/guest.class.php');
include ('../objects/rating.class.php');


$guest = new Guest($db);
$guest->Id = $_SESSION['id'];
$guest->selectById();

include('../header.php');
?>
<!-- Modal -->
<div class="modal fade" id="myDetails" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">My Details</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addComment" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">


                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Add Comment</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="editComment" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Edit Comment</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <h3><?php echo "Your access code: ".$_SESSION['loggedin'];?></h3>

        <h3><?php echo "$guest->FirstName $guest->LastName"?></h3>
        <p><?php echo "$guest->Gender"?></p>
        <p><?php echo "$guest->Email"?></p>
        <p><?php echo "$guest->Address"?></p>
        <p><?php echo "$guest->Suburb $guest->Postcode"?></p>
    </div>
    <div class="panel-footer">
        <a class='btn btn-small btn-primary' data-toggle='modal' data-target='#myDetails' data-whatever="<?php echo $guest->Id?>">Edit My Details</a>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">My Comments</h3>

            </div>
            <div class="panel-body">
                <div class="panel-heading">
                    <a class='btn btn-small btn-primary' data-toggle='modal' data-target='#addComment'>Add Comment</a>

                </div>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Rating</th>
                        <th>Menu Item</th>
                        <th>Comment</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $rating = new Rating($db);
                    $rating->Guest_Id = $_SESSION['id'];
                    $stmt = $rating->selectAllByGuestId();
                    while ($row_rating = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row_rating);
                        echo "<tr>";
                        echo "<td>{$Rating}</td>";
                        echo "<td>{$MenuItem}</td>";
                        echo "<td>{$Comment}</td>";

                        echo "<td><a class='btn btn-small btn-primary' data-toggle='modal' data-target='#editComment' data-whatever='{$Id}'>Edit</a></td>";
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>




<br/>


<link href="../css/bootstrap.min.css" rel="stylesheet"/>


<br/>
<br/>

<script src="../js/jquery-2.1.3.min.js"/>
<script src="../js/bootstrap.min.js"/>


<?php
include('../footer.php');
?>
<script>
    $('#myDetails').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "editmydetails.php",
            data: dataString,
            cache: false,
            success: function (data) {
                modal.find('#modalData').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });






    $('#addComment').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "addrating.php",
            data: dataString,
            cache: false,
            success: function (data) {
                modal.find('#modalData').html(data);
            },
            error: function(err) {

                console.log(err);
            }
        });
    });
    $('#editComment').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "editrating.php",
            data: dataString,
            cache: false,
            success: function (data) {
                modal.find('#modalData').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
</script>
