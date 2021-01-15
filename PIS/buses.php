<?php
    session_start();
    include "dbconnect.php";
    if(isset($_SESSION["agent"])){
        $role="agent";
    }
    else if(isset($_SESSION["user"])){
        $role="user";
    }
    else {
        header("location: index.php");
    }
    $query="SELECT * FROM `permissions` WHERE `role`='$role' AND `permsn`='buses'";
    $result=mysqli_query($db,$query);
    $row=mysqli_fetch_array($result);
    if(!$row){
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="details">
        <div class="table">
            <h2 style="text-align:center;">Buses</h2><br>
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
                </tr>
                <?php
                    $query="SELECT * FROM `routes`";
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
                        </tr>';
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>