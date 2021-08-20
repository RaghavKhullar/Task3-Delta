<?php
session_start();
$server="localhost";
$username="root";
$password="";
$database="delta_task3";
$con=mysqli_connect($server,$username,$password,$database);
$userid=$_SESSION['userid'];
$details="SELECT * FROM `delta_task3`.`details` where `Username`='$userid'";
$check = mysqli_query($con, $details);
$myDetail = mysqli_fetch_array($check);


$poll_get="SELECT * FROM `delta_task3`.`details` where  `id`='Admin'";
$true = mysqli_query($con, $poll_get);
$pollGet = mysqli_fetch_array($true);
$data="SELECT * FROM `delta_task3`.`trial` where  `Username`='$pollGet[Username]'";
$trueData=mysqli_query($con, $data);

?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard_user.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <title>User Dashboard</title>
</head>
<body text="white">
<div class="nav">   
  
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
echo "<h2>POLLS</h2>";
$num=1;

    echo "<tr>";
    echo "<th> S.No</th>";
    echo "<th> POLL</th>";
    echo "<th> STATUS</th>";
echo "<tr/>";
while($tableData = mysqli_fetch_array($trueData)){
    
    if( $tableData['Status']=='Active'){
    echo "<tr>";
    echo "<td> $num</td>";
	    echo "<td> $tableData[Question]</td>";
        echo "<form method='POST'>
             <td><input type='submit' name='$tableData[Sno]' class='btn' value='LIVE'></td>
         </form>";
         echo "<tr/>";
         if(isset($_POST[$tableData['Sno']])){
            $_SESSION['Sno']=$tableData['Sno'];
         header("location:user_poll.php");

          
         } 
         $num++;}
         if( $tableData['Status']=='Inactive'){
            echo "<tr>";
            echo "<td> $num</td>";
                echo "<td> $tableData[Question]</td>";
                echo "<form method='POST'>
                     <td><input type='submit' name='$tableData[Sno]' class='btn' value='SHOW RESULT'></td>
                 </form>";
                 echo "<tr/>";
                 if(isset($_POST[$tableData['Sno']])){
                     
                    
            $select = "SELECT * FROM`delta_task3`.`trial` WHERE `Status`='Inactive' AND `Question`='$tableData[Question]'AND`Sno`='$tableData[Sno]'";
                  if($con->query($select)){
                  $_SESSION['Sno']=$tableData['Sno'];
                  header("location:result_user.php");
}}
                   $num++;
                 }
     
	
    
   
}
?>
</table>
<div class="bottom">
    <p style="margin:top 10px;">Made with &#10084; by Raghav</p>
    </div>
</body>
</html>