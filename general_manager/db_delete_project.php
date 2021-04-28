<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: projects.php');
	}

    $delete_project_query = sprintf("DELETE FROM project WHERE p_id = %s", $_GET['id']);

	mysqli_query($conn, $delete_project_query) or die(mysqli_error($conn));
    
    header("Location: projects.php");
?>