<?php
    session_start();
    $role = 'employee';
    require '../authenticate.php';
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
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Project</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $task_query = 'SELECT * FROM task WHERE e_id='.$_SESSION['user_id'].';';

        $run_query = mysqli_query($conn, $task_query) or die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($run_query)) {
            echo '<tr>';
            echo '<th scope="row">'.$row['task_id'].'</th>';
            echo '<td>'.$row['task_name'].'</td>';
            echo '<td>'.$row['task_desc'].'</td>';
            echo '<td>'.$row['task_status'].'</td>';
            echo '<td>'.$row['task_start_date'].'</td>';
            echo '<td>'.$row['task_end_date'].'</td>';
            $get_project_info = 'SELECT p_name FROM project WHERE p_id='.$row['p_id'].';';
            $run_get_prj = mysqli_query($conn, $get_project_info) or die(mysqli_error($conn));
            $temp = mysqli_fetch_assoc($run_get_prj);
            echo '<td>'.$temp['p_name'].'</td>';
            echo '</tr>';
        }
    ?>

    </tbody>
    </table>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>