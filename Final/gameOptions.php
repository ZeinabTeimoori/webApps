<?php
$success=0;
$error=0;

include 'connect.php';

$gid = $_GET['g_id'];
$uname = $_GET['username'];
$sql = "SELECT u.user_id FROM users u WHERE u.username = '$uname'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$uid= $row['user_id'];

//gets title to show
$sql = "SELECT title FROM games WHERE game_id = $gid";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$gtitle = $row['title'];



    if($_SERVER['REQUEST_METHOD']=='POST'){
        $comp=$_POST['percent'];
        $h_played=$_POST['hours_played'];
        $rating=$_POST['rating'];

        if($comp < 0 || $comp > 100){
            $error=1;
        }
        if($h_played < 0){
            $error=1;
        }
        if($rating < 0 || $rating > 10 ){
            $error =1;
        }

        if($error==0){
            //adds into database
            $sql="UPDATE user_games SET completion_percent = '$comp', hours_played='$h_played', rating ='$rating' WHERE game_id ='$gid' AND user_id ='$uid'";
            $result=mysqli_query($con,$sql);
            if($result){
                header('Location:home.php');          
            } else {    
                die(mysqli_errorr($con));
            }
        }
        
       
    }

?>





<!doctype html>
<html lang="en">
  <head>
  <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- CSS/stylesheet -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>game data Page</title>
  </head>
  <body>

   <!-- Error message for sign up -->
  <?php
  if($error){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ERROR</strong> Please Enter Valid Data
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  ?>

   <!-- Success message for sign up-->
  <?php
  if($success){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS</strong> Successfuly Signed Up
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  ?>

  <!-- header form -->
  <h1 class = "text-center mt-2"><?php echo "$gtitle"?> Options</h1>
    <div class="container mt-2">
    <form action ="" method="post">
  
    

    <!-- Username form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Enter Hours Played:</label>
    <input type="text" class="form-control" 
    placeholder = "Enter Hours Played" name="hours_played" autocomplete="off">
  </div>

   <!-- name form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Enter percent amount you have completed:</label>
    <input type="text" class="form-control" 
    placeholder = "Enter Completion Percent" name="percent" autocomplete="off">
  </div>

    <!-- age form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Enter rating for this game:</label>
    <input type="number" class="form-control" 
    placeholder = "Enter Rating" name="rating" autocomplete="off">
  </div>

  
   <!-- submit button -->
  <button type="submit" class="btn btn-primary w-100 mt-4">Enter</button>

</form>
    </div>


  </body>
</html>