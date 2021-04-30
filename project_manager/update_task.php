<?php
    session_start();
    $role = 'project_manager';
    require '../authenticate.php';

	if(!isset($_GET)) {
		header('Location: tasks.php');
	}

    // Fetch task data
    $task_query = sprintf("SELECT * FROM task WHERE task_id=%s", $_GET['id']);
    $run_task_query = mysqli_query($conn, $task_query) or die(mysqli_error($conn));
    $task_data = mysqli_fetch_assoc($run_task_query);

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
    <title>Update Task Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2> Update Task </h2>
    <div class="container">
        <form method="POST" action="db_update_task.php">
        <div class="row mb-3">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="id" name="id" value=<?php echo $task_data['task_id']; ?> readonly required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $task_data['task_name']; ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="description" name="desc" rows="3"><?php echo $task_data['task_desc']; ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="start_date" class="col-sm-2 col-form-label">Task Start Date</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="start_date" name="start_date" value=<?php echo $task_data['task_start_date']; ?> required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="end_date" class="col-sm-2 col-form-label">Task End Date</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="end_date" name="end_date" value=<?php echo $task_data['task_end_date']; ?> required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
                <select id="status" class="form-select" aria-label="Status" name="status">
                <option <?php if($task_data['task_status'] === "complete") echo 'selected'; ?>  value="complete">Complete</option>
                <option <?php if($task_data['task_status'] === "incomplete") echo 'selected'; ?> value="incomplete">Incomplete</option>
            </select>
        </div>
        <div class="row mb-3">
            <label for="project" class="col-sm-2 col-form-label">Project</label>
            <?php
                //Fetch Project Data
                $project_query = sprintf("SELECT * FROM project WHERE p_id=%s", $task_data['p_id']);
                $run_project_query = mysqli_query($conn, $project_query) or die(mysqli_error($conn));
                $project_data = mysqli_fetch_assoc($run_project_query);
           ?>
            <div class="col-sm-10">
                <input type="hidden" id="p_id" name="p_id" value=<?php echo $task_data['p_id']; ?>>  
                <input type="text" class="form-control" id="p_name" readonly name="p_name" value="<?php echo $project_data['p_name']; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="employee" class="col-sm-2 col-form-label">Employee</label>
            <select id="employee" class="form-select" aria-label="Employee" name="employee" required>
                <?php
                    $get_emp_for_prj = "SELECT * from is_part_of WHERE p_id=".$task_data['p_id'].";";
                    $run_emp_for_prj = mysqli_query($conn, $get_emp_for_prj) or die(mysqli_error($conn));
                    while($row = mysqli_fetch_assoc($run_emp_for_prj)) {
                        if($row['e_id'] == $task_data['e_id']) {
                            echo '<option selected value="'.$row['e_id'].'">'.$employee_map[$row['e_id']].'</option>';
                        } else {
                            echo '<option value="'.$row['e_id'].'">'.$employee_map[$row['e_id']].'</option>';
                        }
                    }
                ?>
            </select>
        </div>

        <div class="d-grid gap-2">
            <input type="submit" class="btn btn-primary" value="UPDATE"></input>
        </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>