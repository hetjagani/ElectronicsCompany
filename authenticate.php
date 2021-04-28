<?php
    require 'database.php';
    session_start();
    
    if(isset($_SESSION["user_id"])) {
        $session_user = $_SESSION["user_id"];
        $query = sprintf("SELECT e_password FROM employee WHERE e_id = %s LIMIT 1;", $session_user);

        if($query_run = mysqli_query($conn, $query)) {
            $data = mysqli_fetch_assoc($query_run);

            $str_tok = sprintf("%s:%s", $session_user, $data['e_password']);
            $token = md5($str_tok);

            if($token != $_COOKIE['auth_token']) {
                header("Location: /ElectronicsCompany/index.php");
            }
        }
    } else {
        header("Location: index.php");
    }
?>