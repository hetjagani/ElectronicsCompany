<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'inventory_manager';
    require '../authenticate.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>

    <?php
        require 'header.php';
    ?>

    <?php
        $query = sprintf("SELECT * FROM employee WHERE e_id = %s LIMIT 1;", $_SESSION['user_id']);
        $query_run = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($query_run);
    ?>
    <div class="card" style="width: 40%;">
    <div class="card-body">
        <h1 class="card-title">Welcome, <?php echo $data['e_fname'].' '.$data['e_lname'] ?></h1>
        <h3>(<?php echo $data['e_email']; ?>)</h3>
        <hr>
        <a href="items.php" class="card-link">Items</a>
        <a href="packages.php" class="card-link">Packages</a>
        <a href="supply_orders.php" class="card-link">Supply Orders</a>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>