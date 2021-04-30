<?php
    session_abort();
    session_destroy();
    setcookie("auth_token", "", time()-3600, "/", NULL, 0);
    header("Location: index.php");
?>