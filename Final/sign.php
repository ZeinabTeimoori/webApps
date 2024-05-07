<?php
$success=0;
$user=0;

    if($_SERVER['REQUEST_METHOD']=='POST'){
        include 'connect.php';
        $username=$_POST['username'];
        $uname=$_POST['uname'];
        $age=$_POST['age'];
        $password=$_POST['password'];

        if($age<1){
             echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>ERROR</strong> Please Enter a Valid Age
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>  
                     </div>'; 
        } else {
             $sql="SELECT * FROM users WHERE username = '$username'";
        //checks query worked
        $result=mysqli_query($con,$sql);
        if($result){
            $num=mysqli_num_rows($result);
            //checks user isint already made
            if($num>0){
                $user=1;
            } else {
                try {
                    //adds into database
                    $sql="INSERT INTO users (username, name, age, password)
                    values('$username', '$uname', $age, '$password')";
                    $result=mysqli_query($con,$sql);
                     if($result){
                    $success=1;
                    session_start();
                    $_SESSION['username']=$username;
                    header('Location:home.php');          
                } else {    
                    die(mysqli_error($con));
                }
                } catch (mysqli_sql_exception $e) {
                     //error for sql 
                     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>ERROR</strong> Please Enter a Valid Insert
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>  
                     </div>';               
                }
                
            }
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

    <title>Signup Page</title>
  </head>
  <body>

   <!-- Error message for sign up -->
  <?php
  if($user){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ERROR</strong> User already exists
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
  <h1 class = "text-center mt-2">Sign Up</h1>
    <div class="container mt-2">
    <form action ="sign.php" method="post">
  
    

     <!-- go to login button code -->
    <?php
  if(array_key_exists('gotologin', $_POST)){
      GoToLogin();
  }

  function GoToLogin(){
      header('Location:login.php'); 
  }

  ?>

  <!-- go to log in button -->
  <button type="submit" class="btn btn-primary mt-4" name="gotologin">Go to Login</button>

    <!-- Username form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" 
    placeholder = "Enter your username" name="username" autocomplete="off">
  </div>

   <!-- name form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" 
    placeholder = "Enter your Name" name="uname" autocomplete="off">
  </div>

    <!-- age form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Age</label>
    <input type="number" class="form-control" 
    placeholder = "Enter your Age" name="age" autocomplete="off">
  </div>

   <!-- Password form -->
  <div class="form-group mt-4">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" 
    placeholder = "Enter your password" name="password" autocomplete="off">
  </div>
  
   <!-- submit button -->
  <button type="submit" class="btn btn-primary w-100 mt-4">Sign Up</button>

</form>
    </div>


  </body>
</html>