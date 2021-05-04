<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';

	if(!isset($_GET)) {
		header('Location: customers.php');
	}

    $customer_query = sprintf("SELECT * FROM customer WHERE c_id=%s", $_GET['id']);

    $run_query = mysqli_query($conn, $customer_query) or die(mysqli_error($conn));

    $customer_data = mysqli_fetch_assoc($run_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Update Customer</h2>
    <div class="container">
        <form method="POST" action="db_update_customer.php">
        <div class="row mb-3">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="id" name="id" value=<?php echo $customer_data['c_id']; ?> readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="fname" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $customer_data['c_fname']; ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $customer_data['c_lname']; ?>"  required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value=<?php echo $customer_data['c_email']; ?>  required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" value=<?php echo $customer_data['c_phone']; ?>  required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="addr" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="addr" name="addr" value="<?php echo $customer_data['c_addr']; ?>"  required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="type" class="col-sm-2 col-form-label">Customer Type</label>
            <select id="type" class="form-select" aria-label="Customer Type" name="type">
                <option <?php if($customer_data['c_type'] === "organisation") echo 'selected'; ?>  value="organisation">Organisation</option>
                <option <?php if($customer_data['c_type'] === "individual") echo 'selected'; ?> value="individual">Individual</option>
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