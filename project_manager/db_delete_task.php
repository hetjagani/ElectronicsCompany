<?php
    session_start();
    $role = 'project_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: tasks.php');
	}

    $delete_task_query = sprintf("DELETE FROM task WHERE task_id = %s", $_GET['id']);

	mysqli_query($conn, $delete_task_query) or die(mysqli_error($conn));
    
    header("Location: tasks.php");
?>