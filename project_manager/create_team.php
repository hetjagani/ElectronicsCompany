<?php
    session_start();
    require '../authenticate.php';

    // Create employee id => name map
    $employee_query = "SELECT * FROM employee WHERE e_type='employee';";
    $run_emp_query = mysqli_query($conn, $employee_query) or die(mysqli_error($conn));
    $employee_map = array();
    while($row = mysqli_fetch_assoc($run_emp_query)) {
        $employee_map[$row['e_id']] = $row['e_fname'] .' '.$row['e_lname'];
    }

    // Create project id => name map
    $project_query = sprintf("SELECT * FROM project WHERE e_id=%s;", $_SESSION['user_id']);
    $run_proj_query = mysqli_query($conn, $project_query) or die(mysqli_error($conn));
    $project_map = array();
    while($row = mysqli_fetch_assoc($run_proj_query)) {
        $project_map[$row['p_id']] = $row['p_name'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2> Create Team </h2>
    <div class="container">
        <form method="POST" action="db_create_team.php">
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="description" name="desc" rows="3"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="project" class="col-sm-2 col-form-label">Project</label>
            <select id="project" class="form-select" aria-label="Project" name="project" required>
                <?php
                    foreach($project_map as $id => $name) {
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    } 
                ?>
                
            </select>
        </div>
        <div class="row mb-3">
            <label for="employees" class="col-form-label">Employees (To select multiple hold Ctrl and select)</label>
            <select id="employees" class="form-select" aria-label="Employees" name="employees[]" size="6" multiple required>
                <?php
                    foreach($employee_map as $id => $name) {
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