<?php  
include '../dbconnect.php';

try
{

	$user_id=isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';
	$fullname=isset($_REQUEST['fullname'])?$_REQUEST['fullname']:'';
	$username=isset($_REQUEST['username'])?$_REQUEST['username']:'';
	$role_id=isset($_REQUEST['role_id'])?$_REQUEST['role_id']:'';
	$status=isset($_REQUEST['status'])?$_REQUEST['status']:'';
	$password=isset($_REQUEST['password'])?$_REQUEST['password']:'';


	if($_REQUEST["mode"] == "update")
	{





		$result = mysqli_query($con,"

		UPDATE users
		SET fullname = '$fullname',
		    username = '$username',
		    password = '$password',
		    role_id = '$role_id',
		    status = '$status'
		WHERE user_id = $user_id

		");

		if (mysqli_affected_rows($con) > 0){
			
			$result = mysqli_query($con,"

                            SELECT
                              `dmcsm`.`users`.`user_id`              AS `user_id`,
                              `dmcsm`.`users`.`fullname`             AS `fullname`,
                              `dmcsm`.`users`.`username`             AS `username`,
                              `dmcsm`.`users`.`password`             AS `password`,
                              `dmcsm`.`users`.`status`               AS `status`,
                              `dmcsm`.`users`.`approved`             AS `approved`,
                              `dmcsm`.`roles`.*
                            FROM (`dmcsm`.`users`
                                LEFT JOIN `dmcsm`.`roles`
                                  ON ((`dmcsm`.`users`.`role_id` = `dmcsm`.`roles`.`role_id`)))
)
							WHERE `dmcsm`.`users`.`user_id`= $user_id"

							);
			$r = mysqli_fetch_array($result);

	            $user_id = $r['user_id']; 
	            $fullname = $r['fullname']; 
	            $username = $r['username']; 
	            $role_id = $r['role_id']; 
	            
	            $role = $r['role'];
	            $approved = $r['approved'];
	            $isapproved = ($r['approved']==1?"Yes":"No");
	            $status = $r['status'];
            
                $row = "
                    <tr id=row$user_id>
                        <td class=\"even gradeC\"> $user_id</td>
                        <td>$username</td>
                        <td>$fullname</td>
                        <td>$role</td>
                        <td>$status</td>
                        <td>$isapproved</td>                                       
                        <td>

                            <a href=\"#\" class=\"btn btn-success btn-circle\" id=btnuseredit data-toggle=\"modal\" data-target=\"#myModal\"

                                user_id     =\"$user_id\"
                                fullname    =\"$fullname\"
                                username    =\"$username\"
                                role_id     =\"$role_id\"

                                role        =\"$role\"
                                approved    =\"$approved\"
                                isapproved  =\"$isapproved\"
                                status      =\"$status\"

                                password =\"$password\"
                            >
                            <i class=\"glyphicon glyphicon-edit\"></i></a>



                            <a href=\"#\" 
                            user_id=$user_id
                            id=btnuserdelete 
                            class=\"btn btn-danger btn-circle\"><i class=\"glyphicon glyphicon-trash\"></i></a>

                        </td>
                </tr>

                ";



			echo "**success**|".$row;

		}else{
			echo "**noChanges**";
		}
	}
	
	else if($_REQUEST["mode"] == "insert")
	{
		//check if user exists
		$result = mysqli_query($con,"SELECT count(*) as userCount FROM vUserRoles WHERE username = '$username';");
		$data 	= mysqli_fetch_row($result);
		echo $data[0];
		if ($data[0] > 0) {
			echo "**exists**";
			return;
		}


		//Insert record into database
		$result = mysqli_query($con,"
			INSERT INTO users (fullname, username, password, role_id, approved, status)
  			VALUES ('$fullname', '$username', '$password', '$role_id', '0', '$status');
		");


		if (mysqli_affected_rows($con) > 0){
			
			$result = mysqli_query($con,"SELECT * FROM vUserRoles WHERE user_id= LAST_INSERT_ID()");
			$r = mysqli_fetch_array($result);

	            $user_id = $r['user_id']; 
	            $fullname = $r['fullname']; 
	            $username = $r['username']; 
	            $role_id = $r['role_id']; 
	            
	            $role = $r['role'];
	            $approved = $r['approved'];
	            $isapproved = ($r['approved']==1?"Yes":"No");
	            $status = $r['status'];
            
                $row = "
                    <tr id=row$user_id>
                        <td class=\"even gradeC\"> $user_id</td>
                        <td>$username</td>
                        <td>$fullname</td>
                        <td>$role</td>
                        <td>$status</td>
                        <td>$isapproved</td>                                       
                        <td>

                            <a href=\"#\" class=\"btn btn-success btn-circle\" id=btnuseredit data-toggle=\"modal\" data-target=\"#myModal\"

                                user_id     =\"$user_id\"
                                fullname    =\"$fullname\"
                                username    =\"$username\"
                                role_id     =\"$role_id\"

                                role        =\"$role\"
                                approved    =\"$approved\"
                                isapproved  =\"$isapproved\"
                                status      =\"$status\"

                                password =\"$password\"

                            >
                            <i class=\"glyphicon glyphicon-edit\"></i></a>



                            <a href=\"#\" 
                            user_id=$user_id
                            id=btnuserdelete 
                            class=\"btn btn-danger btn-circle\"><i class=\"glyphicon glyphicon-trash\"></i></a>

                        </td>
                </tr>

                ";

			echo "**success**|".$row;


		}else{
			echo "**failed**";
		}



		
	}

	else if($_GET["mode"] == "delete")
	{

		$result = mysqli_query($con,"DELETE FROM users WHERE user_id = $user_id;");
		if (mysqli_affected_rows($con) > 0){
			echo "**success**";
		}else{
			echo "**failed**";
		}

	}

	//Close database connection
	mysqli_close($con);

}
catch(Exception $ex)
{
	echo "**failed**";
}
	
?>