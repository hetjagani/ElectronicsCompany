<?php
    session_start();
    $role = 'project_manager';
    require '../authenticate.php';

    // Create project id => project name map
    $project_query = "SELECT * FROM project WHERE e_id=".$_SESSION['user_id'].";";
    $run_prj_query = mysqli_query($conn, $project_query) or die(mysqli_error($conn));
    $project_map = array();
    while($row = mysqli_fetch_assoc($run_prj_query)) {
        $project_map[$row['p_id']] = $row['p_name'];
    }

    // Create employee id => name map
    $employee_query = "SELECT * FROM employee WHERE e_type='employee';";
    $run_emp_query = mysqli_query($conn, $employee_query) or die(mysqli_error($conn));
    $employee_map = array();
    while($row = mysqli_fetch_assoc($run_emp_query)) {
        $employee_map[$row['e_id']] = $row['e_fname'] .' '.$row['e_lname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Tasks</h2>
    <div class="container">
    <table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Project</th>
        <th scope="col">Employee</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $task_query = 'SELECT * FROM task;';

        $run_query = mysqli_query($conn, $task_query) or die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($run_query)) {
            echo '<tr>';
            echo '<th scope="row">'.$row['task_id'].'</th>';
            echo '<td>'.$row['task_name'].'</td>';
            echo '<td>'.$row['task_desc'].'</td>';
            echo '<td>'.$row['task_status'].'</td>';
            echo '<td>'.$row['task_start_date'].'</td>';
            echo '<td>'.$row['task_end_date'].'</td>';
            echo '<td>'.$project_map[$row['p_id']].'</td>';
            echo '<td>'.$employee_map[$row['e_id']].'</td>';
            echo '<td><a type="button" class="btn btn-primary" href="update_task.php?id='.$row['task_id'].'">Update</a></td>';
            echo '<td><a type="button" class="btn btn-danger" href="db_delete_task.php?id='.$row['task_id'].'">Delete</a></td>';
            echo '</tr>';
        }
    ?>

    </tbody>
    </table>
    <div class="d-grid gap-2">
        <a class="btn btn-primary" type="button" href="create_task.php">Create Task</a>
    </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>