<?php

   
    
session_start();
$server="localhost";
$username="root";
$password="";
$database="delta_task3";
$con=mysqli_connect($server,$username,$password,$database);


$Sno=$_SESSION['Sno'];  
$find="SELECT * FROM `delta_task3`.`trial` where `Sno`='$Sno'";

$found = mysqli_query($con, $find);
$polling = mysqli_fetch_array($found);
$option1_count=$polling['option1 count'];
$option2_count=$polling['option2 count'];
$option3_count=$polling['option3 count'];
$option4_count=$polling['option4 count'];
$driver=0;
$userid=$_SESSION['userid'];
$details="SELECT * FROM `delta_task3`.`details` where `Username`='$userid'";
$check = mysqli_query($con, $details);
$myDetail = mysqli_fetch_array($check);
if(isset($_POST['submit'])){
    $choice=$_POST['poll'];

    $user_voted_check = "SELECT * FROM  `delta_task3`.`$polling[Question]` where `Username`='$userid'";
    $query = mysqli_query($con, $user_voted_check);
    if($query->num_rows>=1){
      echo '<script>
      alert("You have already voted");
      
         </script>';
        

    }
    else{
    if($choice==$polling['option1']){
 
      
      $option1_count++;
      
      $update = "UPDATE `delta_task3`.`trial` SET `option1 count`='$option1_count' where `Question`='$polling[Question]'";
      $update2 = "INSERT INTO `delta_task3`.`$polling[Question]` (`Name`, `Username`,  `Email`) VALUES ('$myDetail[Name]','$myDetail[Username]','$myDetail[Email]')";
      if($con->query($update)==true&&$con->query($update2)==true){
        echo '<script>
        alert("Your choice is submitted");
        
           </script>';
           
          }
     }
    
    if($choice==$polling['option2']){
  

     
      $option2_count++;
      
      $update = "UPDATE `delta_task3`.`trial` SET `option2 count`='$option2_count' where  `Question`='$polling[Question]'";
      $update2 = "INSERT INTO `delta_task3`.`$polling[Question]` (`Name`, `Username`,  `Email`) VALUES ('$myDetail[Name]','$myDetail[Username]','$myDetail[Email]')";
      if($con->query($update)==true&&$con->query($update2)==true){
        echo '<script>
        alert("Your choice is submitted");
        
           </script>';
           
          }
    }
    if($choice==$polling['option3']){
    $option3_count++;
      $update = "UPDATE `delta_task3`.`trial` SET `option2 count`='$option2_count' where  `Question`='$polling[Question]'";
      $update2 = "INSERT INTO `delta_task3`.`$polling[Question]` (`Name`, `Username`,  `Email`) VALUES ('$myDetail[Name]','$myDetail[Username]','$myDetail[Email]')";
      if($con->query($update)==true&&$con->query($update2)==true){
        echo '<script>
        alert("Your choice is submitted");
        
           </script>';
       
           
          }
    }
    if($choice==$polling['option4']){
      
      
      
      $option4_count++;
      
      $update = "UPDATE`delta_task3`.`trial` SET `option4 count`='$option4_count' where  `question`='$polling[Question]'";
      $update2 = "INSERT INTO `delta_task3`.`$polling[Question]` (`Name`, `Username`,  `Email`) VALUES ('$myDetail[Name]','$myDetail[Username]','$myDetail[Email]')";
      if($con->query($update)==true&&$con->query($update2)==true){
        echo '<script>
        alert("Your choice is submitted");
        
           </script>';
          
          }
    }
  }
  }

$con->close();

  



?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <title> Poll</title>
</head>
<body text="white">
<div class="nav">   
<button id="logout" onclick="location.href='dashboard_user.php'">BACK</button>
  <button id="logout" onclick="location.href='logout.php'">LOGOUT</button>
  </div>
  <div class="main">
    
    <?php
    echo "<div class=details>
    <h5>NAME: $myDetail[Name]</h5><br>
    <h5>USERNAME: $myDetail[Username]</h5><br>
    <h5>EMAIL: $myDetail[Email]</h5><br></div>  ";
    ?>
    <div class="blank">
    <h1>Cast your vote</h1>
       
       <form  action ="user_poll.php" method="POST">
 <p id="heading"><?php echo $polling['Question']?>?</p>
<div class="align">
  <input type="radio" class="options option1" id="option1" name="poll" value="<?php echo $polling['option1']?>">
  <label for="option1" class="options option1"><?php echo $polling['option1']?></label><br>
  <input type="radio" class="options option2" id="option2" name="poll" value="<?php echo $polling['option2']?>">
  <label for="option2" class="options option2"><?php echo $polling['option2']?></label><br>
  <input type="radio" class="options option3" name="poll" id="option3" value="<?php echo $polling['option3']?>">
  <label for="option3" class="options option3"><?php echo $polling['option3']?></label><br>
  <input type="radio" class="options option4" id="option4" name="poll" value="<?php echo $polling['option4']?>">
  <label for="option4" class="options option4"><?php echo $polling['option4']?></label><br>
 <input name="submit" type="submit" id="btn" value="Submit">    
 </div></form>
    </div>
    <div class="img">
    <img id="img" src="deltaLogoGreen.png">
    </div>
    </div>

    <!-- <div class="container" > -->
        <!-- <h1>Cast your vote</h1>
       
        <form  action ="user_poll.php" method="POST">
  <p id="heading"><?php echo $polling['Question']?>?</p>
 
  <input type="radio" class="options option1" name="poll" value="<?php echo $polling['option1']?>">
  <label for="option1" class="options option1"><?php echo $polling['option1']?></label><br>
  <input type="radio" class="options option2" name="poll" value="<?php echo $polling['option2']?>">
  <label for="option2" class="options option2"><?php echo $polling['option2']?></label><br>
  <input type="radio" class="options option3" name="poll" value="<?php echo $polling['option3']?>">
  <label for="option3" class="options option3"><?php echo $polling['option3']?></label><br>
  <input type="radio" class="options option4" name="poll" value="<?php echo $polling['option4']?>">
  <label for="option4" class="options option4"><?php echo $polling['option4']?></label><br>
  <input name="submit" type="submit" id="btn" value="Submit">    
        </form> -->
    <!-- </div> -->
   

    <div class="bottom">
    <p style="margin:top 10px;">Made with &#10084; by Raghav</p>
    </div>
</body>
</html>