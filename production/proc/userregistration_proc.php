<?php



/*
Array
(
    [data] => ids%5B%5D=1&ids%5B%5D=3
    [role_id] => 2
    [fullname] => 3123
    [username] => 123
    [password] => 123123123
)

*/


	


    $username = (isset($_REQUEST['username'])?$_REQUEST['username']:'');
	$password = (isset($_REQUEST['password'])?$_REQUEST['password']:'');
	$fullname = (isset($_REQUEST['fullname'])?$_REQUEST['fullname']:'');
	$role_id = (isset($_REQUEST['role_id'])?$_REQUEST['role_id']:'');
	$email	 = (isset($_REQUEST['email'])?$_REQUEST['email']:'');
	$assignment = (isset($_REQUEST['assignment'])?$_REQUEST['assignment']:'');
	$position = (isset($_REQUEST['position'])?$_REQUEST['position']:'');



	include '../dbconnect.php';
	$res = mysqli_query($con, "SELECT * FROM users WHERE `username`='$username';") or die(mysqli_error());

	if (mysqli_num_rows($res)>0){
		echo "**exists**";
	}else{
		if (mysqli_query($con, "INSERT INTO users (`fullname`,`username`,`password`,`role_id`,`email`,`assignment`,`position`) VALUES ('$fullname','$username','$password','$role_id','$email','$assignment','$position');") or die(mysqli_error())){
			echo "**success**";
		}else{
			echo "**failed**";
		}
	}
	mysqli_free_result($res);
    include '../dbclose.php';


?>