<?php
    session_start();
    $role = 'project_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_team.php');
	}

    mysqli_begin_transaction($conn);
    try {
        $add_team_query = sprintf("INSERT INTO `team`(`p_id`, `t_name`, `t_desc`) VALUES (%s,'%s','%s');", $_POST['project'], $_POST['name'], $_POST['desc']);
        mysqli_query($conn, $add_team_query);

        $get_id_query = "SELECT LAST_INSERT_ID();";
        $run = mysqli_query($conn, $get_id_query);

        $team_data = mysqli_fetch_assoc($run);

        $team_id = $team_data['LAST_INSERT_ID()'];

        $employees =  $_POST['employees'];
        foreach($employees as $emp_id) {
            $add_emp_query = sprintf("INSERT INTO `is_part_of`(`e_id`, `t_id`, `p_id`) VALUES (%s,%s,%s);", $emp_id, $team_id, $_POST['project']);
            mysqli_query($conn, $add_emp_query);
        }
        mysqli_commit($conn);
    } catch (mysqli_sql_exception $exception){
        mysqli_rollback($conn);
        throw $exception;
    }
    
    header("Location: teams.php");
?>