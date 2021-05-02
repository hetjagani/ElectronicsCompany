<?php
    session_start();
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_employee.php');
	}

    $add_customer_query = sprintf("INSERT INTO `employee`(`e_fname`, `e_lname`, `e_email`, `e_phone`, `e_salary`, `e_skill`, `e_join_date`, `e_type`, `e_password`) VALUES ('%s','%s','%s','%s', %s,'%s','%s','%s','%s');", $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], intval($_POST['salary']), $_POST['skill'],  $_POST['join_date'],  $_POST['type'],  md5($_POST['password']));

	mysqli_query($conn, $add_customer_query) or die(mysqli_error($conn));
    
    header("Location: employees.php");
?>