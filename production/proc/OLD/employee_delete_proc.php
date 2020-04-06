<?php



    $id = (isset($_REQUEST['id'])?$_REQUEST['id']:'0');

    include '../dbconnect.php';

    echo "DELETE FROM `PROFILE` WHERE id = $id;";

    mysqli_query($con,"DELETE FROM `PROFILE` WHERE id = $id;");

    if (mysqli_affected_rows($con)){
        echo "**success**";       
    }else{
        echo "**failed**";
    }

    include '../dbclose.php';



      //  echo "**success**";

?>





