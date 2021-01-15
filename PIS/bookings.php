<?php
    session_start();
    include "dbconnect.php";
    if(isset($_SESSION["agent"])){
        $role="agent";
        $uid=$_SESSION["agent"];
    }
    else if(isset($_SESSION["user"])){
        $role="user";
        $uid=$_SESSION["user"];
    }
    else {
        header("location: index.php");
    }
    $query="SELECT * FROM `permissions` WHERE `role`='$role' AND `permsn`='bookings'";
    $result=mysqli_query($db,$query);
    $row=mysqli_fetch_array($result);
    if(!$row){
        header("location: index.php");
    }
    if(isset($_GET["cancel"])){
        $id=$_GET["cancel"];
        $query="DELETE FROM `bookings` WHERE `userid`='$uid' AND `id`=$id";
        mysqli_query($db,$query);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Buses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="details">
    <div class="table">
            <h2 style="text-align:center;">Bookings</h2><br>
            <table>
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th>No. of Seats</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Departure time</th>
                    <th>Arrival time</th>
                    <th>Action</th>
                </tr>
                <?php
                    $query="SELECT * FROM `routes` R, `bookings` B WHERE R.`id`=B.`id` AND B.`userid`='$uid'";
                    $result=mysqli_query($db,$query);
                    while($row=mysqli_fetch_array($result)){
                        echo
                        '<tr>
                            <td>'.$row["id"].'</td>
                            <td>'.$row["from"].'</td>
                            <td>'.$row["to"].'</td>
                            <td>'.$row["nos"].'</td>
                            <td>'.$row["price"].'</td>
                            <td>'.$row["type"].'</td>
                            <td>'.$row["dtime"].'</td>
                            <td>'.$row["atime"].'</td>
                            <td><a href="bookings.php?cancel='.$row["id"].'">Cancel</a></td>
                        </tr>';
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>