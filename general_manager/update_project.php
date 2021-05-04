<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';

	if(!isset($_GET)) {
		header('Location: projects.php');
	}
    // fetch services data associated with projects
    $get_services = 'SELECT * FROM service';
    $run_get_serv = mysqli_query($conn,$get_services) or die(mysqli_error($conn));
    $service_map = array();
    
    while($row = mysqli_fetch_assoc($run_get_serv)){
        $service_map[$row['se_id']] = $row['se_name'];
    }

    $serv_prj_arr = array();
    $get_serv_id = sprintf("SELECT se_id FROM provide_services WHERE p_id=%s", $_GET['id']);
    $run_get_servid = mysqli_query($conn,$get_serv_id) or die(mysqli_error($conn));

    while($row = mysqli_fetch_assoc($run_get_servid)){
        array_push($serv_prj_arr,$row['se_id']);
    }

    // Fetch project data
    $project_query = sprintf("SELECT * FROM project WHERE p_id=%s", $_GET['id']);
    $run_query = mysqli_query($conn, $project_query) or die(mysqli_error($conn));
    $project_data = mysqli_fetch_assoc($run_query);

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
    <title>Update Project Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2> Update Project </h2>
    <div class="container">
        <form method="POST" action="db_update_project.php">
        <div class="row mb-3">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="id" name="id" value=<?php echo $project_data['p_id']; ?> readonly required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $project_data['p_name']; ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="addr" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="addr" name="addr" value="<?php echo $project_data['p_addr']; ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="description" name="desc" rows="3"><?php echo $project_data['p_desc']; ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="start_date" class="col-sm-2 col-form-label">Project Start Date</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="start_date" name="start_date" value=<?php echo $project_data['p_start_date']; ?> required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="end_date" class="col-sm-2 col-form-label">Project End Date</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="end_date" name="end_date" value=<?php echo $project_data['p_end_date']; ?> required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="cost" class="col-sm-2 col-form-label">Cost</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="cost" name="cost" value=<?php echo $project_data['p_cost']; ?> required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="services" class="col-form-label">Services (To select multiple hold Ctrl and select)</label>
            <select id="services" class="form-select" aria-label="Services" name="services[]" size="6" multiple required>
                <?php
                    foreach($service_map as $id => $name) {
                        if(in_array($id, $serv_prj_arr)) {
                            echo '<option selected value="'.$id.'">'.$name.'</option>';
                        } else {
                            echo '<option value="'.$id.'">'.$name.'</option>';
                        }
                    } 
                ?>
                
            </select>
        </div>
        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <select id="status" class="form-select" aria-label="Status" name="status">
                <option <?php if($project_data['p_status'] === "complete") echo 'selected'; ?>  value="complete">Complete</option>
                <option <?php if($project_data['p_status'] === "incomplete") echo 'selected'; ?> value="incomplete">Incomplete</option>
            </select>
        </div>
        <div class="row mb-3">
            <label for="manager" class="col-sm-2 col-form-label">Project Manager</label>
            <select id="manager" class="form-select" aria-label="Project Manager" name="manager" required>
                <?php
                    foreach($employee_map as $id => $name) {
                        if($id == $project_data['e_id']) {
                            echo '<option selected value="'.$id.'">'.$name.'</option>';
                        }else {
                            echo '<option value="'.$id.'">'.$name.'</option>';
                        }
                    } 
                ?>
                
            </select>
        </div>
        <div class="row mb-3">
            <label for="customer" class="col-sm-2 col-form-label">Customer</label>
            <select id="customer" class="form-select" aria-label="Customer" name="customer" required>
                <?php
                    foreach($customer_map as $id => $name) {
                        if($id == $project_data['c_id']) {
                            echo '<option selected value="'.$id.'">'.$name.'</option>';
                        } else {
                            echo '<option value="'.$id.'">'.$name.'</option>';
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