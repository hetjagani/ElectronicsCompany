<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    require '../database.php';

    if(!isset($_GET)) {
		header('Location: employees.php');
	}

    $employee_query = sprintf("SELECT * FROM employee WHERE e_id=%s", $_GET['id']);

    $run_query = mysqli_query($conn, $employee_query) or die(mysqli_error($conn));

    $employee_data = mysqli_fetch_assoc($run_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Update Employee</h2>
    <div class="container">
        <form method="POST" action="db_update_employee.php">
        <div class="row mb-3">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="id" name="id" value=<?php echo $employee_data['e_id']; ?> readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="fname" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $employee_data['e_fname']?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $employee_data['e_lname']?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $employee_data['e_email']?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $employee_data['e_phone']?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="salary" class="col-sm-2 col-form-label">Salary</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="salary" name="salary" value=<?php echo $employee_data['e_salary']?> required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="skill" class="col-sm-2 col-form-label">Skill</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="skill" name="skill" value="<?php echo $employee_data['e_skill']?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="join_date" class="col-sm-2 col-form-label">Join Date</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="join_date" name="join_date" value="<?php echo $employee_data['e_join_date']?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="type" class="col-sm-2 col-form-label">Type</label>
            <select id="type" class="form-select" aria-label="Type" name="type" required>
                <option <?php if($project_data['e_type'] == 'employee') echo 'selected'; ?> value="employee">Employee</option>
                <option <?php if($project_data['e_type'] == 'inventory_manager') echo 'selected'; ?>  value="inventory_manager">Inventory Manager</option>
                <option <?php if($project_data['e_type'] == 'project_manager') echo 'selected'; ?>  value="project_manager">Project Manager</option>
                <option <?php if($project_data['e_type'] == 'general_manager') echo 'selected'; ?>  value="general_manager">General Manager</option>
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