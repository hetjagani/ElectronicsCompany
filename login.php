<?php
	// SJSU CMPE 138 Spring 2021 TEAM11 
    require 'database.php';
    session_start();

    if(isset($_POST)){
        $user_email = $_POST['email'];
        $user_pass = md5($_POST['password']);
       
        if($user_email=="admin@gmail.com" && $user_pass==md5('admin')){
            //echo $user_email.' '.$user_pass;
            $t = md5('admin@gmail.com:admin');
            setcookie("auth_token", $t, time()+60*60*24*30, "/", NULL, 0);
            echo "<script type='text/javascript'> document.location = 'admin/index.php'; </script>";
        }

        $user_fetch_query = sprintf("SELECT * FROM employee WHERE e_email = '%s' AND e_password = '%s'", 
           $user_email,
           $user_pass);

        if($query_run = mysqli_query($conn, $user_fetch_query)) {
            $query_data = mysqli_fetch_assoc($query_run);
            if($query_data) {
                $_SESSION['user_id'] = $query_data['e_id'];
                $_SESSION['employee_type'] = $query_data['e_type'];
                $str_tok = sprintf("%s:%s", $query_data['e_id'], $query_data['e_password']);
                $token = md5($str_tok);
                setcookie("auth_token", $token, time()+60*60*24*30, "/", NULL, 0);
                if($query_data['e_type'] === "general_manager") {
                    header("Location: general_manager/index.php");
                }else if($query_data['e_type'] === "inventory_manager") {
                    header("Location: inventory_manager/index.php");
                }else if($query_data['e_type'] === "project_manager") {
                    header("Location: project_manager/index.php");
                }else if($query_data['e_type'] === "employee") {
                    header("Location: employee/index.php");
                }
            } else {
                header("Location: index.php?error=true");
            }
        } else {
            header("Location: index.php?error=true");
        }
    }
?>