<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: projects.php');
	}

    mysqli_begin_transaction($conn);
    try{
    
        $delete_emp_query = sprintf("DELETE FROM provide_services WHERE p_id = %s", $_GET['id']);
        mysqli_query($conn, $delete_emp_query);

        $delete_project_query = sprintf("DELETE FROM project WHERE p_id = %s", $_GET['id']);
        mysqli_query($conn, $delete_project_query);

        mysqli_commit($conn);
    } catch(mysqli_sql_exception $exp) {
        mysqli_rollback($conn);
        throw $exp;
    }

    
    header("Location: projects.php");
?>