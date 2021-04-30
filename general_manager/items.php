<?php
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>

<body>
    <?php
        require 'header.php';
    ?>

    <h2>Items</h2>
    <div class="container">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Available Quantity</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $item_query = 'SELECT * FROM item;';

        $run_query = mysqli_query($conn, $item_query) or die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($run_query)) {
            echo '<tr>';
            echo '<th scope="row">'.$row['it_id'].'</th>';
            echo '<td>'.$row['it_name'].'</td>';
            echo '<td>'.$row['it_desc'].'</td>';
            echo '<td>'.$row['it_available_qty'].'</td>';
            echo '<td><a type="button" class="btn btn-primary" href="update_item.php?id='.$row['it_id'].'">Update</a></td>';
            echo '<td><a type="button" class="btn btn-danger" href="db_delete_item.php?id='.$row['it_id'].'">Delete</a></td>';

            echo '</tr>';
        }
    ?>

    </tbody>
    </table>
    <div class="d-grid gap-2">
        <a class="btn btn-primary" type="button" href="create_item.php">Create Item</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>