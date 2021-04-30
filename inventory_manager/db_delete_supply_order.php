<?php
    session_start();
    $role = 'inventory_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: supply_orders.php');
	}
    mysqli_begin_transaction($conn);
    try{
        $get_oid_query = sprintf("SELECT o_id FROM supply_order WHERE so_id=%s", $_GET['id']);
        $run = mysqli_query($conn, $get_oid_query);
        $data = mysqli_fetch_assoc($run);
        $o_id = $data['o_id'];

        $get_qty_query = sprintf("SELECT it_id, si_qty FROM adds WHERE so_id=%s", $_GET['id']);
        $run = mysqli_query($conn, $get_qty_query);
        $qty_map = array();
        while($row = mysqli_fetch_assoc($run)){
            $qty_map[$row["it_id"]] = $row["si_qty"];
        }

        foreach($qty_map as $id => $qty) {
            $update_qty_query = sprintf("UPDATE item SET it_available_qty=it_available_qty-%s WHERE it_id=%s", $qty, $id);
            mysqli_query($conn, $update_qty_query);
        }

        $delete_adds_query = sprintf("DELETE FROM adds WHERE so_id=%s", $_GET['id']);
        mysqli_query($conn, $delete_adds_query);

        $delete_supply_order_query = sprintf("DELETE FROM supply_order WHERE so_id = %s", $_GET['id']);
        mysqli_query($conn, $delete_supply_order_query);


        $delete_order_query = sprintf("DELETE FROM orders WHERE o_id = %s", $o_id);
        mysqli_query($conn, $delete_order_query);

        mysqli_commit($conn);
    } catch(mysqli_sql_exception $exp) {
        mysqli_rollback($conn);
        throw exp;
    }
    header("Location: supply_orders.php");
?>