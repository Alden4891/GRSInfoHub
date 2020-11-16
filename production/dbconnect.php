<?php
	$con_password = '';
	$con_username = 'root';
	$con_database = 'db_grs';
	$con_host = 'localhost';
	$con=mysqli_connect($con_host,$con_username,$con_password,$con_database);
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to database: " . mysqli_connect_error();
	  }
?>