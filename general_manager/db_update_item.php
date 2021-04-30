<?php
    session_start();
    require '../authenticate.php';
    require '../database.php';

	if(!isset($_POST)) {
		header('Location: items.php');
	}

    $update_item_query = sprintf("UPDATE `item` SET `it_name`='%s',`it_desc`='%s',`it_available_qty`=%s WHERE it_id=%s", $_POST['name'], $_POST['desc'], $_POST['avai_qty'], $_POST['id']);

	$updated = mysqli_query($conn, $update_item_query);
    
    if($updated) {
        header("Location: items.php");
    }
?>