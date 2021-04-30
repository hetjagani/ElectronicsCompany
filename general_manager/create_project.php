<?php
    session_start();
    require '../authenticate.php';
    // create service id => name map
    $service_query = "SELECT * FROM service;";
    $run_serv_query = mysqli_query($conn, $service_query) or die(mysqli_error($conn));
    $service_map = array();
    while($row = mysqli_fetch_assoc($run_serv_query)){
        $service_map[$row['se_id']] = $row['se_name'];
    }


    // Create employee id => name map
    $employee_query = "SELECT * FROM employee WHERE e_type='project_manager';";
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
    <title>Create Project Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2> Create Project </h2>
    <div class="container">
        <form method="POST" action="db_create_project.php">
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="addr" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="addr" name="addr" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="description" name="desc" rows="3"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="start_date" class="col-sm-2 col-form-label">Project Start Date</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="end_date" class="col-sm-2 col-form-label">Project End Date</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="cost" class="col-sm-2 col-form-label">Cost</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="cost" name="cost" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="services" class="col-form-label">Services (To select multiple hold Ctrl and select)</label>
            <select id="services" class="form-select" aria-label="services" name="services[]" size="6" multiple required>
                <?php
                    foreach($service_map as $id => $name) {
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    } 
                ?>
                
            </select>
        </div>
        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <select id="status" class="form-select" aria-label="Status" name="status">
                <option value="complete">Complete</option>
                <option selected value="incomplete">Incomplete</option>
            </select>
        </div>
        <div class="row mb-3">
            <label for="manager" class="col-sm-2 col-form-label">Project Manager</label>
            <select id="manager" class="form-select" aria-label="Project Manager" name="manager" required>
                <?php
                    foreach($employee_map as $id => $name) {
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    } 
                ?>
                
            </select>
        </div>
        <div class="row mb-3">
            <label for="customer" class="col-sm-2 col-form-label">Customer</label>
            <select id="customer" class="form-select" aria-label="Customer" name="customer" required>
                <?php
                    foreach($customer_map as $id => $name) {
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    } 
                ?>
                
            </select>
        </div>
        
        <div class="d-grid gap-2">
            <input type="submit" class="btn btn-primary" value="CREATE"></input>
        </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>