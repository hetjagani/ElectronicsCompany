<?php
    session_start();
    require '../authenticate.php';

    // Create customer id => name map
    $customer_query = "SELECT * FROM customer;";
    $run_cust_query = mysqli_query($conn, $customer_query) or die(mysqli_error($conn));
    $customer_map = array();
    while($row = mysqli_fetch_assoc($run_cust_query)) {
        $customer_map[$row['c_id']] = $row['c_fname'] .' '.$row['c_lname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Project List</h2>
    <div class="container">
    <table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Address</th>
        <th scope="col">Description</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Status</th>
        <th scope="col">Cost</th>
        <th scope="col">Customer</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $project_query = 'SELECT * FROM project WHERE e_id ='.$_SESSION['user_id'].';';
        $result_query = mysqli_query($conn, $project_query) or die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($result_query)) {
            echo '<tr>';
            echo '<th scope="row">'.$row['p_id'].'</th>';
            echo '<td>'.$row['p_name'].'</td>';
            echo '<td>'.$row['p_addr'].'</td>';
            echo '<td>'.$row['p_desc'].'</td>';
            echo '<td>'.$row['p_start_date'].'</td>';
            echo '<td>'.$row['p_end_date'].'</td>';
            echo '<td>'.$row['status'].'</td>';
            echo '<td>'.$row['p_cost'].'</td>';
            echo '<td>'.$customer_map[$row['c_id']].'</td>';
            echo '</tr>';
        }
    ?>

    </tbody>
    </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>