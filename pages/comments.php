<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['accesslevel'] != 1)
{
    header("Location: ../index.php");
}

include '../config/database.class.php';

$database = new Database();
$db = $database->getConnection();

include ('../objects/menuoption.class.php');
include ('../objects/rating.class.php');


include('../header.php');
?>

<h3>Guest Comments</h3>
<br/>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Menu Item</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
</div>

<link href="../css/bootstrap.min.css" rel="stylesheet"/>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Guest Comments</h3>

            </div>
            <div class="panel-body">
                <div class="panel-heading">

                </div>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Rating</th>
                        <th>Menu Item</th>
                        <th>Comment</th>
                        <th>Guest</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $rating = new Rating($db);
                    $stmt = $rating->selectAll();
                    while ($row_rating = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row_rating);
                        echo "<tr>";
                        echo "<td>{$Rating}</td>";
                        echo "<td>{$MenuItem}</td>";
                        echo "<td>{$Comment}</td>";
                        echo "<td>{$FirstName} {$LastName}</td>";


                        echo "<td><a class='btn btn-small btn-primary' data-toggle='modal' data-target='#editModal' data-whatever='{$Id}'>Edit</a></td>";
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script src="../js/jquery-2.1.3.min.js"/>
<script src="../js/bootstrap.min.js"/>


<?php
include('../footer.php');
?>
<script>
    $('#editModal').on('show.bs.modal', function (event) {
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
