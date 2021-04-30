<?php
    session_start();
    $role = 'inventory_manager';
    require '../authenticate.php';

    // Create customer_order id => name map
    $customer_order_query = "SELECT * FROM customer_order JOIN orders ON customer_order.o_id = orders.o_id;";
    $run_co_query = mysqli_query($conn, $customer_order_query) or die(mysqli_error($conn));
    $customer_order_map = array();
    while($row = mysqli_fetch_assoc($run_co_query)) {
        $customer_order_map[$row['co_id']] = $row['o_desc'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Packages</h2>
    <div class="container">
    <table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Status</th>
        <th scope="col">Dispatched Date</th>
        <th scope="col">Delivery Date</th>
        <th scope="col">Customer Order Description</th>
        <th scope="col">Update Status</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $packages_query = 'SELECT * FROM packages;';
        $result_query = mysqli_query($conn, $packages_query) or die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($result_query)) {
            echo '<tr>';
            echo '<th scope="row">'.$row['pg_id'].'</th>';
            echo '<td>'.$row['pg_name'].'</td>';
            echo '<td>'.$row['pg_status'].'</td>';
            echo '<td>'.$row['pg_dispatched_date'].'</td>';
            echo '<td>'.$row['pg_delivery_date'].'</td>';
            echo '<td>'.$customer_order_map[$row['co_id']].'</td>';
            echo '<td><a type="button" class="btn btn-primary" href="update_package.php?id='.$row['pg_id'].'">Update Status</a></td>';
            echo '<td><a type="button" class="btn btn-danger" href="db_delete_package.php?id='.$row['pg_id'].'">Delete</a></td>';
            echo '</tr>';
        }
    ?>

    </tbody>
    </table>
    <div class="d-grid gap-2">
        <a class="btn btn-primary" type="button" href="create_package.php">Create Package</a>
    </div>
    <?php
        if(isset($_GET['err'])) {
            echo '<div class="alert alert-warning" role="alert">';
            echo $_GET['err'];
            echo '</div>';
        }
    ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>