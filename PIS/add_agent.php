<?php
    session_start();
    if(!isset($_SESSION["admin"])){
        header("location: index.php");
    }
    $wrong="";
    $right="";
    if(isset($_POST["submit"])){
        include "dbconnect.php";
        $uid=$_POST["uid"];
        $eid=$_POST["eid"];
        $pass=$_POST["pass"];
        $query="SELECT * FROM `users` WHERE `userid`='$uid'";
        $result=mysqli_query($db,$query);
        $row=mysqli_fetch_array($result);
        if($row){
            $wrong="* User ID is already taken";
        }else {
            $insert="INSERT INTO `users`(`userid`, `email`, `password`, `role`) VALUES ('$uid','$eid','$pass','agent')";
            mysqli_query($db,$insert);
            $right="Agent is Successfully Added";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Agent</title>
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
        <div class="form-box">
            <br><br><br><br>
            <h2 style="text-align:center;">Add Agent</h2>
            <form id="change" class="input-group" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input class="input-field" placeholder="User ID" name="uid" required>
                <input type="email" class="input-field" placeholder="Email-id" name="eid" required>
                <input type="password" class="input-field" placeholder="Enter password" name="pass" required>
                <button type="submit" class="submit-button" name="submit">Add</button>
                <div class="wrong"><?php echo($wrong); ?></div>
                <div class="right"><?php echo($right); ?></div>
            </form>
        </div>
    </div>
</body>
</html>