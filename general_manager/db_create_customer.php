<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_customer.php');
	}

    $add_customer_query = sprintf("INSERT INTO `customer`(`c_fname`, `c_lname`, `c_email`, `c_phone`, `c_addr`, `c_type`) VALUES ('%s','%s','%s','%s','%s','%s');", $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['addr'], $_POST['type']);

	mysqli_query($conn, $add_customer_query) or die(mysqli_error($conn));
    
    header("Location: customers.php");
?>