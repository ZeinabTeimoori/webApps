<?php

$bought=0;
$failbuy=0;

include 'connect.php';
$username = $_GET['username'];
if(isset($_GET['buyid'])){


	//gets data for game and user
	$id = $_GET['buyid'];
	$sql = "SELECT user_id FROM users  WHERE username = '$username'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$unum = $row['user_id'];
	echo "$unum";
	
	$sql = "SELECT u.age FROM users u WHERE u.user_id = '$unum'";
	$result= mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$userAge = $row['age'];

	//checks that user is old enough to buy the game
	$sql = "SELECT g.age_rating FROM games g WHERE g.game_id = '$id'";
	$result= mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$gameAgeRating = $row['age_rating'];

	echo "$userAge $gameAgeRating";

	
	if($userAge >= $gameAgeRating){
		//checks game exists
		$sql="SELECT * FROM user_games WHERE user_id= '$unum' AND game_id = '$id'";
		$result=mysqli_query($con,$sql);		
		if($result){
			$num=mysqli_num_rows($result);
			if($num>0){
				header('location:store.php?error=1');
			} else {
				//inserts into user_game
				$sql="INSERT INTO `user_games` (`user_id`, `game_id`, `date_purchased`, `completion_percent`, `hours_played`, `rating`) VALUES ('$unum', '$id', current_timestamp(), '0', '0', '0')";
	

				$result=mysqli_query($con,$sql);
				if($result){
					echo "Game bought";
					header('location:store.php?success=1');
				}
			} 
		} 
	}  else {
		//user is not old enough, cannot buy
		echo "not old enough";
		header('location:store.php?error=2');
	}

} else {
	die(mysqli_error($con));
}


?>