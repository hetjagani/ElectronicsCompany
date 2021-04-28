<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_project.php');
	}

    $add_project_query = sprintf("INSERT INTO `project`(`p_name`, `p_addr`, `p_desc`, `p_start_date`, `p_end_date`, `p_status`, `p_cost`, `e_id`, `c_id`) VALUES ('%s','%s','%s','%s','%s','%s',%s,%s,%s);", $_POST['name'], $_POST['addr'], $_POST['desc'], $_POST['start_date'], $_POST['end_date'], $_POST['status'], $_POST['cost'], $_POST['manager'], $_POST['customer']);

	mysqli_query($conn, $add_project_query) or die(mysqli_error($conn));
    
    header("Location: projects.php");
?>