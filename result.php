<?php
    session_start();
    $server="localhost";
    $username="root";
    $password="";
    $database="delta_task3";
    $con=mysqli_connect($server,$username,$password,$database);
    $userid=$_SESSION['adminid'];
    $Sno=$_SESSION['Sno'];
$details="SELECT * FROM `delta_task3`.`details` where `Username`='$userid'";
$check = mysqli_query($con, $details);
$myDetail = mysqli_fetch_array($check);
   
$result=$details="SELECT * FROM `delta_task3`.`trial` where  `Status`='Inactive'AND `Sno`='$Sno'";
$fire=mysqli_query($con, $result);
$resultDisplay = mysqli_fetch_array($fire);
$option1_count=$resultDisplay['option1 count'];
$option2_count=$resultDisplay['option2 count'];
$option3_count=$resultDisplay['option3 count'];
$option4_count=$resultDisplay['option4 count'];
$con->close();




?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="result.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <title>Poll Result</title>
</head>
<body text="white">
<div class="nav">
<button id="back" onclick="location.href='dashboard_admin.php'">BACK</button>   
<button id="logout" onclick="location.href='logout.php'">LOGOUT</button>
</div>
    <div  class="main">
    <?php
echo "<div class=details>
<h5>NAME: $myDetail[Name]</h5><br>
<h5>USERNAME: $myDetail[Username]</h5><br>
<h5>EMAIL: $myDetail[Email]</h5><br></div>  ";
?>
    <div class="container" >
        <h1>Poll Result</h1>
        <?php 
      echo "<h2 class='stats'>Poll Name: $resultDisplay[Question] </h2><br>";?>
    <!-- //   <h4 class='stats'> $resultDisplay[option1]: $option1_count Votes </h4><br>
    //   <h4 class='stats'> $resultDisplay[option2]: $option2_count Votes </h4><br>
    //   <h4 class='stats'> $resultDisplay[option3]: $option3_count Votes </h4><br>
    //   <h4 class='stats'> $resultDisplay[option4]: $option4_count Votes </h4><br>"; -->
    <table class="table"> 
    <?php 
    
    echo "<tr>";
    echo "<th> OPTION</th>";
    echo "<th> VOTES</th>";
echo "<tr/>";
echo "<tr>";
    echo "<td>$resultDisplay[option1]</td>";
    echo "<td> $option1_count</td>";
echo "<tr/>";
echo "<tr>";
    echo "<td>$resultDisplay[option2]</td>";
    echo "<td> $option2_count</td>";
echo "<tr/>";
echo "<tr>";
    echo "<td>$resultDisplay[option3]</td>";
    echo "<td> $option3_count</td>";
echo "<tr/>";
echo "<tr>";
    echo "<td>$resultDisplay[option4]</td>";
    echo "<td> $option4_count</td>";
echo "<tr/>";



    ?>
    </table>
    </div>
    <img id="img" src="deltaLogoGreen.png">
    </div>
    <div class="bottom">
    <p style="margin:top 10px;">Made with &#10084; by Raghav</p>
    </div>
</body>
</html>