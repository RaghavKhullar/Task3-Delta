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

$poll_status="SELECT * FROM `delta_task3`.`trial` where  `Username`='$myDetail[Username]'";
$true = mysqli_query($con, $poll_status);


?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_viewpolls.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <title>View Polls</title>
</head>
<body text="white">
<div class="nav">
<button id="back" onclick="location.href='dashboard_admin.php'">BACK</button>

   
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
while($pollStatus = mysqli_fetch_array($true)){
    
    if( $pollStatus['Status']=='Active'){
    echo "<tr>";
    echo "<td> $num</td>";
	    echo "<td> $pollStatus[Question]</td>";
        echo "<form method='POST'>
             <td><input type='submit' name='$pollStatus[Sno]' class='btn' value='END POLL'></td>
         </form>";
         echo "<tr/>";
         if(isset($_POST[$pollStatus['Sno']])){

             $update = "UPDATE `delta_task3`.`trial` SET `Status`='Inactive' where `Question`='$pollStatus[Question]'";
      if($con->query($update)){
        echo '<script>
        alert("Your poll is ended");
        
           </script>';}}
           $num++;
         }
         if( $pollStatus['Status']=='Inactive'){
            echo "<tr>";
            echo "<td> $num</td>";
                echo "<td> $pollStatus[Question]</td>";
                echo "<form method='POST'>
                     <td><input type='submit' name='$pollStatus[Sno]' class='btn' value='SHOW RESULT'></td>
                 </form>";
                 echo "<tr/>";
                 if(isset($_POST[$pollStatus['Sno']])){
                     
                    
                     $select = "SELECT * FROM`delta_task3`.`trial` WHERE `Status`='Inactive' AND `Question`='$pollStatus[Question]'AND `Username`='$pollStatus[Username]'AND `Sno`='$pollStatus[Sno]'";
              if($con->query($select)){
                  $_SESSION['Sno']=$pollStatus['Sno'];
                  header("location:result.php");
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