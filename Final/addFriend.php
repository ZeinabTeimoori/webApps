<?php

$bought=0;
$failbuy=0;
echo "add friend";

include 'connect.php';
$username = $_GET['username'];
if(isset($_GET['add_id'])){
	
	$gameid=$_GET['g_id'];
	echo"$gameid";
	$fid = $_GET['add_id'];
	$sql = "SELECT user_id FROM users WHERE username = '$username'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$unum = $row['user_id'];
	echo "test";
	echo "$unum";
	
	$sql="SELECT * FROM friends f WHERE f.user_id= '$unum' AND f.friend_id = '$fid'";
	$result=mysqli_query($con,$sql);

	//checks user does not exist
	if($result){
		$num=mysqli_num_rows($result);
		if($num>0){
			echo "bruh";
			header('location:players.php?g_id='.$gameid.'&username='.$username.'&error=1');
		} else {
			//adds into database, also removes inverse
			$sql="INSERT INTO `friends` (`user_id`, `friend_id`, `date_added`) VALUES ('$unum', '$fid', current_timestamp())";
			$result=mysqli_query($con,$sql);
			$sql="INSERT INTO `friends` (`user_id`, `friend_id`, `date_added`) VALUES ('$fid', '$unum', current_timestamp())";
			$result=mysqli_query($con,$sql);
			if($result){
			echo "friend Added";
			header('location:players.php?g_id='.$gameid.'&username='.$username.'&success=1');
		}  

	}

} else {
	echo "bru";
	die(mysqli_error($con));
}

	
}

?>