<?php
    session_start();
    if(!isset($_POST["uid"])){
        header("location: index.php");
    }
    include "dbconnect.php";
    $uid=$_POST["uid"];
    $eid=$_POST["eid"];
    $pass=$_POST["pass"];
    $query="SELECT * FROM `users` WHERE `userid`='$uid'";
    $result=mysqli_query($db,$query);
    $row=mysqli_fetch_array($result);
    if($row){
        header("location: index.php?error=2");
    }
    else {
        $insert="INSERT INTO `users`(`userid`, `email`, `password`, `role`) VALUES ('$uid','$eid','$pass','user')";
        mysqli_query($db,$insert);
        $_SESSION["user"]=$uid;
        header("location: search.php");
    }
?>

