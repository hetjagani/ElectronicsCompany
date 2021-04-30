<?php
    session_start();
    $role = 'project_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: teams.php');
	}

    mysqli_begin_transaction($conn);
    try {
        $update_team_query = sprintf("UPDATE `team` SET `p_id`=%s,`t_name`='%s',`t_desc`='%s' WHERE t_id=%s;", $_POST['project'], $_POST['name'], $_POST['desc'], $_POST['id']);
        mysqli_query($conn, $update_team_query);

        $delete_old_employees_query = sprintf("DELETE FROM is_part_of WHERE t_id=%s",$_POST['id']);
        mysqli_query($conn, $delete_old_employees_query);

        $employees =  $_POST['employees'];
        foreach($employees as $emp_id) {
            $add_emp_query = sprintf("INSERT INTO `is_part_of`(`e_id`, `t_id`, `p_id`) VALUES (%s,%s,%s);", $emp_id, $_POST['id'], $_POST['project']);
            mysqli_query($conn, $add_emp_query);
        }
        mysqli_commit($conn);
    } catch (mysqli_sql_exception $exception){
        mysqli_rollback($conn);
        throw $exception;
    }
    
    header("Location: teams.php");
?>