<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: items.php');
	}

    $delete_item_query = sprintf("DELETE FROM item WHERE it_id = %s", $_GET['id']);

	mysqli_query($conn, $delete_item_query) or die(mysqli_error($conn));
    
    header("Location: items.php");
?>