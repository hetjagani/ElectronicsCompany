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
        <th scope="col">Team</th>
        <th scope="col">Team Description</th>
        <th scope="col">Total Members</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $prj_team_emp_q = 'SELECT * FROM is_part_of,project,team WHERE is_part_of.t_id = team.t_id AND project.p_id = is_part_of.p_id AND is_part_of.e_id ='.$_SESSION['user_id'].';';
        $result_query = mysqli_query($conn, $prj_team_emp_q) or die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($result_query)) {
            echo '<tr>';
            echo '<th scope="row">'.$row['p_id'].'</th>';
            echo '<td>'.$row['p_name'].'</td>';
            echo '<td>'.$row['p_addr'].'</td>';
            echo '<td>'.$row['p_desc'].'</td>';
            echo '<td>'.$row['p_start_date'].'</td>';
            echo '<td>'.$row['p_end_date'].'</td>';
            echo '<td>'.$row['p_status'].'</td>';
            echo '<td>'.$row['t_name'].'</td>';
            echo '<td>'.$row['t_desc'].'</td>';
            $cnt_team_query = 'SELECT COUNT(*) AS countemp FROM is_part_of WHERE t_id='.$row['t_id'].' AND p_id='.$row['p_id'].';';
            $cnt_res = mysqli_query($conn, $cnt_team_query) or die(mysqli_error($conn));
            $temp = mysqli_fetch_assoc($cnt_res);
            echo '<td>'.$temp['countemp'].'</td>';
            
            echo '</tr>';
        }
    ?>

    </tbody>
    </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>