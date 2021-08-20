<?php
$count = false;

if (isset($_POST['name'])&&isset($_POST['userid'])&&isset($_POST['email'])&&isset($_POST['pass'])&&isset($_POST['con_password'])&&isset($_POST['role'])&&isset($_POST['submit'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "delta_task3";
    $con = mysqli_connect($server, $username, $password, $database);



    $name = $_POST['name'];
    $userid = $_POST['userid'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $con_password = $_POST['con_password'];
    $role = $_POST['role'];
    if ($pass != $con_password) {
        echo "Passwords don't match";
        exit();
        $con->close();
    }
    //checking if the Email is repeated
    $query = "SELECT * FROM `delta_task3`.`details` WHERE `Email`='$email' OR `Username`='$userid'";
    $fire = mysqli_query($con, $query);

    $x = $fire->num_rows;
    if ($x > 0) {
        echo '<script>
        alert("Email or Username already in use");
        window.location.assign("signup.php");
           </script>';
        exit();
        $con->close();
    } else {
        $sql = "INSERT INTO `delta_task3`.`details` (`Name`, `Username`,  `Email`, `Password`, `Confirm_Password`,`id`) VALUES ('$name', '$userid', '$email', '$pass', '$con_password' , '$role')";
        
        if ($con->query($sql) == true) {
            echo '<script>
        alert("Hello");
        
           </script>';
        }
        else{
            echo '<script>
        alert("nope");
        
           </script>';
        }
        header("location:login.php"); //work on home page
        exit();
        $con->close();
    }
  
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign UP</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
</head>

<body text="white">
   
    <div id='bg' class="main">

    <div class="container" class='main'>

        <h1>Tshirt Design</h1>
        <h3>SignUp</h3>
        <?php

        if ($count == true) {
            echo "<p class='submitMsg'>Thanks for submitting your form. We are happy to see you joining us for the US trip</p>";
        }
        ?>
        <!-- <p>Enter all the details correctly</p> -->
        <form action="signup.php" method="post">
            <input name="name" type="name" placeholder="Enter your name" id="name">
            <input name="userid" type="text" placeholder="Enter your Username" id="userid">
            <input name="email" type="text" placeholder="Enter your Email" id="email">
            <input name="pass" type="password" placeholder="Password" id="pass">
            <input name="con_password" type="password" placeholder="Confirm password" id="con_password">
            <label for="role">Choose your role: </label>
            <select name="role" id="selection">
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>
            <input type="submit" id="btn" name="submit" value="Sign UP">
        </form>
        <p style="text-align: center;margin-top:20px;font-size:20px;">Already registered? Click here to <a href='login.php'>LogIn</a></p>
  
    </div>
    </div>
    <div class="bottom">
    <p >Made with &#10084; by Raghav</p>
    </div>
</body>

</html>