<?php
    session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["agent"]) && !isset($_SESSION["admin"])){
        header("location: index.php");
    }
    $wrong="";
    $right="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "dbconnect.php";
        if(isset($_SESSION["user"])){
            $uid=$_SESSION["user"];
        }else if(isset($_SESSION["agent"])){
            $uid=$_SESSION["agent"];
        }else if(isset($_SESSION["admin"])){
            $uid=$_SESSION["admin"];
        }
        $cpass=$_POST["cp"];
        $npass=$_POST["np"];
        $query="SELECT `password` FROM `users` WHERE `userid`='$uid'";
        $result=mysqli_query($db,$query);
        $row=mysqli_fetch_array($result);
        if($row["password"]==$cpass){
            $update="UPDATE `users` SET `password`='$npass' WHERE `userid`='$uid'";
            mysqli_query($db,$update);
            $right="Password is Successfully Updated";
        }else {
            $wrong="* Password is Wrong";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
        <div><a href="logout.php">Log out</a></div>
        <div><a href="change_pass.php">Change Password</a></div>
    </header>
    <div class="details">
        <div class="form-box">
            <br><br><br>
            <h2 style="text-align:center;">Change Password</h2>
            <form id="change" class="input-group" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input class="input-field" type="password" placeholder="Current Password" name="cp" required>
                <input class="input-field" type="password" placeholder="New Password" name="np" required>
                <button type="submit" class="submit-button">Update</button>
                <div class="wrong"><?php echo($wrong); ?></div>
                <div class="right"><?php echo($right); ?></div>
            </form>
        </div>
    </div>
</body>
</html>