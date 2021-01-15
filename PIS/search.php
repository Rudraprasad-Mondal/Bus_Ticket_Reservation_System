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
    $query="SELECT * FROM `permissions` WHERE `role`='$role' AND `permsn`='search'";
    $result=mysqli_query($db,$query);
    $row=mysqli_fetch_array($result);
    if(!$row){
        header("location: index.php");
    }
    if(isset($_GET["book"])){
        $id=$_GET["book"];
        $insert="INSERT INTO `bookings`(`userid`, `id`) VALUES ('$uid','$id')";
        mysqli_query($db,$insert);
        header("location: bookings.php");
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
        <div class="form-box2">
            <form class="input1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h2>From:</h2>
                <input type="text" class="input-field1" id="p1" name="from" required>
                <h2>To:</h2>
                <input type="text" class="input-field1" id="p2" name="to" required>
                <button type="submit" class="submit-button" id="search">Find Bus</button>
            </form>
        </div>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $from=$_POST["from"];
                $to=$_POST["to"];
                $query="SELECT * FROM `routes` WHERE `from`='$from' AND `to`='$to' ORDER BY `dtime`";
                $result=mysqli_query($db,$query);
                $row=mysqli_fetch_array($result);
                if($row){
                    echo
                    '<div class="table">
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
                            </tr>';
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
                                    <td><a href="search.php?book='.$row["id"].'">Book</a></td>
                                </tr>';
                            }
                            echo
                        '</table>
                    </div>';
                }else {
                    echo
                    '<div class="table">
                        <h1>No Bus found</h1>
                    </div>';
                }
            }
        ?>
    </div>
</body>
</html>