<nav class="navbar navbar-default">
    <div class="container-fluid">

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><img src="../pizza.png" width="40" height="40"/></li>
                <li><a href="main.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="comments.php">Comments</a></li>
                <li><a href="guests.php">Guests</a></li>
                <li><a href="staff.php">Staff</a></li>
                <li><a href="access.php">Access</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a><?php echo "Logged in as ".$_SESSION['name']. " [STAFF]";?></a></li>
                <li><a href="../logout.php">Log Out</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>