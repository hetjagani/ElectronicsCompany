<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_supplier.php');
	}

    $add_supplier_query = sprintf("INSERT INTO `supplier` (`s_email`, `s_addr`, `s_name`, `s_desc`, `s_phone`) VALUES ('%s', '%s', '%s', '%s', '%s');", $_POST['email'], $_POST['addr'], $_POST['name'], $_POST['desc'], $_POST['phone']);

	mysqli_query($conn, $add_supplier_query) or die(mysqli_error($conn));
    
    header("Location: suppliers.php");
?>