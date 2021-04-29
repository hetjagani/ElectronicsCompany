<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: teams.php');
	}
    mysqli_begin_transaction($conn);
    try{
        $delete_emp_query = sprintf("DELETE FROM is_part_id WHERE t_id = %s", $_GET['id']);
        mysqli_query($conn, $delete_emp_query);

        $delete_team_query = sprintf("DELETE FROM team WHERE t_id = %s", $_GET['id']);
        mysqli_query($conn, $delete_team_query);

        mysqli_commit($conn);
    } catch(mysqli_sql_exception $exp) {
        mysqli_rollback($conn);
        throw exp;
    }
    header("Location: teams.php");
?>