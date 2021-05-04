<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: customers.php');
	}

    $delete_customer_query = sprintf("DELETE FROM customer WHERE c_id = %s", $_GET['id']);

	mysqli_query($conn, $delete_customer_query) or die(mysqli_error($conn));
    
    header("Location: customers.php");
?>