
<?php
	//error_reporting(0);
	$con_password = '';
	$con_username = 'root';
	$con_database = 'mysql';
	$con_host = 'localhost';
	$con=mysqli_connect($con_host,$con_username,$con_password,$con_database);
	if (mysqli_connect_errno()){
	  echo "Failed to connect to database: " . mysqli_connect_errno();
	}

//	echo mysqli_connect_errno();

	if (!$con) {
	  die('Unable to connect to mysql server. You need to install xampp server in your computer! For inqueries please contact the system developer to mail address: aaquinones.fo12@dswd.gov.ph or ICTMS Head Cres Osco mail address: clocso.fo12@e-dswd.net, 09092880091');
	}



//check if database exists

if (empty (mysqli_fetch_array(mysqli_query($con,"SHOW DATABASES LIKE 'db_grs' ")))){
	echo "** Please wait while the system install the database.<br>";
	$sql_stru = file_get_contents('db_structure.sql');
	if(mysqli_multi_query($con,$sql_stru)){
	echo "Installation Successful!.<br><br>";
	echo "Connecting to database!.<br>";

			if (mysqli_select_db($con, 'db_grs')){
				echo "Current dataase is 'db_grs'!.<br><br>";
				$sql_data = file_get_contents('db_data.sql');
				echo "Inserting database data<br>";
				if(mysqli_multi_query($con,$sql_data)){
					echo "Installation Successful<br>";
					header("Location: production/index.php");
					exit();
				}else{
					echo "Unable to deploy the database. Please report to the system developer email: <u>aaquinones.fo12@dswd.gov.ph or ICTMS Head email address: clocso.fo12@e-dswd.net, 09092880091</u>";
				}

			}

	}
}else{    
	echo header("Location: production/index.php");;
}

include 'production/dbclose.php';
//error_reporting(1);

?>