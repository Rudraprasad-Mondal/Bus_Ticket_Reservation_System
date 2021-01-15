<header>
    <ul>
        <?php
            $query="SELECT * FROM `permissions` WHERE `role`='$role'";
            $result=mysqli_query($db,$query);
            while($row=mysqli_fetch_array($result)){
                if($row["permsn"]=="search")
                echo '<li><a href="search.php">Search</a></li>';
                if($row["permsn"]=="bookings")
                echo '<li><a href="bookings.php">Bookings</a></li>';
                if($row["permsn"]=="buses")
                echo '<li><a href="buses.php">Buses</a></li>';
                if($row["permsn"]=="add_bus")
                echo '<li><a href="add_bus.php">Add Bus</a></li>';
            }
        ?>
    </ul>
    <div><a href="logout.php">Log out</a></div>
    <div><a href="change_pass.php">Change Password</a></div>
</header>