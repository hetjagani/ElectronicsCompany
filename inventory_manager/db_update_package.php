<?php
    session_start();
    $role = 'inventory_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: packages.php');
	}

    $update_packages_query = sprintf("UPDATE packages SET pg_status='%s' WHERE pg_id=%s", $_POST['status'], $_POST['id']);

	$updated = mysqli_query($conn, $update_packages_query);
    
    if($updated) {
        header("Location: packages.php");
    }
?>