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
if(isset($_POST['option1'])&&isset($_POST['option2'])&&isset($_POST['option3'])&&isset($_POST['option4'])){

$question=$_POST["question"];
$option1= $_POST["option1"];
$option2= $_POST["option2"]; 
$option3= $_POST["option3"];   
$option4= $_POST["option4"];   



$sql = "INSERT INTO `delta_task3`.`trial` (`Username`,`Question`,`option1`, `option2`, `option3`, `option4`,`timestamp`) VALUES ('$userid','$question','$option1','$option2','$option3','$option4',current_timestamp())";
if($con->query($sql)==true){
    echo '<script>
        alert("Poll has been generated")
        </script>';
        $create="create TABLE `".$question."` (Name varchar(255) not null,Username varchar(255) not null,Email varchar(255) not null)";
 $result=mysqli_query($con,$create);
 
 }    

$con->close();


}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="newpoll.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <title>New Poll</title>
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
        <h1>Create a new poll</h1>
        <form action="newpoll.php" method="POST">
            <input name='question' type='text' placeholder="Write your question here" id="question">
            <input name="option1" type="text" placeholder="Option1" id="option1">
            <input name="option2" type="text" placeholder="Option2" id="option2">
            <input name="option3" type="text" placeholder="Option3" id="option3">
            <input name="option4" type="text" placeholder="Option4" id="option4">
            <input type="submit" id="btn">     
        </form>
    </div>
    <img id="img" src="deltaLogoGreen.png">
    </div>
    <div class="bottom">
    <p style="margin:top 10px;">Made with &#10084; by Raghav</p>
    </div>
</body>
</html>