<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'inventory_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: packages.php');
	}
    mysqli_begin_transaction($conn);
    try{
        $get_qty_query = sprintf("SELECT it_id, pi_qty FROM updates WHERE pg_id=%s", $_GET['id']);
        $run = mysqli_query($conn, $get_qty_query);
        $qty_map = array();
        while($row = mysqli_fetch_assoc($run)){
            $qty_map[$row["it_id"]] = $row["pi_qty"];
        }

        foreach($qty_map as $id => $qty) {
            $update_qty_query = sprintf("UPDATE item SET it_available_qty=it_available_qty+%s WHERE it_id=%s", $qty, $id);
            mysqli_query($conn, $update_qty_query);
        }

        $delete_updates_query = sprintf("DELETE FROM updates WHERE pg_id=%s", $_GET['id']);
        mysqli_query($conn, $delete_updates_query);

        $delete_package_query = sprintf("DELETE FROM packages WHERE pg_id = %s", $_GET['id']);
        mysqli_query($conn, $delete_package_query);

        mysqli_commit($conn);
    } catch(mysqli_sql_exception $exp) {
        mysqli_rollback($conn);
        throw exp;
    }
    header("Location: packages.php");
?>