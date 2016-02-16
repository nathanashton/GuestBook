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

include ('../objects/access.class.php');

include('../header.php');
?>


<h3>Access</h3>
<br/>
<!-- Modal -->
<div class="modal fade" id="editstaffModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Access</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editguestModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Access</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addstaffModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Access</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addguestModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="memberModalLabel">Access</h4>
            </div>
            <div class="dash" id="modalData">
            </div>

        </div>
    </div>
</div>

<link href="../css/bootstrap.min.css" rel="stylesheet"/>

<a class='btn btn-small btn-primary' data-toggle='modal' data-target='#addstaffModal'>Add Staff Access</a>
<br/>
<br/>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Staff Access Codes</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Staff Member</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $access = new Access($db);
                    $stmt = $access->selectAllWithStaffAccess();
                    while ($row_access = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row_access);
                        echo "<tr>";
                        echo "<td>{$Code}</td>";
                        echo "<td>{$FirstName} {$LastName}</td>";
                        echo "<td><a class='btn btn-small btn-primary' data-toggle='modal' data-target='#editstaffModal' data-whatever='{$Id}'>Edit</a></td>";
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<a class='btn btn-small btn-primary' data-toggle='modal' data-target='#addguestModal'>Add Guest Access</a>
<br/>
<br/>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Guest Access Codes</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Guest</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $access = new Access($db);
                    $stmt = $access->selectAllWithGuestAccess();
                    while ($row_access = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row_access);
                        echo "<tr>";
                        echo "<td>{$Code}</td>";
                        echo "<td>{$FirstName} {$LastName}</td>";
                        echo "<td><a class='btn btn-small btn-primary' data-toggle='modal' data-target='#editguestModal' data-whatever='{$Id}'>Edit</a></td>";
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
            url: "editaccess.php",
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

    $('#addstaffModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "addstaffaccess.php",
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

    $('#addguestModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "addguestaccess.php",
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

    $('#editstaffModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "editstaffaccess.php",
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

    $('#editguestModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "editguestaccess.php",
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
