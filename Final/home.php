<?php
$success = 0;
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
include 'connect.php';
$username = $_SESSION['username'];

//allows for sorting
if(isset($_GET['column'])){
    $column = $_GET['column'];
} else {
   $column = "g.game_id";
}

//allows for game deleted message
if(isset($_GET['success'])){
    $success = $_GET['success'];
}
if($success=='1'){
     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Game Deleted</strong> 
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
    <?php echo $_SESSION['username'];?>'s Games
    </h1>

    

   
   <div class="container">

    <!-- button toolbar -->
    <div class="btn-toolbar mt-5" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group" role="group" aria-label="First group">
    <a href="store.php" class="btn btn-primary">Store</a>
    <button type="button" class="btn btn-primary">Library</button>
    <!-- <a href="friends.php" class="btn btn-primary">Friends</a>
    <a href="settings.php" class="btn btn-primary">Settings</a> -->
  </div> 
  <div class="btn-group" role="group" aria-label="Second group">
  <a href="logout.php" class="btn btn-primary ml-5">Logout</a>
  </div>
</div>
   
 
  
  
  <!--code for table -->
  <?php
  try{
    $sql ="SELECT g.game_id, g.title, g.genre, ug.date_purchased, ug.completion_percent, ug.hours_played, ug.rating
           FROM games g, user_games ug
           WHERE ug.game_id = g.game_id AND ug.user_id = (SELECT u.user_id FROM users u WHERE u.username ='$username') ORDER BY $column";
    $result=mysqli_query($con, $sql); 
    //checks not null
    if($result){
        $row=mysqli_fetch_assoc($result);
           if(isset($row)){      
               //table heading
               echo ' <table class="table mt-4">
               <thead>
                 <tr>
                  <th scope="col"><a href="home.php?column=g.title">Game Title</a></th>
                  <th scope="col"><a href="home.php?column=g.genre">Genre</a></th>
                  <th scope="col"><a href="home.php?column=ug.date_purchased">Date Purchased</a></th>
                  <th scope="col"><a href="home.php?column=ug.completion_percent">Completion</th>
                  <th scope="col"><a href="home.php?column=ug.hours_played">Hours Played</th>
                  <th scope="col"><a href="home.php?column=ug.rating">Rating</th>
                  <th scope="col">Actions</th>
                  </tr>
                 </thead>
                <tbody>';

            //data display
           $gameid = $row['game_id'];
           $title = $row['title'];
           $genre = $row['genre'];
           $dpurch = $row['date_purchased'];
           $completion_percent = $row['completion_percent'];
           $hours_played = $row['hours_played'];
           $rating = $row['rating'];
           echo '<tr>
             <th scope="row">'.$title.'</th>
             <td>'.$genre.'</td>
             <td>'.$dpurch.'</td>
             <td>'.$completion_percent.'%</td>
             <td>'.$hours_played.'</td>
             <td>'.$rating.'</td>
            <td>
            <button class="btn btn-success">
             <a href ="gameOptions.php?g_id='.$gameid.'&username='.$username.'" class="text-light">Options</a>
             </button>
            <button class="btn btn-warning">
             <a href ="players.php?g_id='.$gameid.'&username='.$username.'" class="text-light">Show Players</a>
             </button>
            <button class="btn btn-danger">
             <a href ="delete.php?deleteid='.$gameid.'&username='.$username.'" class="text-light">Delete</a>
             </button>
             </td>
             </tr>';


           while($row=mysqli_fetch_assoc($result)){
           $gameid = $row['game_id'];
           $title = $row['title'];
           $genre = $row['genre'];
           $dpurch = $row['date_purchased'];
           $completion_percent = $row['completion_percent'];
           $hours_played = $row['hours_played'];
           $rating = $row['rating'];
           echo '<tr>
             <th scope="row">'.$title.'</th>
             <td>'.$genre.'</td>
             <td>'.$dpurch.'</td>
             <td>'.$completion_percent.'%</td>
             <td>'.$hours_played.'</td>
             <td>'.$rating.'</td>
             <td>
            <button class="btn btn-success">
             <a href ="gameOptions.php?g_id='.$gameid.'&username='.$username.'" class="text-light">Options</a>
             </button>
              <button class="btn btn-warning">
             <a href ="players.php?g_id='.$gameid.'&username='.$username.'" class="text-light">Show Players</a>
             </button>
            <button class="btn btn-danger">
             <a href ="delete.php?deleteid='.$gameid.'&username='.$username.'" class="text-light">Delete</a>
             </button>
             </td>
              </tr>';
           }
        } else {
            //shows if user has no games
           echo '<h3 class = "text-center text mt-5">You have no games. Try purchasing some from the store.</h3>';
        }

       
        
    } else {
         echo "no games";
    }
  } catch (mysqli_sql_exception $e){
      echo "no games";
  }
    ?>


   </div>


   
  </body>
</html>