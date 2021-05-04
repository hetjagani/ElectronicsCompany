<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_project.php');
	}

    mysqli_begin_transaction($conn);
    try {
        $add_project_query = sprintf("INSERT INTO `project`(`p_name`, `p_addr`, `p_desc`, `p_start_date`, `p_end_date`, `p_status`, `p_cost`, `e_id`, `c_id`) VALUES ('%s','%s','%s','%s','%s','%s',%s,%s,%s);", $_POST['name'], $_POST['addr'], $_POST['desc'], $_POST['start_date'], $_POST['end_date'], $_POST['status'], $_POST['cost'], $_POST['manager'], $_POST['customer']);
        mysqli_query($conn, $add_project_query) or die(mysqli_error($conn));
    
        $get_id_query = "SELECT LAST_INSERT_ID();";
        $run = mysqli_query($conn, $get_id_query);

        $project_data = mysqli_fetch_assoc($run);

        $project_id = $project_data['LAST_INSERT_ID()'];

        $services =  $_POST['services'];
        foreach($services as $se_id) {
            $add_serv_query = sprintf("INSERT INTO `provide_services`(`p_id`, `se_id`) VALUES (%s, %s);", $project_id, $se_id);
            mysqli_query($conn, $add_serv_query);
        }
        mysqli_commit($conn);
    } catch (mysqli_sql_exception $exception){
        mysqli_rollback($conn);
        throw $exception;
    }
    
    header("Location: projects.php");
?>