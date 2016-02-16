<?php
error_reporting(0);
include ('login.php');

if(isset($_SESSION['loggedin']) && $_SESSION['accesslevel']){
  header("location: pages/main.php");
} elseif (isset($_SESSION['loggedin'])) {
    header("location: pages/guest.php");
}

?>
<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Octavian's Pizza Restaurant</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
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

<div class="container">
    <h2 class="text-center">Octavian's Pizza Restaurant</h2>
    <form class="form-signin" action="" method="get" >
        <label for="inputEmail" class="sr-only">Email address</label>
        <input style='text-transform:uppercase' type="text" name="code" id="inputEmail" class="form-control text-center" placeholder="Access Code" required autofocus>
        <br/>
        <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <span><h4><?php echo $error; ?></h4><br/></span>

        <h5>STAFF - Demo staff login</h5>
    </form>
    <button name="new" class="btn btn-lg btn-primary center-block" data-toggle='modal' data-target='#addModal'>I'm a new Customer</button>

</div> <!-- /container -->


<script>
    $('#addModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);
        var dataString = 'id=' + recipient;

        $.ajax({
            type: "GET",
            url: "pages/addme.php",
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

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
</html>
