<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_service.php');
	}

    $add_service_query = sprintf("INSERT INTO `service` (`se_name`, `se_type`, `se_desc`, `se_cost`) VALUES ('%s', '%s', '%s', %s);", $_POST['name'], $_POST['type'], $_POST['desc'], $_POST['cost']);

	mysqli_query($conn, $add_service_query) or die(mysqli_error($conn));
    
    header("Location: services.php");
?>