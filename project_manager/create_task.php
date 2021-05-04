<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'project_manager';
    require '../authenticate.php';

    //create project id => name map
    $project_query = "SELECT * FROM project WHERE e_id=".$_SESSION['user_id'].";";
    $run_prj_query = mysqli_query($conn, $project_query) or die(mysqli_error($conn));
    $project_map = array();
    while($row = mysqli_fetch_assoc($run_prj_query)) {
        $project_map[$row['p_id']] = $row['p_name'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>
    <?php
        if(!isset($_GET['create-task-select-project'])){

            echo '<h2> Select Project </h2>
            <div class="container">
                <form method="GET" action="create_task.php">
                    <div class="row mb-3">
                        <label for="project" class="col-sm-2 col-form-label">Project</label>
                        <select id="project" class="form-select" aria-label="Project" name="p_id" required>';
                            foreach($project_map as $id => $name) {
                                echo '<option value="'.$id.'">'.$name.'</option>';
                            } 
                        echo'</select>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" name="create-task-select-project" class="btn btn-primary" value="SELECT"></input>
                    </div>
                </form>
            </div>';
        }
    ?>
    <?php
        if(isset($_GET['create-task-select-project'])){
            echo'<h2> Create Task </h2>
            <div class="container">
                <form method="POST" action="db_create_task.php">
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
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <select id="status" class="form-select" aria-label="Status" name="status">
                        <option value="complete">Complete</option>
                        <option selected value="incomplete">Incomplete</option>
                    </select>
                </div>
                <div class="row mb-3">
                    <label for="start_date" class="col-sm-2 col-form-label">Task Start Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="end_date" class="col-sm-2 col-form-label">Task End Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="row mb-3">
                        <label for="project" class="col-sm-2 col-form-label">Project</label>
                        <div class="col-sm-10">';?>
                            <input type="hidden" id="p_id" name="p_id" value=<?php echo $_GET['p_id']; ?>>
                            <input type="text" class="form-control" id="project" readonly name="project" value="<?php echo $project_map[$_GET['p_id']]; ?>">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee" class="col-sm-2 col-form-label">Employee</label>
                    <select id="employee" class="form-select" aria-label="Employee" name="e_id" required>';
                    <?php 
                        $getid = $_GET['p_id'];
                        $find_emp_query = 'SELECT employee.* FROM employee join is_part_of ON is_part_of.e_id = employee.e_id WHERE p_id='.$getid.';';
                        $run_find_emp = mysqli_query($conn, $find_emp_query) or die(mysqli_error($conn));
                        while($row = mysqli_fetch_assoc($run_find_emp)) {
                            echo '<option value="'.$row['e_id'].'">'.$row['e_fname'].' '.$row['e_lname'].'</option>';
                        }
                    ?>
                    </select>
                </div>
                
        <?php
            echo'<div class="d-grid gap-2">
                    <input type="submit" class="btn btn-primary" value="CREATE"></input>
                </div>
            </form>
    
        </div>';
        }?>     
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
