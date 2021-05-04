<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'inventory_manager';
    require '../authenticate.php';

    // Create supplier id => name map
    $supplier_query = "SELECT * FROM supplier;";
    $run_supplier_query = mysqli_query($conn, $supplier_query) or die(mysqli_error($conn));
    $supplier_map = array();
    while($row = mysqli_fetch_assoc($run_supplier_query)) {
        $supplier_map[$row['s_id']] = $row['s_name'];
    }

    // Create item id => name map
    $item_query = "SELECT * FROM item;";
    $run_item_query = mysqli_query($conn, $item_query) or die(mysqli_error($conn));
    $item_map = array();
    while($row = mysqli_fetch_assoc($run_item_query)) {
        $item_map[$row['it_id']] = $row['it_name'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Supply Order Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/supply_order.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2> Create Supply Order </h2>
    <div class="container">
        <form id="main-form">
        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="description" name="desc" rows="3"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="addr" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="addr" name="addr" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="tot_cost" class="col-sm-2 col-form-label">Total Cost</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="tot_cost" name="tot_cost" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="delivery_date" class="col-sm-2 col-form-label">Delivery Date</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
            <select id="supplier" class="form-select" aria-label="Supplier" name="supplier" required>
                <?php
                    foreach($supplier_map as $id => $name) {
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    } 
                ?>
            </select>
        </div>                    
        <hr>
        
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#itemModal">
        Add Item
        </button>
        <ul id="item_list" class="list-group">
        </ul>

        <hr>
        <div class="d-grid gap-2">
            <input type="submit" class="btn btn-primary" value="CREATE"></input>
        </div>
        </form>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centere">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="itemModalLabel">Add Item</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="item_add_form">
            <div class="row mb-3">
            <label for="item" class="col-sm-2 col-form-label">Items</label>
            <select id="item" class="form-select" aria-label="Items" name="item" required>
                <?php
                    foreach($item_map as $id => $name) {
                        echo '<option value="'.$id.'|'.$name.'">'.$name.'</option>';
                    } 
                ?>
            </select>
            </div>                    
            <div class="row mb-3">
                <label for="qty" class="col-sm-2 col-form-label">Quantity</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="qty" name="qty" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="cost" class="col-sm-2 col-form-label">Cost</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cost" name="cost" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-primary" value="ADD"></input>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    <script src="../assets/js/supply_order.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>