<?php
$success=0;
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
include 'connect.php';
$username = $_SESSION['username'];

$sql = "SELECT u.user_id FROM users u WHERE u.username = '$username'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$id= $row['user_id'];

//allows sorting of table
if(isset($_GET['column'])){
    $column = $_GET['column'];
} else {
   $column = "f.user_id";
}

//allows for game deleted message
if(isset($_GET['success'])){
    $success = $_GET['success'];
}
if($success=='1'){
     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Friend Removed</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
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
    <title>Welcome Page</title>
  </head>
  <body>
    <h1 class = "text-center text-success mt-4">
    <?php echo $_SESSION['username'];?>'s Friends
    </h1>

    

   <div class="container">

    <!-- button toolbar -->
    <div class="btn-toolbar mt-5" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group" role="group" aria-label="First group">
    <a href="store.php" class="btn btn-primary">Store</a>
    <a href="home.php" class="btn btn-primary">Library</a>
    <button type="button" class="btn btn-primary">Friends</button>
    <a href="settings.php" class="btn btn-primary">Settings</a>
  </div>
  <div class="btn-group" role="group" aria-label="Second group">
  <a href="logout.php" class="btn btn-primary ml-5">Logout</a>
  </div>
</div>
   
 
  
  
  <!--code for table -->
  <?php
  //try{
    $sql ="SELECT f.friend_id, u.username, f.date_added FROM users u, friends f WHERE f.user_id = '$id' AND f.friend_id = u.user_id ORDER BY $column";
    $result=mysqli_query($con, $sql); 
    //checks not null
    if($result){
        $row=mysqli_fetch_assoc($result);
           if(isset($row)){
               //table header
               echo ' <table class="table mt-4">
               <thead>
                 <tr>
                  <th scope="col"><a href="friends.php?column=u.username">User</a></th>
                  <th scope="col"><a href="friends.php?column=f.date_added">Date Added</a></th>
                  <th scope="col">Actions</th>
                  </tr>
                 </thead>
                <tbody>';

            //gets table data/displays data
           $friendid = $row['friend_id'];
           $uname = $row['username'];
           $dadd = $row['date_added'];
           echo '<tr>
             <th scope="row">'.$uname.'</th>
             <td>'.$dadd.'</td>
            <td>
           
            <button class="btn btn-danger">
             <a href ="delFriend.php?delid='.$friendid.'&username='.$username.'" class="text-light">Remove</a>
             </button>
             </td>
             </tr>';


           while($row=mysqli_fetch_assoc($result)){
           $friendid = $row['friend_id'];
           $uname = $row['username'];
           $dadd = $row['date_added'];
           echo '<tr>
             <th scope="row">'.$uname.'</th>
             <td>'.$dadd.'</td>
            <td>
           
            <button class="btn btn-danger">
             <a href ="delFriend.php?delid='.$friendid.'&username='.$username.'" class="text-light">Remove</a>
             </button>
             </td>
             </tr>';
           }
        } else {
           echo '<h3 class = "text-center text mt-5">You have no friends :( </h3>';
        }

       
        
    } else {
         echo "no games";
    }
  //} catch (mysqli_sql_exception $e){
     // echo "no games";
  //}
    ?>


   </div>


   
  </body>
</html>