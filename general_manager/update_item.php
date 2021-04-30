<?php
    session_start();
    $role = 'general_manager';
    require '../authenticate.php';

	if(!isset($_GET)) {
		header('Location: items.php');
	}

    $item_query = sprintf("SELECT * FROM item WHERE it_id=%s", $_GET['id']);

    $run_query = mysqli_query($conn, $item_query) or die(mysqli_error($conn));

    $item_data = mysqli_fetch_assoc($run_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/common.css">
</head>
<body>
    <?php
        require 'header.php';
    ?>

    <h2>Update Item</h2>
    <div class="container">
        <form method="POST" action="db_update_item.php">
        <div class="row mb-3">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="id" readonly name="id" value=<?php echo $item_data['it_id']; ?>>
            </div>
        </div>
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $item_data['it_name']; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="type" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="description" name="desc" rows="3"><?php echo $item_data['it_desc']; ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="avai_qty" class="col-sm-2 col-form-label">Available Quantity</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="avai_qty" readonly name="avai_qty" value=<?php echo $item_data['it_available_qty']; ?>>
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