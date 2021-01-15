<?php
    session_start();
    if(!isset($_SESSION["admin"])){
        header("location: index.php");
    }
    include "dbconnect.php";
    if(isset($_GET["role"]) && isset($_GET["permsn"])){
        $role=$_GET["role"];
        $permsn=$_GET["permsn"];
        $delete="DELETE FROM `permissions` WHERE `role`='$role' AND `permsn`='$permsn'";
        mysqli_query($db,$delete);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $role=$_POST["role"];
        $permsn=$_POST["permsn"];
        $insert="INSERT INTO `permissions`(`role`, `permsn`) VALUES ('$role','$permsn')";
        mysqli_query($db,$insert);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permissions</title>
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
        <div class="box">
            <br><br><br>
            <h2 style="text-align:center;">User Permissions</h2><br>
            <table>
                <tr>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
                <?php
                    $query="SELECT * FROM `permissions` WHERE `role`='user'";
                    $result=mysqli_query($db,$query);
                    while($row=mysqli_fetch_array($result)){
                        echo
                        '<tr>
                            <td>'.$row["permsn"].'</td>
                            <td><a href="permissions.php?role=user&permsn='.$row["permsn"].'">Remove</a></td>
                        </tr>';
                    }
                ?>
            </table>
        </div>
        <div class="box">
            <br><br><br>
            <h2 style="text-align:center;">Agent Permissions</h2><br>
            <table>
                <tr>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
                <?php
                    $query="SELECT * FROM `permissions` WHERE `role`='agent'";
                    $result=mysqli_query($db,$query);
                    while($row=mysqli_fetch_array($result)){
                        echo
                        '<tr>
                            <td>'.$row["permsn"].'</td>
                            <td><a href="permissions.php?role=agent&permsn='.$row["permsn"].'">Remove</a></td>
                        </tr>';
                    }
                ?>
            </table>
        </div>
        <div class="box">
            <br><br><br>
            <h2 style="text-align:center;">Add Permissions</h2>
            <form id="change" class="input-group" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input class="input-field" placeholder="Role" name="role" required>
                <input class="input-field" placeholder="Permission" name="permsn" required>
                <button type="submit" class="submit-button">Add</button>
            </form>
        </div>
    </div>
</body>
</html>