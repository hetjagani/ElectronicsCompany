<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: create_package.php');
	}

    mysqli_begin_transaction($conn);
    try {
        $add_package_query = sprintf("INSERT INTO `packages`(`pg_name`, `pg_status`, `pg_dispatched_date`, `pg_delivery_date`, `co_id`) VALUES ('%s','%s','%s','%s',%s);", $_POST['name'], $_POST['status'], $_POST['dispatched_date'],$_POST['delivery_date'], $_POST['customer_order']);
        mysqli_query($conn, $add_package_query);

        $get_id_query = "SELECT LAST_INSERT_ID();";
        $run = mysqli_query($conn, $get_id_query);
        $pg_data = mysqli_fetch_assoc($run);
        $pg_id = $pg_data['LAST_INSERT_ID()'];

        $get_qty_query = sprintf("SELECT it_id, it_available_qty FROM item;");
        $run = mysqli_query($conn, $get_qty_query);
        $qty_map = array();
        while($row = mysqli_fetch_assoc($run)) {
            $qty_map[$row['it_id']] = $row['it_available_qty'];
        }

        foreach($_POST['items'] as $item) {
            if($item['qty'] > $qty_map[$item['id']]) {
                echo 'Item no. '.$item['id'].' is not in available in enough quantity';
                mysqli_rollback($conn);
                die();
            }

            $add_item_query = sprintf("INSERT INTO `updates`(`it_id`, `pg_id`, `pi_qty`, `pi_cost`) VALUES (%s,%s,%s,%s);", $item['id'], $pg_id, $item['qty'], $item['cost']);
            mysqli_query($conn, $add_item_query);

            $item_update_query = sprintf("UPDATE item SET it_available_qty=it_available_qty-%s WHERE it_id=%s", $item['qty'], $item['id']);
            mysqli_query($conn, $item_update_query);
        }

        mysqli_commit($conn);
        echo 'OK';
    } catch (mysqli_sql_exception $exception){
        mysqli_rollback($conn);
        throw $exception;
    }
?>