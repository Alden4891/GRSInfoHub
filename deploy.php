
<?php

include 'production/dbconnect.php';
if (!$con) {
  die('Unable to connect to mysql server');
}

//check if database exists


if (empty (mysqli_fetch_array(mysqli_query($con,"SHOW DATABASES LIKE 'db_grs' ")))){
	$sql_stru = file_get_contents('db_structure.sql');
	if(mysqli_multi_query($con,$sql_stru)){
		$sql_data = file_get_contents('db_data.sql');
			if(mysqli_multi_query($con,$sql_data)){
				header("Location: production/index.php");
				exit();
			}else{
				echo "Unable to deploy the database. Please report to the system developer email: <u>aaquinones.fo12@dswd.gov.ph</u>";
			}
	}
}else{    
	echo "DB  exists!";
}

include 'production/dbclose.php';
	

?>