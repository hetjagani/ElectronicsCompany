<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: suppliers.php');
	}

    $delete_service_query = sprintf("DELETE FROM supplier WHERE s_id = %s", $_GET['id']);

	mysqli_query($conn, $delete_service_query) or die(mysqli_error($conn));
    
    header("Location: suppliers.php");
?>