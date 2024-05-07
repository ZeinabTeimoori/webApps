<?php
$error=0;
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
$uid= $row['user_id'];

$id = $_GET['g_id'];


if(isset($_GET['column'])){
    $column = $_GET['column'];
} else {
   $column = "u.user_id";
}

//gets title to show
$sql = "SELECT title FROM games WHERE game_id = $id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$gtitle = $row['title'];

//error and success messages
if(isset($_GET['error'])){
    $error = $_GET['error'];
}
if(isset($_GET['success'])){
    $success = $_GET['success'];
}

if($success=='1'){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> Friend Added
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if($error=='1'){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ERROR</strong> Already Friended
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
    <title>player Page</title>
  </head>
  <body>
    <h1 class = "text-center text-success mt-4">Users who play <?php echo "$gtitle"?> </h1>

    

   
   <div class="container">

    <!-- button toolbar -->
    <div class="btn-toolbar mt-5" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group" role="group" aria-label="First group">
    <a href="store.php" class="btn btn-primary">Store</a>
    <a href="home.php" class="btn btn-primary">Library</a>
    <a href="friends.php" class="btn btn-primary">Friends</a>
    <a href="settings.php" class="btn btn-primary">Settings</a>
  </div>
  <div class="btn-group" role="group" aria-label="Second group">
  <a href="logout.php" class="btn btn-primary ml-5">Logout</a>
  </div>
</div>
   
 
  
  
  <!--code for table -->
  <?php
 // try{
    $sql ="SELECT u.user_id, u.username, ug.completion_percent, ug.hours_played, ug.rating, ug.date_purchased 
    FROM users u, user_games ug WHERE ug.user_id = u.user_id AND ug.game_id = '$id' AND u.user_id != '$uid' ORDER BY $column";
    $result=mysqli_query($con, $sql); 
    //checks not null
    if($result){
        $row=mysqli_fetch_assoc($result);
           if(isset($row)){      
               //table header
                echo ' <table class="table mt-4">
                <thead>
                 <tr>
                  <th scope="col"><a href="players.php?g_id='.$id.'&column=u.username">User</a></th>               
                  <th scope="col"><a href="players.php?g_id='.$id.'&column=ug.completion_percent">%Completed</th>
                  <th scope="col"><a href="players.php?g_id='.$id.'&column=ug.hours_played">Hours Played</th>
                  <th scope="col"><a href="players.php?g_id='.$id.'&column=ug.rating">Rating</th>
                  <th scope="col"><a href="players.php?g_id='.$id.'&column=ug.date_purchased">Date Purchased</a></th>
                  <th scope="col">Operations</th>
                  </tr>
                 </thead>
                <tbody>';

           //table display
           $userid = $row['user_id'];
           $uname = $row["username"];
           $completion_percent = $row['completion_percent'];
           $hours_played = $row['hours_played'];
           $rating = $row['rating'];
           $dpurch = $row['date_purchased'];
           echo '<tr>
             <th scope="row">'.$uname.'</th>   
             <td>'.$completion_percent.'</td>
             <td>'.$hours_played.'</td>
             <td>'.$rating.'</td>
             <td>'.$dpurch.'</td>
            <td>
            <button class="btn btn-warning">
             <a href ="addFriend.php?add_id='.$userid.'&username='.$username.'&g_id='.$id.'" class="text-light">Add Friend</a>
             </button>
             </td>
             </tr>';


           while($row=mysqli_fetch_assoc($result)){
           $userid = $row['user_id'];
           $uname = $row["username"];
           $completion_percent = $row['completion_percent'];
           $hours_played = $row['hours_played'];
           $rating = $row['rating'];
           $dpurch = $row['date_purchased'];
           echo '<tr>
             <th scope="row">'.$uname.'</th>   
             <td>'.$completion_percent.'</td>
             <td>'.$hours_played.'</td>
             <td>'.$rating.'</td>
             <td>'.$dpurch.'</td>
            <td>
            <button class="btn btn-warning">
             <a href ="addFriend.php?add_id='.$userid.'&username='.$username.'&g_id='.$id.'" class="text-light">Add Friend</a>
             </button>
             </td>
             </tr>';
           }
        } else {
           echo '<h3 class = "text-center text mt-5">No Players Found</h3>';
        }

       
        
    } else {
         //echo "no games";
    }
  
    ?>


   </div>


   
  </body>
</html>