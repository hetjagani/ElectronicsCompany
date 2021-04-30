<?php
    session_start();
    $role = 'inventory_manager';
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_supply_order.php');
	}

    mysqli_begin_transaction($conn);
    try {
        $add_order_query = sprintf("INSERT INTO `orders`(`o_desc`, `o_addr`, `o_total_cost`, `o_delivery_date`) VALUES ('%s','%s',%s,'%s');", $_POST['desc'], $_POST['addr'], $_POST['total_cost'],$_POST['delivery_date']);
        mysqli_query($conn, $add_order_query);

        $get_id_query = "SELECT LAST_INSERT_ID();";
        $run = mysqli_query($conn, $get_id_query);
        $o_data = mysqli_fetch_assoc($run);
        $o_id = $o_data['LAST_INSERT_ID()'];

        $add_supply_order_query = sprintf("INSERT INTO `supply_order`(`s_id`, `o_id`) VALUES (%s,%s);", $_POST['supplier'], $o_id);
        mysqli_query($conn, $add_supply_order_query);

        $get_id_query = "SELECT LAST_INSERT_ID();";
        $run = mysqli_query($conn, $get_id_query);
        $so_data = mysqli_fetch_assoc($run);
        $so_id = $so_data['LAST_INSERT_ID()'];

        foreach($_POST['items'] as $item) {
            $add_item_query = sprintf("INSERT INTO `adds`(`it_id`, `so_id`, `si_qty`, `si_cost`) VALUES (%s,%s,%s,%s);", $item['id'], $so_id, $item['qty'], $item['cost']);
            mysqli_query($conn, $add_item_query);

            $item_update_query = sprintf("UPDATE item SET it_available_qty=it_available_qty+%s WHERE it_id=%s", $item['qty'], $item['id']);
            mysqli_query($conn, $item_update_query);
        }

        mysqli_commit($conn);
        echo 'OK';
    } catch (mysqli_sql_exception $exception){
        mysqli_rollback($conn);
        throw $exception;
    }
?>