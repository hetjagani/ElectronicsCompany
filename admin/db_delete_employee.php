<?php
    session_start();
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: employees.php');
	}

    $delete_employee_query = sprintf("DELETE FROM employee WHERE e_id = %s", $_GET['id']);

	mysqli_query($conn, $delete_employee_query) or die(mysqli_error($conn));
    
    header("Location: employees.php");
?>