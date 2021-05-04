<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: projects.php');
	}

    mysqli_begin_transaction($conn);
    try {
        $update_project_query = sprintf("UPDATE `project` SET `p_name`='%s',`p_addr`='%s',`p_desc`='%s',`p_start_date`='%s',`p_end_date`='%s',`p_status`='%s',`p_cost`=%s,`e_id`=%s,`c_id`=%s WHERE p_id=%s;", $_POST['name'], $_POST['addr'], $_POST['desc'], $_POST['start_date'], $_POST['end_date'], $_POST['status'], $_POST['cost'], $_POST['manager'], $_POST['customer'], $_POST['id']);
        mysqli_query($conn, $update_project_query);
    
        $delete_old_services_query = sprintf("DELETE FROM provide_services WHERE p_id=%s",$_POST['id']);
        mysqli_query($conn, $delete_old_services_query);

        $services =  $_POST['services'];
        foreach($services as $se_id) {
            $add_serv_query = sprintf("INSERT INTO `provide_services`(`p_id`, `se_id`) VALUES (%s,%s);", $_POST['id'], $se_id);
            mysqli_query($conn, $add_serv_query);
        }
        mysqli_commit($conn);
    } catch (mysqli_sql_exception $exception){
        mysqli_rollback($conn);
        throw $exception;
    }

    header("Location: projects.php");
    
?>