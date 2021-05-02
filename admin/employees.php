<?php
    session_start();
    require '../database.php';
    $emp_type = array("inventory_manager" => "Inventory Manager", 
                       "project_manager" => "Project Manager",
                       "general_manager" => "General Manager",
                       "employee" => "Employee");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>


    <h2>Employees</h2>
    <div class="container">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Salary</th>
        <th scope="col">Skill</th>
        <th scope="col">Join Date</th>
        <th scope="col">Type</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $employee_query = 'SELECT * FROM employee;';

        $run_query = mysqli_query($conn, $employee_query) or die(mysqli_error($conn));
        //echo $run_query;
        while($row = mysqli_fetch_assoc($run_query)) {
            echo '<tr>';
            echo '<th scope="row">'.$row['e_id'].'</th>';
            echo '<td>'.$row['e_fname'].' '.$row['e_lname'].'</td>';
            echo '<td>'.$row['e_email'].'</td>';
            echo '<td>'.$row['e_phone'].'</td>';
            echo '<td>'.$row['e_salary'].'</td>';
            echo '<td>'.$row['e_skill'].'</td>';
            echo '<td>'.$row['e_join_date'].'</td>';
            echo '<td>'.$emp_type[$row['e_type']].'</td>';
            echo '<td><a type="button" class="btn btn-primary" href="update_employee.php?id='.$row['e_id'].'">Update</a></td>';
            echo '<td><a type="button" class="btn btn-danger" href="db_delete_employee.php?id='.$row['e_id'].'">Delete</a></td>';
            echo '</tr>';
        }
    ?>

    </tbody>
    </table>
    <div class="d-grid gap-2">
        <a class="btn btn-primary" type="button" href="create_employee.php">Create Employee</a>
    </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>