<?php

    $username = (isset($_REQUEST['username'])?$_REQUEST['username']:'');
	$password = (isset($_REQUEST['password'])?$_REQUEST['password']:'');
	$mode =     (isset($_REQUEST['mode'])?$_REQUEST['mode']:'');



	include '../dbconnect.php';
	$res = mysqli_query($con, "


			SELECT
			    `users`.`user_id`
			    , `users`.`fullname`
			    , `users`.`username`
			    , `users`.`password`
			    , `users`.`role_id`
			    , `roles`.*
			FROM
			    `users`
			    INNER JOIN `roles` 
			        ON (`roles`.`role_id` = `users`.`role_id`)
			WHERE (`users`.`username` ='$username'
			    AND `users`.`password` ='$password');

	") or die(mysqli_error());
	if (mysqli_num_rows($res)==0){
		echo "**failed**";
	}else{
		//cookie here
		$row = mysqli_fetch_array($res, MYSQLI_ASSOC);


		$user_id = $row['user_id'];
		$fullname = $row['fullname'];
		$username = $row['username'];
		$password = $row['password'];
		$role_id = $row['role_id'];
		$role = $row['role'];




//		$branch = $row['Branch_Code'];
//		$branch_id  = $row['Branch_ID'];

		//$client_registration = $row['client_registration'];
		//$client_deletion = $row['client_deletion'];
		//$payment_encoding = $row['payment_encoding'];
		//$mcpr_generation = $row['mcpr_generation'];
		//$incentives_module = $row['incentives_module'];
		//$audittrail = $row['audittrail'];
		//$settings_useraccounts = $row['settings_useraccounts'];
		//$settings_accessroles = $row['settings_accessroles'];
		// $settings_dbbackup = $row['settings_dbbackup'];
		// $settings_dbrestore = $row['settings_dbrestore'];
		// $filemaintenance_agents = $row['filemaintenance_agents'];
		// $filemaintenance_branches = $row['filemaintenance_branches'];
		// $filemaintenance_plans = $row['filemaintenance_plans'];
		// $reports_incentives = $row['reports_incentives'];
		// $reports_audittrails = $row['reports_audittrails'];
		// $accounting = $row['accounting'];
		// $burial = $row['burial'];

	
		$timeout = 86400; // 86400 = 1 day


		setcookie('user_id', $user_id, time() + ($timeout), "/"); 
		setcookie('fullname', $fullname, time() + ($timeout), "/"); 
		setcookie('username', $username, time() + ($timeout), "/"); 
		setcookie('password', $password, time() + ($timeout), "/"); 
		setcookie('role_id', $role_id, time() + ($timeout), "/"); 
		setcookie('role', $role, time() + ($timeout), "/"); 


		// setcookie('client_registration', $client_registration, time() + ($timeout), "/");
		// setcookie('client_deletion', $client_deletion, time() + ($timeout), "/");
		// setcookie('payment_encoding', $payment_encoding, time() + ($timeout), "/");
		// setcookie('mcpr_generation', $mcpr_generation, time() + ($timeout), "/");
		// setcookie('incentives_module', $incentives_module, time() + ($timeout), "/");
		// setcookie('audittrail', $audittrail, time() + ($timeout), "/");
		// setcookie('settings_useraccounts', $settings_useraccounts, time() + ($timeout), "/");
		// setcookie('settings_accessroles', $settings_accessroles, time() + ($timeout), "/");
		// setcookie('settings_dbbackup', $settings_dbbackup, time() + ($timeout), "/");
		// setcookie('settings_dbrestore', $settings_dbrestore, time() + ($timeout), "/");
		// setcookie('filemaintenance_agents', $filemaintenance_agents, time() + ($timeout), "/");
		// setcookie('filemaintenance_branches', $filemaintenance_branches, time() + ($timeout), "/");
		// setcookie('filemaintenance_plans', $filemaintenance_plans, time() + ($timeout), "/");
		// setcookie('reports_incentives', $reports_incentives, time() + ($timeout), "/");
		// setcookie('reports_audittrails', $reports_audittrails, time() + ($timeout), "/");
		// setcookie('accounting', $accounting, time() + ($timeout), "/");
		// setcookie('burial', $burial, time() + ($timeout), "/");



        $activity = "User logged-in";
        mysqli_query($con, "INSERT INTO tbl_audittrail (`ACTIVITIES`,`CATEGORY`,`USER_ID`,`DATE`) VALUES ('$activity','LOGIN',$user_id,NOW())");  		

		echo "**success**";
	}
	mysqli_free_result($res);
    include '../dbclose.php';

?>