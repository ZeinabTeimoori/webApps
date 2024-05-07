<?php
//delets a game from the user library 

include 'connect.php';
$username = $_GET['username'];
if(isset($_GET['deleteid'])){
	
	//gets data
	$id = $_GET['deleteid'];
	$sql = "SELECT user_id FROM users WHERE username = '$username'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$unum = $row['user_id'];
	echo "$unum";
	
	$sql="SELECT * FROM user_games WHERE user_id= '$unum' AND game_id = '$id'";
	$result=mysqli_query($con,$sql);

	//checks data exists
	if($result){
		$num=mysqli_num_rows($result);
		if($num>0){
			//deletes
			$sql="DELETE FROM user_games WHERE user_id = '$unum' AND game_id = '$id'";
	

			$result=mysqli_query($con,$sql);
			if($result){
			echo "Game bought";
			header('location:home.php?success=1');
		} else {
			
			header('location:home.php?');
		} 

	}

} else {
	die(mysqli_error($con));
}

	
}

?>