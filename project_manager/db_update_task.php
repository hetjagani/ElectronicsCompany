<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: tasks.php');
	}

    $update_task_query = sprintf("UPDATE `task` SET `task_name`='%s',`task_desc`='%s',`task_status`='%s',`task_start_date`='%s',`task_end_date`='%s',`p_id`=%s,`e_id`=%s WHERE task_id=%s;", $_POST['name'], $_POST['desc'], $_POST['status'], $_POST['start_date'], $_POST['end_date'], $_POST['p_id'], $_POST['employee'], $_POST['id']);

	$updated = mysqli_query($conn, $update_task_query);
    
    if($updated) {
        header("Location: tasks.php");
    }
?>