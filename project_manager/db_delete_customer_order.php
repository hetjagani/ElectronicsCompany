<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_GET)) {
		header('Location: customer_orders.php');
	}
    mysqli_begin_transaction($conn);
    try{
        $get_oid_query = sprintf("SELECT o_id FROM customer_order WHERE co_id=%s", $_GET['id']);
        $run = mysqli_query($conn, $get_oid_query);

        $data = mysqli_fetch_assoc($run);
        $o_id = $data['o_id'];

        $delete_customer_order_query = sprintf("DELETE FROM customer_order WHERE co_id = %s", $_GET['id']);
        mysqli_query($conn, $delete_customer_order_query);

        $delete_order_query = sprintf("DELETE FROM orders WHERE o_id = %s", $o_id);
        mysqli_query($conn, $delete_order_query);

        mysqli_commit($conn);
    } catch(mysqli_sql_exception $exp) {
        mysqli_rollback($conn);
        throw exp;
    }
    header("Location: customer_orders.php");
?>