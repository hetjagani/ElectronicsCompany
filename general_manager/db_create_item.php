<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_item.php');
	}

    $add_item_query = sprintf("INSERT INTO `item` (`it_name`, `it_desc`, `it_available_qty`) VALUES ('%s', '%s', %s);", $_POST['name'], $_POST['desc'], $_POST['avai_qty']);

	mysqli_query($conn, $add_item_query) or die(mysqli_error($conn));
    
    header("Location: items.php");
?>