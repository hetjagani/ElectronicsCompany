<?php
    session_start();
    
    if(isset($_SESSION) && isset($_COOKIE)) {
        header("Location: /ElectronicsCompany/".$_SESSION['employee_type']."/index.php");
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronics Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>

    <div class="text-center">
    <?php
        if($_GET['error']) {
            echo '<div class="alert alert-danger" role="alert">Invalid Login Credentials</div>';
        }
    ?>
    <form class="form-signin" method="POST" action="login.php">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit">
    </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>