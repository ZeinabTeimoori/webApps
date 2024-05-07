<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='';
$DATABASE='Final';


$con=mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if(!$con){
	die(mysqli_error($con));
}

?>