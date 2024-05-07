<?php
$login=0;
$invalid=0;

    if($_SERVER['REQUEST_METHOD']=='POST'){
        include 'connect.php';
        $username=$_POST['username'];
        $password=$_POST['password'];

        $sql="SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        
        //checks login after submit
        $result=mysqli_query($con,$sql);
        if($result){
            $num=mysqli_num_rows($result);
            if($num>0){
                $login=1;
                session_start();
                $_SESSION['username']=$username;
                header('Location:home.php');
            } else {
               $invalid=1;
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

    <title>Log In</title>
  </head>
  <body>

    <?php
    //error message
  if($invalid){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ERROR</strong> User does not exist
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  ?>

  <?php
  //error message
  if($login){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS</strong> Successfuly Logged in
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  ?>

  <!-- Header form -->
  <h1 class = "text-center mt-2">Log In</h1>
    <div class="container mt-2">
    <form action ="login.php" method="post">
   
    
    <!-- php code for sign in button -->
   <?php
  if(array_key_exists('signbutton', $_POST)){
      SignButton();
  }

  function SignButton(){
      header('Location:sign.php'); 
  }

  ?>

  <!-- go to sign in button -->
  <button type="submit" class="btn btn-primary mt-4" name="signbutton">Go to Sign Up</button>
  

  <!-- Username form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" 
    placeholder = "Enter your username" name="username" autocomplete="off">
  </div>

   <!-- Password form -->
  <div class="form-group mt-4">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" 
    placeholder = "Enter your password" name="password" autocomplete="off">
  </div>
  
   <!-- submit button -->
  <button type="submit" class="btn btn-primary w-100 mt-4">Login</button>

</form>
    </div>


  </body>
</html>