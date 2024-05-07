<?php
$success=0;
$error=0;


session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
include 'connect.php';
$ogusername = $_SESSION['username'];
$username = $ogusername;

//gets data for user
$sql = "SELECT * FROM users WHERE username = '$username'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$id= $row['user_id'];
$ogage = $row['age'];
$uname = $row['name'];
$password = $row['password'];

$age = $ogage;

//error and success messages
if(isset($_GET['success'])){
    $success = $_GET['success'];
}
if(isset($_GET['error'])){
    $error = $_GET['error'];
}

if($success==1){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>Succes</strong> Data Changed
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>  
                     </div>';
}

if($error==1){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>ERROR</strong> Please Enter a Valid Insert
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>  
                     </div>';
}

//checks if user hit button
 if($_SERVER['REQUEST_METHOD']=='POST'){
       
        //checks if data was changed when button was clicked
        if($_POST['username']){
             $username=$_POST['username'];
        }
        if($_POST['uname']){
             $uname=$_POST['uname'];
        }
        if($_POST['age']){
             $age=$_POST['age'];
        }
        if($_POST['password']){
             $password=$_POST['password'];
        }
        
        if($age<1){
            $age = $ogage;
             echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>ERROR</strong> Please Enter a Valid Age
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>  
                     </div>'; 
        } else{
             //checks data exists
        $sql="SELECT * FROM users WHERE username = '$username'";
        $result=mysqli_query($con,$sql);
        if($result){
            $num=mysqli_num_rows($result);
            if($num>0){
                $success=0;
                $username = $ogusername;
                header('Location:settings.php?error=1');
                    
            } else {
                try {
                    $sql="UPDATE users 
                    SET username = '$username', name = '$uname', age = '$age', password = '$password'
                    WHERE user_id = '$id'";
                    $result=mysqli_query($con,$sql);
                    if($result){
                        $success=1;
                        session_start();
                        $_SESSION['username']=$username;
                        header('Location:settings.php?success=1');          
                    } else {    
                    die(mysqli_errorr($con));
                    }
                } catch (mysqli_sql_exception $e) {
                    //error if
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- weclome tite -->
    <title>Settings Page</title>
  </head>
  <body>
    <h1 class = "text-center text-success mt-4">User Settings</h1>

    

   
   <div class="container">

    <!-- button toolbar -->
    <div class="btn-toolbar mt-5" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group" role="group" aria-label="First group">
    <a href="store.php" class="btn btn-primary">Store</a>
    <a href="home.php" class="btn btn-primary">Library</a>
    <a href="friends.php" class="btn btn-primary">Friends</a>
    <button type="button" class="btn btn-primary">Settings</button>
  </div>
  <div class="btn-group" role="group" aria-label="Second group">
  <a href="logout.php" class="btn btn-primary ml-5">Logout</a>
  </div>
</div>
   
   <!-- Table header -->
   <table class="table mt-4">
  <thead>
    <tr>
      <th scope="col"><a href="store.php?column=g.title"></a></th>
      <th scope="col"><a href="store.php?column=d.dname"></a></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  
  <form action="" method="post">
    <!-- Username form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Current Username: <?php echo $username;?></label>
    <input type="text" class="form-control" 
    placeholder = "Enter new username" name="username" autocomplete="off">
  </div>

   <!-- name form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Current Name: <?php echo $uname;?></label>
    <input type="text" class="form-control" 
    placeholder = "Enter new Name" name="uname" autocomplete="off">
  </div>

    <!-- age form -->
  <div class="form-group mt-4">
    <label for="exampleInputEmail1" class="form-label">Current Age: <?php echo $age;?></label>
    <input type="number" class="form-control" 
    placeholder = "Enter new Age" name="age" autocomplete="off">
  </div>

   <!-- Password form -->
  <div class="form-group mt-4">
    <label for="exampleInputPassword1" class="form-label">Current Password: <?php echo $password;?></label>
    <input type="password" class="form-control" 
    placeholder = "Enter new password" name="password" autocomplete="off">
  </div>
  
   <!-- submit button -->
  
  <button type="submit" class="btn btn-primary w-100 mt-4">Enter Changes</button>
  </form>

   </div>


   
  </body>
</html>