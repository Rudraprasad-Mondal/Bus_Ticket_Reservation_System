<?php
    session_start();
    if(isset($_SESSION["user"])){
        header("location: search.php");
    }else if(isset($_SESSION["agent"])){
        header("location: add_bus.php");
    }else if(isset($_SESSION["admin"])){
        header("location: add_agent.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bus Ticket Reservation System</title>
    <link rel="stylesheet" href="style.css">
    
    </head>
<body>
    <div class="home">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle" onclick="login()">Log in</button>
                <button type="button" class="toggle" onclick="signup()">Sign up</button>
            </div>
            <form id="login" class="input-group" method="post" action="login.php">
                <input type="text" class="input-field" id="id1" placeholder="User ID" name="uid" required>
                <input type="password" class="input-field" id="pass1" placeholder="Enter password" name="pass" required>
                <button type="submit" class="submit-button" id="log">Log In</button>
                <div id="log_err" class="error">* User ID or Password is Invalid</div>
            </form>
            
            <form id="signup" class="input-group" method="post" action="signup.php">
                <input type="text" class="input-field" id="id2" placeholder="User ID" name="uid" required>
                <input type="email" class="input-field" id="email" placeholder="Email-id" name="eid" required>
                <input type="password" class="input-field" id="pass2" placeholder="Enter password" name="pass" required>
                <button type="submit" class="submit-button" id="sign">Sign Up</button>
                <div id="sign_err" class="error">* User ID is already taken</div>
            </form>
        </div>
    
    </div>
    
    <script src="script.js"></script>

    <?php
        if(isset($_GET["error"])){
            if($_GET["error"]==1){
                echo
                '<script>
                    log_err.style.visibility="visible";
                </script>';
            }else if($_GET["error"]==2){
                echo
                '<script>
                    signup();
                    sign_err.style.visibility="visible";
                </script>';
            }
        }
    ?>
</body>
</html>