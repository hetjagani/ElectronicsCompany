<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: employees.php');
	}

    $update_employee_query = sprintf("UPDATE `employee` SET `e_fname`='%s',`e_lname`='%s',`e_email`='%s',`e_phone`='%s',`e_salary`=%s,`e_skill`='%s',`e_join_date`='%s',`e_type`='%s' WHERE e_id=%s", $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['salary'], $_POST['skill'] , $_POST['join_date'], $_POST['type'], $_POST['id']);

	$updated = mysqli_query($conn, $update_employee_query);
    
    if($updated) {
        header("Location: employees.php");
    }
?>