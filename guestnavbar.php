<nav class="navbar navbar-default">
    <div class="container-fluid">

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><img src="../pizza.png" width="40" height="40"/></li>
                <li><a href="guest.php">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a><?php echo "Logged in as ".$_SESSION['name']. " [Guest]";?></a></li>
                <li><a href="../logout.php">Log Out</a></></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>