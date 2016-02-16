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

include ('../objects/guest.class.php');
include('../header.php');

?>


<h3>Guests</h3>
<br/>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Edit Guest</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Add Guest</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
</div>

<link href="../css/bootstrap.min.css" rel="stylesheet"/>

<a class='btn btn-small btn-primary' data-toggle='modal' data-target='#addModal'>Add</a>
<br/>
<br/>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Guests (by suburb)</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Suburb</th>
                        <th>Rating</th>


                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $guests = new Guest($db);
                    $stmt = $guests->selectAllGroupSuburb();
                    while ($row_menuItem = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row_menuItem);
                        echo "<tr>";
                        echo "<td>{$FirstName}</td>";
                        echo "<td>{$LastName}</td>";
                        echo "<td>{$Email}</td>";
                        echo "<td>{$Suburb}</td>";
                        echo "<td>{$Rating}</td>";


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
            url: "editguest.php",
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

    $('#addModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "addguest.php",
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
