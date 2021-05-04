<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: suppliers.php');
	}

    $delete_supplier_query = sprintf("DELETE FROM supplier WHERE s_id = %s", $_GET['id']);

	mysqli_query($conn, $delete_supplier_query) or die(mysqli_error($conn));
    
    header("Location: suppliers.php");
?>