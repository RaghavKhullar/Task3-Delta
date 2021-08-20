<?php
session_start();
$server="localhost";
$username="root";
$password="";
$database="delta_task3";
$con=mysqli_connect($server,$username,$password,$database);
$userid=$_SESSION['adminid'];
$details="SELECT * FROM `delta_task3`.`details` where `Username`='$userid'";
$check = mysqli_query($con, $details);
$myDetail = mysqli_fetch_array($check);

$user_data="SELECT * FROM `delta_task3`.`details` where `id`='User'";
$true = mysqli_query($con, $user_data);


?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body text="white">
<div class="nav">
<button id="newpoll" onclick="location.href='newpoll.php'">CREATE NEW POLL</button>
<button id="live_polls" onclick="location.href='admin_viewpolls.php'">VIEW POLLS</button>    
<button id="logout" onclick="location.href='logout.php'">LOGOUT</button>
</div>
<div class="main">
    
<?php
echo "<div class=details>
<h5>NAME: $myDetail[Name]</h5><br>
<h5>USERNAME: $myDetail[Username]</h5><br>
<h5>EMAIL: $myDetail[Email]</h5><br></div>  ";
?>
<div class="blank"></div>
<img id="img" src="deltaLogoGreen.png">
</div>
<table class="table">
<?php
echo "<h2>USER DETAILS</h2>";
$num=1;

    echo "<tr>";
    echo "<th> S.No</th>";
    echo "<th> USERNAME</th>";
    echo "<th> NAME</th>";
echo "<tr/>";
while($userDetails = mysqli_fetch_array($true)){
    echo "<tr>";
    echo "<td> $num</td>";
	    echo "<td> $userDetails[Username]</td>";
	    echo "<td> $userDetails[Name]</td>";
	echo "<tr/>";
    $num++;
}
?>
</table>
<div class="bottom">
    <p style="margin:top 10px;">Made with &#10084; by Raghav</p>
    </div>
</body>
</html>