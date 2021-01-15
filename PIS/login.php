<?php
    session_start();
    if(!isset($_POST["uid"])){
        header("location: index.php");
    }
    include "dbconnect.php";
    $uid=$_POST["uid"];
    $pass=$_POST["pass"];
    $query="SELECT * FROM `users` WHERE `userid`='$uid'";
    $result=mysqli_query($db,$query);
    $row=mysqli_fetch_array($result);
    if($row["password"]==$pass){
        if($row["role"]=="admin"){
            $_SESSION["admin"]=$uid;
            header("location: add_agent.php");
        }
        else if($row["role"]=="agent"){
            $_SESSION["agent"]=$uid;
            header("location: add_bus.php");
        }
        else {
            $_SESSION["user"]=$uid;
            header("location: search.php");
        }
    }
    else {
        header("location: index.php?error=1");
    }
?>

