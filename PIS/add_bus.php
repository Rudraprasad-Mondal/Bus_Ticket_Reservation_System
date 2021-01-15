<?php
    session_start();
    $wrong="";
    $right="";
    include "dbconnect.php";
    if(isset($_SESSION["agent"])){
        $role="agent";
    }
    else if(isset($_SESSION["user"])){
        $role="user";
    }
    $query="SELECT * FROM `permissions` WHERE `role`='$role' AND `permsn`='add_bus'";
    $result=mysqli_query($db,$query);
    $row=mysqli_fetch_array($result);
    if(!$row){
        header("location: index.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id=$_POST["id"];
        $from=$_POST["from"];
        $to=$_POST["to"];
        $nos=$_POST["nos"];
        $price=$_POST["price"];
        $type=$_POST["type"];
        $dtime=$_POST["dtime"];
        $atime=$_POST["atime"];
        $query="SELECT * FROM `routes` WHERE `id`='$id'";
        $result=mysqli_query($db,$query);
        $row=mysqli_fetch_array($result);
        if(!$row){
            $insert="INSERT INTO `routes`(`id`, `from`, `to`, `nos`, `price`, `type`, `dtime`, `atime`) VALUES ('$id','$from','$to','$nos','$price','$type','$dtime','$atime')";
            mysqli_query($db,$insert);
            $right="Bus is Successfully Added";
        }else {
            $wrong="* Bus ID is already present";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Bus</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body>
    <?php include "header.php"; ?>
    <div class="bus">
        <div class="form-box1">
            <div class="wrong mess"><?php echo($wrong); ?></div>
            <div class="right mess"><?php echo($right); ?></div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div id="addbus" class="input-group">
                    <h1>Add new bus:</h1><br>
                    <h3>ID</h3>
                    <input type="number" class="input-field" id="id" name="id" required>
                    <h3>From</h3>
                    <input type="text" class="input-field" id="place1" name="from" required>
                    <h3>To</h3>
                    <input type="text" class="input-field" id="place2" name="to" required>
                    <h3>No. of seats</h3>
                    <input type="number" class="input-field" id="seats" name="nos" required>
                </div>
                <div id="sch" class="input-group">
                    <h3>Price</h3>
                    <input type="number" class="input-field" id="price" name="price" required>
                    <h3>Type</h3>
                    <input type="text" class="input-field" id="type" placeholder="AC / NON-AC" name="type" required>
                    <h3>Departure time</h3>
                    <input type="time" class="input-field" id="Dept-time" name="dtime" required>
                    <h3>Arrival time</h3>
                    <input type="time" class="input-field" id="Arr-time" name="atime" required>
                </div>
                <div id="add" class="input-group"><button type="submit" class="submit-button">ADD</button></div>
            </form>
        </div>
    </div>
</body>
</html>