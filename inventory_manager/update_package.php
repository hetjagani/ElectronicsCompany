<?php
    session_start();
    $role = 'inventory_manager';
    require '../authenticate.php';

	if(!isset($_GET)) {
		header('Location: packages.php');
	}

    $package_query = sprintf("SELECT * FROM packages WHERE pg_id=%s", $_GET['id']);
    $run_query = mysqli_query($conn, $package_query) or die(mysqli_error($conn));
    $package_data = mysqli_fetch_assoc($run_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Package Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Update Package Status</h2>
    <div class="container">
        <form method="POST" action="db_update_package.php">
        <div class="row mb-3">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="id" readonly name="id" value=<?php echo $package_data['pg_id']; ?>>
            </div>
        </div>
        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <select id="status" class="form-select" aria-label="Status" name="status" required>
                <option <?php if($project_data['pg_status'] == 'processing') echo 'selected'; ?> value="processing">Processing</option>
                <option <?php if($project_data['pg_status'] == 'processed') echo 'selected'; ?>  value="processed">Processed</option>
                <option <?php if($project_data['pg_status'] == 'dispatched') echo 'selected'; ?>  value="dispatched">Dispatched</option>
                <option <?php if($project_data['pg_status'] == 'delivered') echo 'selected'; ?>  value="delivered">Delivered</option>
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