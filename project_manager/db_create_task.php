<?php
    session_start();
    $role = 'project_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_task.php');
	}
    
    $add_task_query = sprintf("INSERT INTO `task`(`task_name`, `task_desc`, `task_status`, `task_start_date`, `task_end_date`, `p_id`, `e_id`) VALUES ('%s','%s','%s','%s','%s', %s, %s);", $_POST['name'], $_POST['desc'], $_POST['status'], $_POST['start_date'], $_POST['end_date'], $_POST['p_id'], $_POST['e_id']);

	mysqli_query($conn, $add_task_query) or die(mysqli_error($conn));
    
    header("Location: tasks.php");
?>