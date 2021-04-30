<?php
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: services.php');
	}

    $delete_service_query = sprintf("DELETE FROM service WHERE se_id = %s", $_GET['id']);

	mysqli_query($conn, $delete_service_query) or die(mysqli_error($conn));
    
    header("Location: services.php");
?>