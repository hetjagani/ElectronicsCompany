<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: services.php');
	}

    $update_service_query = sprintf("UPDATE `service` SET `se_name`='%s',`se_type`='%s',`se_desc`='%s',`se_cost`=%s WHERE se_id=%s", $_POST['name'], $_POST['type'], $_POST['desc'], $_POST['cost'], $_POST['id']);

	$updated = mysqli_query($conn, $update_service_query);
    
    if($updated) {
        header("Location: services.php");
    }
?>