<?php
if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['role']) && isset($_POST['userid'])&&isset($_POST['submit'])) {
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "delta_task3";
    $con = mysqli_connect($server, $username, $password, $database);



    $email = $_POST['email'];
    $userid = $_POST['userid'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];


    $query = "SELECT * FROM `delta_task3`.`details` WHERE `Email`='$email' AND `Password`='$pass' AND `id`='$role' AND `Username`='$userid' LIMIT 1";
    $fire = mysqli_query($con, $query);

    $x = $fire->num_rows;
    
    
    if ($x == 1) {
        if ($role == "Admin"){$_SESSION['adminid']=$userid;
            header("location:dashboard_admin.php");}
        else {
            if ($check->num_rows == 0){
                $_SESSION['userid']=$userid;
                header("location:dashboard_user.php");
                exit();
            }
            else if($check->num_rows >=1){
    
            $_SESSION['userid']=$userid;
             header("location:dashboard_user.php");}
        }
        exit();
        $con->close();
    } else {
        echo '<script>
   alert("Invalid Credentials or User not found");
   window.location.assign("login.php");
   </script>';
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
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
</head>

<body text="white">
<div id='bg' class="main">

    <div class="container" class='main'>
    
        <h1>T-Shirt Design</h1>
        <h3>LogIn</h3>
        <!-- <p>Enter all the details correctly</p> -->
        <form action="login.php" method="post">

            <input name="email" type="text" placeholder="Enter your Email" id="email">
           
            <input name="userid" type="text" placeholder="Enter your Username" id="userid">
            <input name="pass" type="password" placeholder="Password" id="password">

            <label for="role" style="font-size:19px;">Choose your role: </label>
            <select name="role" id="selection">
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>
            <input type="submit" id="btn" name="submit" value="Log In">
        </form>
        <p style="text-align: center;margin: top 15px;font-size:20px;">Haven't registered? Click here to <a href='signup.php'>SignUp</a></p>
     
        </div>   
    </div>
    <div class="bottom">
    <p style="margin:top 10px;">Made with &#10084; by Raghav</p>
    </div>
</body>

</html>