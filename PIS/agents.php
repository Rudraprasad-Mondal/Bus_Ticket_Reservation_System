<?php
    session_start();
    if(!isset($_SESSION["admin"])){
        header("location: index.php");
    }
    include "dbconnect.php";
    if(isset($_GET["uid"])){
        $uid=$_GET["uid"];
        $query="DELETE FROM `users` WHERE `userid`='$uid'";
        mysqli_query($db,$query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agents</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <ul>
            <li><a href="add_agent.php">Add Agent</a></li>
            <li><a href="agents.php">Agents</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="permissions.php">Permissions</a></li>
        </ul>
        <div><a href="logout.php">Log out</a></div>
        <div><a href="change_pass.php">Change Password</a></div>
    </header>
    <div class="details">
        <div class="table">
            <h2 style="text-align:center;">Agents</h2><br>
            <table>
                <tr>
                    <th>Sl. No.</th>
                    <th>User ID</th>
                    <th>Email ID</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                <?php
                    $query="SELECT * FROM `users` WHERE `role`='agent'";
                    $result=mysqli_query($db,$query);
                    $sl=0;
                    while($row=mysqli_fetch_array($result)){
                        $sl++;
                        echo
                        '<tr>
                            <td>'.$sl.'</td>
                            <td>'.$row["userid"].'</td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["role"].'</td>
                            <td><a href="agents.php?uid='.$row["userid"].'">Remove</a></td>
                        </tr>';
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>