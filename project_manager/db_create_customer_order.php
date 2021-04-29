<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_customer_order.php');
	}

    mysqli_begin_transaction($conn);
    try {
        $add_order_query = sprintf("INSERT INTO `orders`(`o_desc`, `o_addr`, `o_total_cost`, `o_delivery_date`) VALUES ('%s','%s',%s,'%s');", $_POST['desc'], $_POST['addr'], $_POST['tot_cost'],$_POST['delivery_date']);
        mysqli_query($conn, $add_order_query);

        $get_id_query = "SELECT LAST_INSERT_ID();";
        $run = mysqli_query($conn, $get_id_query);

        $o_data = mysqli_fetch_assoc($run);

        $o_id = $o_data['LAST_INSERT_ID()'];

        $add_customer_order_query = sprintf("INSERT INTO `customer_order`(`p_id`, `co_placed_date`, `o_id`) VALUES (%s,'%s',%s);", $_POST['project'], $_POST['placed_date'], $o_id);
        mysqli_query($conn, $add_customer_order_query);

        mysqli_commit($conn);
    } catch (mysqli_sql_exception $exception){
        mysqli_rollback($conn);
        throw $exception;
    }
    
    header("Location: customer_orders.php");
?>