<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: projects.php');
	}

    $update_project_query = sprintf("UPDATE `project` SET `p_name`='%s',`p_addr`='%s',`p_desc`='%s',`p_start_date`='%s',`p_end_date`='%s',`p_status`='%s',`p_cost`=%s,`e_id`=%s,`c_id`=%s WHERE p_id=%s;", $_POST['name'], $_POST['addr'], $_POST['desc'], $_POST['start_date'], $_POST['end_date'], $_POST['status'], $_POST['cost'], $_POST['manager'], $_POST['customer'], $_POST['id']);

	$updated = mysqli_query($conn, $update_project_query);
    
    if($updated) {
        header("Location: projects.php");
    }
?>