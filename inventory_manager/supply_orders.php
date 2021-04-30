<?php
    session_start();
    require '../authenticate.php';

    // Create supplier id => name map
    $supplier_query = "SELECT * FROM supplier;";
    $run_supplier_query = mysqli_query($conn, $supplier_query) or die(mysqli_error($conn));
    $supplier_map = array();
    while($row = mysqli_fetch_assoc($run_supplier_query)) {
        $supplier_map[$row['s_id']] = $row['s_name'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Supply Orders</h2>
    <div class="container">
    <table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Description</th>
        <th scope="col">Address</th>
        <th scope="col">Total Cost</th>
        <th scope="col">Delivery Date</th>
        <th scope="col">Supplier</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $supply_order_query = 'SELECT * FROM supply_order JOIN orders ON supply_order.o_id = orders.o_id;';
        $result_query = mysqli_query($conn, $supply_order_query) or die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($result_query)) {
            echo '<tr>';
            echo '<th scope="row">'.$row['so_id'].'</th>';
            echo '<td>'.$row['o_desc'].'</td>';
            echo '<td>'.$row['o_addr'].'</td>';
            echo '<td>'.$row['o_total_cost'].'</td>';
            echo '<td>'.$row['o_delivery_date'].'</td>';
            echo '<td>'.$supplier_map[$row['s_id']].'</td>';
            echo '<td><a type="button" class="btn btn-danger" href="db_delete_supply_order.php?id='.$row['so_id'].'">Delete</a></td>';
            echo '</tr>';
        }
    ?>

    </tbody>
    </table>
    <div class="d-grid gap-2">
        <a class="btn btn-primary" type="button" href="create_supply_order.php">Create Supply Order</a>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>