<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: suppliers.php');
	}

    $update_supplier_query = sprintf("UPDATE `supplier` SET `s_email`='%s',`s_addr`='%s',`s_name`='%s',`s_desc`='%s',`s_phone`='%s' WHERE s_id=%s", $_POST['email'], $_POST['addr'], $_POST['name'], $_POST['desc'], $_POST['phone'], $_POST['id']);

	$updated = mysqli_query($conn, $update_supplier_query);
    
    if($updated) {
        header("Location: suppliers.php");
    }
?>