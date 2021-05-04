<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';

	if(!isset($_GET)) {
		header('Location: suppliers.php');
	}

    $supplier_query = sprintf("SELECT * FROM supplier WHERE s_id=%s", $_GET['id']);

    $run_query = mysqli_query($conn, $supplier_query) or die(mysqli_error($conn));

    $supplier_data = mysqli_fetch_assoc($run_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supplier Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Update Supplier</h2>
    <div class="container">
        <form method="POST" action="db_update_supplier.php">
        <div class="row mb-3">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="id" readonly name="id" value=<?php echo $supplier_data['s_id']; ?>>
            </div>
        </div>
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $supplier_data['s_name']; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="type" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $supplier_data['s_email']; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="type" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="description" name="desc" rows="3"><?php echo $supplier_data['s_desc']; ?></textarea>

            </div>
        </div>
        <div class="row mb-3">
            <label for="type" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="address" name="addr" rows="2"><?php echo $supplier_data['s_addr']; ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $supplier_data['s_phone']; ?>">
            </div>
        </div>

        <div class="d-grid gap-2">
            <input type="submit" class="btn btn-primary" value="UPDATE"></input>
        </div>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>