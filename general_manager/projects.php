<?php
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';

    // Create employee id => name map
    $employee_query = "SELECT * FROM employee;";
    $run_emp_query = mysqli_query($conn, $employee_query) or die(mysqli_error($conn));
    $employee_map = array();
    while($row = mysqli_fetch_assoc($run_emp_query)) {
        $employee_map[$row['e_id']] = $row['e_fname'] .' '.$row['e_lname'];
    }

    // Create customer id => name map
    $customer_query = "SELECT * FROM customer;";
    $run_cus_query = mysqli_query($conn, $customer_query) or die(mysqli_error($conn));
    $customer_map = array();
    while($row = mysqli_fetch_assoc($run_cus_query)) {
        $customer_map[$row['c_id']] = $row['c_fname'] .' '.$row['c_lname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Projects</h2>
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
        <th scope="col">Project Manager</th>
        <th scope="col">Customer</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $user_query = 'SELECT * FROM project;';

        $run_query = mysqli_query($conn, $user_query) or die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($run_query)) {
            echo '<tr>';
            echo '<th scope="row">'.$row['p_id'].'</th>';
            echo '<td>'.$row['p_name'].'</td>';
            echo '<td>'.$row['p_addr'].'</td>';
            echo '<td>'.$row['p_desc'].'</td>';
            echo '<td>'.$row['p_start_date'].'</td>';
            echo '<td>'.$row['p_end_date'].'</td>';
            echo '<td>'.$row['p_status'].'</td>';
            echo '<td>'.$row['p_cost'].'</td>';
            echo '<td>'.$employee_map[$row['e_id']].'</td>';
            echo '<td>'.$customer_map[$row['c_id']].'</td>';
            echo '<td><a type="button" class="btn btn-primary" href="update_project.php?id='.$row['p_id'].'">Update</a></td>';
            echo '<td><a type="button" class="btn btn-danger" href="db_delete_project.php?id='.$row['p_id'].'">Delete</a></td>';
            echo '</tr>';
        }
    ?>

    </tbody>
    </table>
    <div class="d-grid gap-2">
        <a class="btn btn-primary" type="button" href="create_project.php">Create Project</a>
    </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>