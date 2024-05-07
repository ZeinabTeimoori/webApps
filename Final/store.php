<?php
$error=0;
$success=0;
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
include 'connect.php';
$username = $_SESSION['username'];

//gets table to sort by
if(isset($_GET['column'])){
    $column = $_GET['column'];
} else {
   $column = "g.game_id";
}

//error/success messages
if(isset($_GET['error'])){
    $error = $_GET['error'];
}
if(isset($_GET['success'])){
    $success = $_GET['success'];
}

if($success=='1'){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> Game Bought
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if($error=='1'){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ERROR</strong> You already own that game
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if($error=='2'){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ERROR</strong> You are not old enough
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
    <h1 class = "text-center text-success mt-4">Store</h1>
    <h3 class = "text-center text mt-4">Games. Unlimited Games.</h3>

    

   
   <div class="container">

    <!-- button toolbar -->
    <div class="btn-toolbar mt-5" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group" role="group" aria-label="First group">
    <a href="store.php" class="btn btn-primary">Store</a>
    <a href="home.php" class="btn btn-primary">Library</a>
    <!-- <a href="friends.php" class="btn btn-primary">Friends</a>
    <a href="settings.php" class="btn btn-primary">Settings</a> -->
  </div>
  <div class="btn-group" role="group" aria-label="Second group">
  <a href="logout.php" class="btn btn-primary ml-5">Logout</a>
  </div>
</div>
   
   <!-- Table header -->
   <table class="table mt-4">
  <thead>
    <tr>
      <th scope="col"><a href="store.php?column=g.title">Game Title</a></th>
<!-- th scope="col"><a href="store.php?column=d.dname">Developer</a></th> -->
      <th scope="col"><a href="store.php?column=g.genre">Genre</a></th>
      <th scope="col"><a href="store.php?column=g.price">Price</a></th>
      <th scope="col"><a href="store.php?column=g.release_date">Release Date</a></th>
      <th scope="col"><a href="store.php?column=g.age_rating">Age Rating</a></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  
  <!--code for table -->
  <?php
  try{
    $sql ="SELECT g.game_id, d.dname, g.title, g.genre, g.price, g.release_date, g.age_rating
           FROM games g, developers d, dev_games dg WHERE g.game_id = dg.game_id AND d.dev_id = dg.dev_id ORDER BY $column";
    $result=mysqli_query($con, $sql); 
    //checks not null
    if($result){
       while($row=mysqli_fetch_assoc($result)){
           $game_id = $row['game_id'];
           $dev = $row['dname'];
           $title = $row['title'];
           $genre = $row['genre'];
           $price = $row['price'];
           $release_date = $row['release_date'];
           $age_rating = $row['age_rating'];
           echo '<tr>
      <th scope="row">'.$title.'</th>
      <td>'.$dev.'</td>
      <td>'.$genre.'</td>
      <td>$'.$price.'</td>
      <td>'.$release_date.'</td>
      <td>'.$age_rating.'</td>
      <td>
        <button class="btn btn-success">
        <a href ="buy.php?buyid='.$game_id.'&username='.$username.'" class="text-light">Buy</a>
        </button>
        </td>
    </tr>';
       }
        
    }
  } catch (mysqli_sql_exception $e){
      echo "no games ";
      echo "$column";
  }
    ?>


   </div>


   
  </body>
</html>