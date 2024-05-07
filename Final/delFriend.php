<?php

$bought=0;
$failbuy=0;
echo "add friend";

include 'connect.php';
$username = $_GET['username'];
if(isset($_GET['delid'])){
	
	//gets info
	$fid = $_GET['delid'];
	$sql = "SELECT user_id FROM users WHERE username = '$username'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$unum = $row['user_id'];
	echo "test";
	echo "$unum";
	
	$sql="SELECT * FROM friends f WHERE f.user_id= '$unum' AND f.friend_id = '$fid'";
	$result=mysqli_query($con,$sql);

	//checks user exists
	if($result){
		$num=mysqli_num_rows($result);
		if($num<0){
			echo "bruh";
			header('location:friends.php');
		} else {
			//removes them from database, also removes inverse
			$sql="DELETE FROM friends WHERE user_id = '$unum' AND friend_id = '$fid'";
			$result=mysqli_query($con,$sql);
			$sql="DELETE FROM friends WHERE user_id = '$fid' AND friend_id = '$unum'";
			$result=mysqli_query($con,$sql);
			if($result){
			echo "friend deleted";
			header('location:friends.php?success=1');
		}  

	}

} else {
	echo "bru";
	die(mysqli_error($con));
}

	
}

?>