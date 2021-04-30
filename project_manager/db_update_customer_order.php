<?php
    session_start();
    $role = 'project_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: customer_orders.php');
	}

    mysqli_begin_transaction($conn);
    try {
        $get_oid_query = sprintf("SELECT o_id FROM customer_order WHERE co_id=%s", $_POST['id']);
        $run = mysqli_query($conn, $get_oid_query);

        $data = mysqli_fetch_assoc($run);
        $o_id = $data['o_id'];

        $update_order_query = sprintf("UPDATE `orders` SET `o_desc`='%s',`o_addr`='%s',`o_total_cost`=%s,`o_delivery_date`='%s' WHERE o_id=%s;", $_POST['desc'], $_POST['addr'], $_POST['tot_cost'], $_POST['delivery_date'], $o_id);
        mysqli_query($conn, $update_order_query);

        $update_customer_order_query = sprintf("UPDATE `customer_order` SET `p_id`=%s,`co_placed_date`='%s' WHERE co_id=%s;", $_POST['project'], $_POST['placed_date'], $_POST['id']);
        mysqli_query($conn, $update_customer_order_query);

        mysqli_commit($conn);
    } catch (mysqli_sql_exception $exception){
        mysqli_rollback($conn);
        throw $exception;
    }
    
    header("Location: customer_orders.php");
?>