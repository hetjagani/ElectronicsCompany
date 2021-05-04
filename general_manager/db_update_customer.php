<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: customers.php');
	}

    $update_customer_query = sprintf("UPDATE `customer` SET `c_fname`='%s',`c_lname`='%s',`c_email`='%s',`c_phone`='%s',`c_addr`='%s',`c_type`='%s' WHERE c_id=%s", $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['addr'], $_POST['type'], $_POST['id']);

	$updated = mysqli_query($conn, $update_customer_query);
    
    if($updated) {
        header("Location: customers.php");
    }
?>